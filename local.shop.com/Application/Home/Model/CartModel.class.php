<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/13
 * Time: 15:02
 */

namespace Home\Model;

use Think\Model;

class CartModel extends Model{

    //添加到购物车
    public function addToCart($goodsId,$amount,$attrId){

        //登录 非登录
        $memId=session('id');

        if($memId){
            //判断用户是否把相同的商品加入过购物车
            $where="goods_id=$goodsId  and goods_attr_id='$attrId' and mem_id=$memId";
            $info=$this->where($where)->find();
            if($info){
                //如果添加过购物车 就把商品的数量加起来
                $this->where($where)->setInc('goods_count',$amount);
            }else{
                $data=array(
                  'goods_id'=>$goodsId,
                  'goods_count'=>$amount,
                  'goods_attr_id'=>$attrId,
                  'mem_id'=>$memId
                );
                $this->add($data);//添加到数据库
            }

        }else{
            //没有登录
            //判断用户是否有添加商品到购物车 如果有cookie值就把他序列化 否则定义一个空数组
            $cart=isset( $_COOKIE['cart'] )?unserialize($_COOKIE['cart']):array();

            $key=$goodsId.'-'.$attrId;//把商品ID跟属性ID连接起来 作为数组的下标
            if($cart[$key]){
                $cart[$key]+=$amount;
            }else{
                $cart[$key]=$amount;
            }

            $time=time()+3600*24*7;//有效期
            setcookie('cart',serialize($cart),$time,'/');
        }
    }

    public function cartList(){

        $memId=session('id');
        if($memId){//用户有登录
            //查询出订单表的数据 二维数组
            $cartData=$this->where('mem_id='.$memId)->select();
        }else {
            //没有登录 获取cookie的数据
            $cartCookie = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();

            //把获取的cookie数据变成二维数组
            $cartData = array();
            foreach ($cartCookie as $k => $v) {
                $_key = explode('-', $k);//根据-分隔字符串 组成数组
                $cartData[] = array(
                    'goods_id' => $_key[0],
                    'goods_attr_id' => $_key[1],
                    'goods_count' => $v,
                );
            }

        }
            $goodsModel=M('Goods');//商品模型
            $attrsModel=M('Goods_attrs');
            //根据cookie信息获取模板需要展示的订单的信息 （商品名称 商品图片 商品价格 商品属性 购买数量）
            $num=0;
            foreach($cartData as $key => $val ){

                $cartData[$key]['info']=$goodsModel->field('goods_name,goods_thumb,goods_price')->find($val['goods_id']);

                if($val['goods_attr_id']){
                    $att=$attrsModel
                        ->field('group_concat( concat(b.attr_name,":",a.goods_attr_values) separator "<br/>" ) as att')
                        ->join('a left join sh_attr b on a.attr_id=b.attr_id')
                        ->where("a.attrs_id in (".$val['goods_attr_id'].")")
                        ->find();
                    $cartData[$key]['att']=$att['att'];
                }else{
                    $cartData[$key]['att']='';
                }
                $num+= $cartData[$key]['info']['goods_price']*$cartData[$key]['goods_count'];
                $cartData[$key]['prices']=$num;

            }
            return $cartData;
    }

    //转存
    public function moveCart(){

        $memId=session('id');
        if($memId){
            $cartCookie=isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array();
            foreach($cartCookie as $k => $v){
                $key=explode('-',$k);
                $where='goods_id='.$key[0].'and goods_attr_id='."$key[1]".'and mem_id='.$memId;
                $row=$this->where($where)->find();
                if($row){
                    $this->where($where)->setInc('goods_count',$v);
                }else{
                    $data=array(
                      'goods_id'=>$key[0],
                        'goods_attr_id'=>$key[1],
                        'goods_count'=>$v,
                        'mem_id'=>$memId
                    );

                    $this->add($data);
                }

            }
            setcookie('cart','',time()-1,'/');
        }
    }

    //清空购物车
    public function clearCart(){
        $memId=session('id');
        if($memId){
            $this->where('mem_id='.$memId)->delete();
        }
    }

}