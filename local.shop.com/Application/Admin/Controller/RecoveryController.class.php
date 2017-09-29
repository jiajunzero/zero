<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/6
 * Time: 8:59
 */

namespace Admin\Controller;

class RecoveryController extends CommonController{

    //回收站列表
    public function lst(){

        $goodsModel=M('Goods');
        $goodsData=$goodsModel->where(array('is_delete'=>1))->select();
        $this->assign('lsts',$goodsData);
        $this->display();
    }

    //还原商品
    public function reback(){
        $goodsModel=M('Goods');
        $goods_id=I('get.goods_id');
        $status=$goodsModel->where(array('goods_id'=>$goods_id))->setField('is_delete',0);
        if($status!==false){
            $this->success('还原成功',U('goods/lst'));exit();
        }else{
            alert('还原失败');
        }
    }

    //无刷新彻底删除
    public function del(){
        if(IS_AJAX){
            $goodsModel=M('Goods');
            $goods_id=I('get.goods_id');

            $status=$goodsModel->delete($goods_id);
            if($status!==false){
                echo json_encode(array('error'=>0,'info'=>'删除成功'));exit();
            }else{
                echo json_encode(array('error'=>1,'info'=>'删除失败'));
            }
        }
    }


}