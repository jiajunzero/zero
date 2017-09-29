<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/5
 * Time: 8:29
 */

namespace Admin\Controller;

class TypeController extends CommonController{

    //增加商品类型
    public function add(){
        if(IS_POST){
            $typeModel=D('Type');
            if($typeModel->create()){
                if($typeModel->add()){
                    $this->success('添加成功',U('lst'));exit;
                }else{
                    $this->error('添加失败！'.getDbError());
                }
            }else{
                $this->error('验证失败！'.$typeModel->getError());
            }
        }

        $this->display();
    }

    //商品类型列表
    public function lst(){

        $typeModel=D('Type');
        $typeData=$typeModel->select();
        $this->assign('typeData',$typeData);
        $this->display();
    }
}