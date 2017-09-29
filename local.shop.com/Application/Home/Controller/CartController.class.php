<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/13
 * Time: 10:41
 */

namespace Home\Controller;
use Think\Controller;

class CartController extends Controller{

    //添加到购物车
    public function addToCart(){

        $cartInfo=I('post.');//添加到购物车的信息

        //把商品的属性值用，号拼接起来 提交的信息是一个数组 需要把不是属性的其他信息清除
        unset($cartInfo['goods_id']);
        unset($cartInfo['amount']);

        $attrId=implode(',',$cartInfo);//属性值
        //把清除掉的信息重新获取到 因为还要利用到
        $goodsId=I('post.goods_id');//商品id
        $amount=I('post.amount');//购买数量

    // 调用方法判断用户是否登录
        $cartModel=D('Cart');
        $cartModel->addToCart($goodsId,$amount,$attrId);

        $this->success('添加购物车成功！',U('cartList'));exit();

    }

    //展示购物车信息
    public function cartList(){
        $cartModel=D('Cart');
        $cartData=$cartModel->cartList();

        $this->assign('cartData',$cartData);
        $this->display();
    }

    //利用ajax修改购买数量
    public function ajaxUpd(){
        $goodsId=I('get.goodsId');
        $attrIds=I('get.attrIds');
        $flag=I('get.flag');
        $cartModel=M('Cart');

        $memId=session('id');
        if($memId){//用户登录状态
            $where="goods_id=$goodsId and goods_attr_id='$attrIds' and mem_id=$memId";
            $row=$cartModel->where($where)->find();
            if($row && $row['goods_count']<200 && $flag=='+'){
                $cartModel->where($where)->setInc('goods_count');
                echo 'ok';exit();
            }
            if($row && $row['goods_count']>1 && $flag=='-'){
                $cartModel->where($where)->setDec('goods_count');
                echo 'ok';exit();
            }

            echo 'not';exit();

        }else{//无登录状态
            $cartCookie=isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();

            $_key=$goodsId.'-'.$attrIds;
            if($cartCookie[$_key] && $cartCookie[$_key]<200 && $flag=='+'){
                $cartCookie[$_key]+=1;
                setcookie('cart',serialize($cartCookie),time()+3600*24*7,'/');
                echo 'ok';exit();
            }
            if($cartCookie[$_key] && $cartCookie[$_key]>1 && $flag=='-'){
                $cartCookie[$_key]-=1;
                setcookie('cart',serialize($cartCookie),time()+3600*24*7,'/');
                echo 'ok';exit();
            }
            echo 'not';exit();
        }
    }
}