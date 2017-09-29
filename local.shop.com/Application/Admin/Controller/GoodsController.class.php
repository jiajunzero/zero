<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/5
 * Time: 20:07
 */
namespace Admin\Controller;

class GoodsController extends CommonController{

    //添加商品
    public function add(){


        if(IS_POST){
            
            $goodsModel=D('Goods');
            if($goodsModel->create()){
                if($goodsModel->add()){
                    $this->success('添加成功',U('lst'));exit();
                }else{
                    $this->error('添加失败！'.$goodsModel->getDbError());
                }
            }else{
                $this->error('验证失败！'.$goodsModel->getError());
            }
        }

        //商品分类数据
        $cateModel=D('Category');
        $cateInfo=$cateModel->getTree();
        $this->assign('cateInfo',$cateInfo);

        //商品类型数据
        $typeModel=D('Type');
        $typeData=$typeModel->select();
        $this->assign('typeInfo',$typeData);

        $this->display();
    }

    public function lst(){

        $goodsModel=D('Goods');
        $data=$goodsModel->search();
        $this->assign($data);
        $this->display();
    }

    //伪删除
    public function del(){
        if(IS_AJAX){
            $goodsModel=M('Goods');
            $goods_id=I('get.goods_id');

           $status= $goodsModel->where(array('goods_id'=>$goods_id))->setField('is_delete',1);
            if($status!==false){
                echo json_encode(array('error'=>0,'info'=>'加入回收站成功'));exit;
            }else{
                echo json_encode(array('error'=>1,'info'=>'加入回收站失败！'));
            }
        }
    }

    public function upd(){
        $goodsModel=D('Goods');
        if(IS_POST){
            if($goodsModel->create()){

                if($goodsModel->save()!==false){
                    $this->success('编辑成功',U('lst'));exit;
                }else{
                    $this->error('编辑失败'.$goodsModel->getDbError());
                }
            }else{
                $this->error('验证失败！'.$goodsModel->getError());
            }
        }

        $goods_id=I('get.goods_id');
        $data=$goodsModel->find($goods_id);

        //商品分类
        $cateModel=D('Category');
        $cateData=$cateModel->getTree();

        //商品类型
        $typeData=D('Type')->select();

        $this->assign('typeData',$typeData);
        $this->assign('cateData',$cateData);
        $this->assign('data',$data);
        $this->display();
    }


    //详情页
    public function content(){
        $goodsModel=M('Goods');
        $goods_id=I('get.goods_id');
        $content=$goodsModel->find($goods_id);//查询出对应的数据

        $this->assign('content',$content);
        $this->display();
    }

    //获取商品类型的属性
    public function getAttr(){
        if(IS_AJAX){
            $type_id=I('get._type_id');
            $attrModel=M('Attr');
            $data=$attrModel->where('type_id='.$type_id)->select();
            if($data){
                echo json_encode(array(
                    'error'=>0,
                    'data'=>$data
                ));
            }else{
                echo json_encode(array(
                    'error'=>1,
                    'data'=>'暂无属性'
                ));
            }

        }
    }
}