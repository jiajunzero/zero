<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/14
 * Time: 9:38
 */

namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller{

    //核对订单
    public function account(){
        $memId=session('id');
        //判断是否登录
        if(!$memId){
            //没有登录把当前结算页面地址保存起来
            session('accountUrl',U('Cart/cartList'));
            $this->success('请先登录！',U('Member/login'));exit();
        }

        $cartModel=D('Cart');
        $cartData=$cartModel->cartList();
        $this->assign('cartData',$cartData);
        $this->display();
    }

    //提交订单结算
    public function subOrder(){
        $memId=session('id');//下单人ID
        $shrInfo=I('post.');//收货人信息

        #检查购物车是否为空
        $cartModel=D('Cart');
        $cartData=$cartModel->cartList();
        if(count($cartData)<1){
            $this->error('购物车为空,请添加商品');
        }

        #检查库存  计算总价
        $goodsModel=M('Goods');
        $prices=0;
        foreach($cartData as $k => $v){
            $num=$goodsModel->field('goods_num')->find($v['goods_id']);
            if($v['goods_count']>$num){
                $this->error($v['info']['goods_name'].'　库存不足');
            }
            $prices+=$v['info']['goods_price']*$v['goods_count'];
        }

        #生成订单
        $orderCode=date('YmdHis').uniqid();//订单号
        $shrData=array(//收货人信息
          'order_code' =>$orderCode,
          'mem_id'     =>$memId,
          'shr'        =>$shrInfo['shr'],
          'address'    =>$shrInfo['address'],
          'phone'      =>$shrInfo['phone'],
          'zcode'      =>$shrInfo['zcode'],
          'total_price'=>$prices,
          'add_time'   =>time(),
        );

        $shrModel=M('OrderMember');
        $status=$shrModel->add($shrData);

        //如果收货人信息入库成功 把对应的商品信息入库
        if($status>0){
            $orgModel=M('OrderGoods');
            foreach ($cartData as $k=>$v){
                $goodsData=array(
                    'order_code'   =>$orderCode,
                    'goods_id'     =>$v['goods_id'],
                    'goods_attr_id'=>$v['goods_attr_id'],
                    'goods_num'    =>$v['goods_count'],
                    'goods_price'  =>$v['info']['goods_price'],
                );
                $orgModel->add($goodsData);
                //对应的库存减少
                $goodsModel->where('goods_id='.$v['goods_id'])->setDec('goods_num',$v['goods_count']);
            }
        }

        //清空购物车
        $cartModel->clearCart();
        echo '请支付';

    }
}