<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/5
 * Time: 10:06
 */

namespace Admin\Controller;

class AttrController extends CommonController{

    public function add(){

        if(IS_POST){
            $attrModel=D('attr');
            if($attrModel->create()){
                if($attrModel->add()){
                    $this->success('添加成功',U('lst'));exit();
                }else{
                    $this->error('添加失败');
                }

            }else{
                $this->error('验证失败！'.$attrModel->getError());
            }
        }
        $typeModel=M('Type');
        $typeInfo=$typeModel->select();
        $this->typeInfo=$typeInfo;
        $this->display();
    }

    public function lst(){

        $attrModel=M('Attr');
        $lsts=$attrModel->select();
        $this->lsts=$lsts;

        $typeModel=M('Type');
        $typeInfo=$typeModel->select();
        $this->typeInfo=$typeInfo;
        $this->display();
    }

    public function AjaxAttr(){

        if(IS_AJAX){
            $type_id=I('get.type_id');
            $attrModel=M('Attr');
            //查询出属性的分类ID符合提交的分类ID的所有数据
            $attrData=$attrModel->where(array('type_id'=>$type_id))->select();
            if($type_id==0){
                $attrData=$attrModel->select();
            }
            if($attrData){
                $json=array(
                  'error' => 0,
                  'data' =>$attrData,
                );
            }else{
                $json=array(
                  'error'=>1,
                  'data' =>'获取失败'
                );
            }

            echo json_encode($json);
        }
    }

    public function del(){
        if(IS_AJAS){
            $attrModel=M('Attr');
            $status=$attrModel->delete(I('get.attr_id'));
            if($status!==false){
               $json= array('error'=>0,'info'=>'删除成功');
            }else{
                $json=array('error'=>1,'info'=>'系统繁忙');
            }

            echo json_encode($json);
        }
    }

}