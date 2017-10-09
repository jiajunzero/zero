<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\LiveStream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Profession;
use App\Http\Models\ProfessionCate;
use App\Http\Models\Member;
use App\Http\Models\Order;
use App\Http\Models\MemberProfession;
use App\Http\Models\LiveCourse;
use Redis;
use Auth;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProfessionCate $professionCate,Profession $profession,Member $member,Livecourse $livecourse)
    {
        $data['professioncate']=$professionCate->orderBy('sort','asc')->get();
        $data['profession']=$profession->orderBy('sort','asc')->get();
        $data['profession']->each(function($item,$key)use($member){
            if($item->teacher_ids){
                $teacher=explode(',',$item->teacher_ids);
                $item->teacher_ids= $member->select('nickname')->whereIn('id',$teacher)->get();
            }

        });

        $data['live']=$livecourse->with('member')->get();


        return view('home.index.index',$data);
    }

    //专业购买页面
    public function profession(Profession $profession,Member $member){

        $data['professionInfo']=$profession;
        $teacher=explode(',',$data['professionInfo']->teacher_ids);

        $data['professionInfo']->teacher_ids=$member->select('nickname')->whereIn('id',$teacher)->get();

        return view('home.index.profession',$data);
    }

    //生成订单页面
    public function sure(Profession $profession){
        $data['order']=$profession;
        $data['order']->expired_at=($data['order']->expired_at)*3600*24;
        return view('home.index.sure',$data);
    }

    //生成订单
    public function create(Profession $profession,Order $order){

        $order->price=$profession->price;
        $order->pro_id=$profession->id;
        $order->pro_name=$profession->pro_name;
        $order->member_id=Auth::guard("member")->user()->id; //获取会员ID
        $order->order_number=$this->create_order(); //调用生成订单号的方法

        $res=$order->save();  //保存到库
        if($res){
            //入库成功 跳到支付页面
            return redirect('/order/'.$order->id.'/pay');
        }else{
            return redirect()->back()->withErrors(['系统错误！请稍后再试']);
        }
    }

    //生成订单号
    private function create_order(){
        $order=date('YmdHis'); //基于时间日期

        //获取拼接的订单尾号
        $res=Redis::get('order_number');
        //如果尾号存在并且小于1000000就继续自增  否则重置
        if($res && $res<1000000){
           $number=++$res;
        }else{
            $number=1;
        }

        Redis::set('order_number',$number);

        //把拼接的数字变成6位 左边补零
        $order_number=str_pad($number,6,'0',STR_PAD_LEFT);

        return $order.$order_number;
    }

    //订单详情页
    public function pay(Order $order){
        $data['orderInfo']=$order;
        return view('home.index.pay',$data);
    }

    //支付二维码页面
    public function wechatpay(Request $request,Order $order){
       $paytype=$request->get('paytype');
       if($paytype==1){
           $data=$this->wxpay($request,$order);
       }

        return view('home.index.wechatpay',$data);
    }

    //微信支付
    public function wxpay( $request, $order){
        require_once "../wxpay/lib/WxPay.Api.php";  //微信支付的核心类文件
        require_once "../wxpay/WxPay.NativePay.php";  //微信扫码支付的类文件

        $notify = new \NativePay();
        $input = new \WxPayUnifiedOrder();
        $input->SetBody($order->pro_name);  //描述
//        $input->SetAttach("test"); //附加信息
        $input->SetOut_trade_no($order->order_number); //订单号
        $input->SetTotal_fee("1");  //支付金额(分)
        $input->SetTime_start(date("YmdHis",strtotime($order->created_at)));  //订单生成时间
        $input->SetTime_expire(date("YmdHis",strtotime($order->created_at) ));  //订单失效时间
//        $input->SetGoods_tag("test");
        $input->SetNotify_url(url('pay/notify'));  //回调地址
        $input->SetTrade_type("NATIVE");  //扫码支付模式
        $input->SetProduct_id($order->pro_id);  //商品的ID
        $result = $notify->GetPayUrl($input); //生成二维码地址


        if(!isset($result['code_url'])){
            echo '<script>parent.alert("系统繁忙"); parent.close();</script>';
            exit();
        }
        $data['url2']= $result["code_url"];
        $data['oid']=$order->id;
        $data['qrcode']=url('order/qrcode');

        return $data;
    }

    //生成二维码
    public function qrcode(){
        require_once '../wxpay/phpqrcode.php';
        $url = urldecode($_GET["data"]);
        \QRcode::png($url);
    }

    //查询订单返回支付结果
    public function queryOrder(Request $request,Order $order,MemberProfession $memberProfession,Profession $profession){
        if(!$request->ajax()){
            return ['status'=>'fail','code'=>1,'error'=>'非法请求'];
        }

        require_once "../wxpay/lib/WxPay.Api.php";  //微信支付的核心类文件
        $order_id=$request->get('oid');

        $order=$order->find($order_id);
        if(!$order){
            return ['status'=>'fail','code'=>2,'error'=>'支付有误'];
        }

        $input = new \WxPayOrderQuery();  //实例化查询订单类
        $input->SetOut_trade_no($order->order_number);  //传入订单号
        $res=\WxPayApi::orderQuery($input);  //查询订单

        if($res['trade_state']=='SUCCESS'){ //支付成功

            $order->status=1; //保存订单状态
            $order->pay_at=date('Y-m-d H:i:s');  //保存支付时间
            $order->save();

            //同步会员和专业的关系
            $memberProfession->member_id=$order->member_id;
            $memberProfession->profession_id=$order->pro_id;
            $memberProfession->pro_name=$order->pro_name;
            $memberProfession->expire_start=$order->pay_at;
            $memberProfession->expire_end=date('Y-m-d H:i:s',strtotime($order->pay_at)+$profession->find($order->pro_id)->expired_at*86400);
            $memberProfession->save();
            return ['status'=>'success'];
        }else{
            return ['status'=>'fail','code'=>3,'error'=>'支付有误'];
        }

    }

    //微信支付回调地址
    public function notify(){

    }

    //生成播放地址
    public function live(LiveCourse $livecourse,LiveStream $livestream){

        $data['course']=$livecourse;

        $space= 'php-25';  //直播空间名

        $stream=$livestream->find($livecourse->stream_id)->stream_name;

        $data['address']="rtmp://pili-live-rtmp.www.sinsea,cn/$space/$stream";

        return view('home.index.live',$data);
    }


}
