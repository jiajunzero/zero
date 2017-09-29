<?php

namespace Home\Controller;

use Think\Controller;

class MemberController extends Controller{
    private $Mem=null;
    private $host='127.0.0.1';
    private $port=11211;
    private $time=3;

    public function __construct()
    {
        parent::__construct();
        $this->Mem=new \Memcache();
        $this->Mem->connect($this->host,$this->port);
    }

    public function getCodeTime($phone){
        $key=md5($phone);
        $status=$this->Mem->get($key);//获取memcache值
        if(!$status){//如果不存在值 就设置
            $this->Mem->set($key,1,0,$this->time);
            return true;
        }else{
            //存在值 就返还false 相当于已经发送过手机验证码
            return false;
        }
    }

    public function getCodeDay($phone){
        $key=md5('day'.$phone);
        $num=(int)$this->Mem->get($key);//获取memcache值  强制转换为int
        if($num<4){//
            $this->Mem->set($key,++$num,0,strtotime(date('Ymd 23:59:59'))-time());
            return true;
        }else{
            //存在值 就返还false 相当于已经发送过手机验证码
            return false;
        }
    }


    public function login(){
        if(IS_POST){

            $memModel=D('Member');
            if($memModel->create(I('post.'),4)){
                $status=$memModel->login();
               if($status===true){

                   $cartModle=D('Cart');
                   $cartModle->moveCart();

                   $accountUrl=session('accountUrl');
                   if($accountUrl){
                       $this->success('前往结算中心！',$accountUrl);exit;
                   }
                   $this->success('登录成功！',U('Index/index'));exit;
               }elseif($status==3){
                   $this->error('验证码错误');
               }elseif($status==2){
                   $this->error('密码错误！');
               }elseif($status==1){
                   $this->error('用户不存在！');
               }
            }else{
                $this->error('验证失败！'.$memModel->getError());
            }
        }
        $this->display();
    }

    public function register(){
        $memberModel=D('Member');
        if(IS_POST){
            //判断手机验证码是否正确
            $yzm=I('post.yzm');
            if($yzm!=cookie('yzm')){
                $this->error('验证码错误！');
            }

            if($memberModel->create()){
                if($memberModel->add()){
                    $this->success('注册成功',U('Index/index'));exit();
                }else{
                    $this->error('无法新增！'.$memberModel->getDbError());
                }
            }else{
                $this->error('验证失败！'.$memberModel->getError());
            }
        }

        $this->display();
    }

    //验证码
    public function yzm(){

        $config=array(
            'fontSize'  =>  20,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  150,               // 验证码图片宽度
            'length'    =>  4,
        );

        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }


//    public function active(){
//        $id=I('get.id');
//        $model=M('Member');
//        $status=M('Member')->find($id);
//        if($status){
//            $model->save(array('id'=>$id,'is_active'=>1));
//            $this->success('激活成功',U('Index/index'));
//        }else{
//            $this->error('激活失败！');
//        }
//    }

    //用户利用邮箱激活
    public function active(){
        $id=I('get.id');
        $token=I('get.token');

//        dump($token);die;
        $md5Token=md5(C('SHOP_STR').$id);

        if($md5Token!=$token){//篡改id
            exit('no access!');
        }

        //没有篡改
        $model=M('Member');
        $data=$model->find($id);

        if($data){
            $model->save(array('id'=>$id,'is_active'=>1));
            $this->success('激活成功',U('login'));exit();
        }else{
            $this->succes('已经激活 请勿重复激活！',U('login'));exit();
        }
    }

    public function ajaxYzm(){
        $to=I('get.phone');
        $status=$this->getCodeTime($to);

        if(!$status){
            $res= array(
                'status'=>false,
                'code'=>3,
                'msg'=>'已经发送验证码 请勿连续点击'
            );
            echo json_encode($res);exit;
        }

        $memDay=$this->getCodeDay($to);
        if(!$memDay){
            $res= array(
                'status'=>false,
                'code'=>4,
                'msg'=>'一天只能发送3次'
            );
            echo json_encode($res);exit;
        }


        $yzm=randCode(4,1);//4位数字验证码
        $time=2;//有效期2分钟
        $datas=array($yzm,$time);
        $tempId=1;
        //调用接口获取信息
        vendor('RongLian.RongLian');
        $ronglian=new \RongLian();

        $result = $ronglian->sendTemplateSMS($to,$datas,$tempId);
        if($result == NULL ) {
            $res= array(
                'status'=>false,
                'code'=>1,
                'msg'=>'result error!'
            );

        }
        if($result->statusCode!=0) {
//         echo "error code :" . $result->statusCode . "<br>";
//         echo "error msg :" . $result->statusMsg . "<br>";
            $res=  array(
                'status'=>false,
                'code'=>2,
                'msg'=>$result->statusCode.'=='.$result->statusMsg
            );
            //TODO 添加错误处理逻辑
        }else{
//         echo "Sendind TemplateSMS success!<br/>";
            // 获取返回信息
            $smsmessage = $result->TemplateSMS;
//         echo "dateCreated:".$smsmessage->dateCreated."<br/>";
//         echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
            $res=  array(
                'status'=>true,
                'code'=>0,
                'msg'=>$smsmessage->dateCreated.'=='.$smsmessage->smsMessageSid
            );
            //TODO 添加成功处理逻辑
        }

        cookie('yzm',$yzm,time()+120);
        echo json_encode($res);
    }

    public function reback(){
        session(null);
        $this->success('退出成功！',U('Index/index'));exit();
    }


    //qq登录
    public function qqcheck(){

        //获取到qq返回的openid
        $openid=session('openid');

        //当qq登录成功有openid的时候才做业务处理
        if(!$openid){
            exit('no access');
        }

        //判断用户是否绑定过 （ 检查数据表中是否存在这个openid）
        $memModel=M('Member');
        $info=$memModel->where(array('open_id'=>$openid))->find();
        if($info){
            //用户绑定过保存用户名和id 等于登录逻辑
            session('id',$info['id']);
            session('username',$info['username']);
            //跳转到首页
            $this->success('登录成功！',U('Index/index'));exit();
        }else{
            $this->success('前往qq绑定',U('bangding'));exit();
        }
    }

    //绑定qq
    public  function bangding(){

        //获取到qq返回的openid
        $openid=session('openid');
        //只有qq登录的才能进行绑定
        if(!$openid){
            exit('no access');
        }

        if(IS_POST){//提交绑定的信息
            //获取数据
            $user=I('post.username');//用户名
            $pwd=md5(I('post.password'));//密码

            $memModel=M('Member');
            //根据用户名检查用户是否合格
            $Info=$memModel->where(array('username'=>$user))->find();
            if($Info){
                //如果用户存在 检查密码是否正确
                if($pwd==$Info['password']){
                    //密码正确 保存用户登录信息 绑定成功 把openid添加到当前用户的表中
                    session('id',$Info['id']);
                    session('username',$Info['username']);
                    $memModel->where(array('id'=>$Info['id']))->setField('open_id',$openid);
                    $this->success('绑定成功！',U('Index/index'));exit();

                }else{
                    $this->error('密码错误');
                }
            }else{
                //用户不存在
                $this->error('用户不存在！无法绑定绑定');
            }
        }
        $this->display();
    }
}