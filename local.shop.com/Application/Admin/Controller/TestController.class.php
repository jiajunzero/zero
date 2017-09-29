<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/12
 * Time: 9:57
 */

namespace Admin\Controller;
use Think\Controller;
class TestController extends Controller{


    public function test(){
        /*
         * 18 .
            电商项目的后台管理中有一个查询订单功能，可以根据用户名、下单日期来查询订单详情。
            该功能需要3张表: 会员表、订单表、商品表。 请自己设计这3张表，写出主要字段即可。
            请编写2个方法查询订单详情。结果信息必须包含订单编号、下单人、商品名称、订购数量。
            1. 根据用户名（模糊查询）查询  （getOrderByName）
            2. 根据下单时间区间查询        （getOrderByTime）
            3. 使用ajax方式完成
            4. 本题不需要给出数据库配置文件、自定义模型代码
            注意：
            该题目不需要编写模型和数据库配置等文件，只需要在上述定义的方法中使用连贯操作或者原生sql查询出结构即可

         * */
        $username=I('get.username');
        $time1=strstotime(I('get.time1'));
        $time2= strtotime(I('get.time2'));
        $orderModel=D('Order');

        //根据用户名模糊查询
        if($username){

            $where="b.username like'%".$username."%'";
            $data=$orderModel->filed('a.order_code,b.username,c.goods_name,a.order_count')
                ->join('a left join sh_user b on a.user_id=b.user_id')
                ->join('left join sh_goods c on a.goods_id=c.goods_id')
                ->where($where)
                ->select();


        }
        if($time1&&$time2){
            $data=$orderModel->filed('a.order_code,b.username,c.goods_name,a.order_count')
                ->join('a left join sh_user b on a.user_id=b.user_id')
                ->join('left join sh_goods c on a.goods_id=c.goods_id')
                ->where("a.order_time  between $time1 and $time2")
                ->select();
        }

        echo json_encode($data);


        /*
          会员表 sh_user
          user_id
          username  用户名
          password   密码
          phone      手机

           订单表 sh_order
          order_id    订单ID
          order_code  订单号
          goods_id  商品id
          user_id   下单人ID
          order_count   订购数量
          order_time  下单时间

            商品表  sh_goods
            goods_id   商品ID
            goods_name  商品名称
            goods_price  价格
            goods_sn   货号
            goods_num   库存
            goods_img   图片
            goods_descp   商品介绍
          */

    }

    public function login(){

        $data=I('post.');
        $model=D('User');

        $where=array('name'=>$data['name']);
        $info=$model->where($where)->find();//查询用户名相同的记录
        if($info){
            if( $data['passwd']==$info['passwd'] ){//判断密码是否相同

                $this->success('登录成功',U('Main/index'));exit;
            }else{
                $this->error('密码错误！');
            }

        }else{
            $this->error('用户名不存在');
        }



    }


}
