<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/5
 * Time: 18:57
 */

namespace Admin\Controller;

class CategoryController extends CommonController{

    //添加商品分类
    public function add(){
        $cateModel=D('Category');
        if(IS_POST){

            if($cateModel->create()){
                if($cateModel->add()){
                    $this->success('添加成功',U('lst'));exit();
                }else{
                    $this->error('添加失败！'.$cateModel->getDbError());exit();
                }

            }else{
                $this->error('验证失败！'.$cateModel->getError());
            }
        }

        $cateInfo=$cateModel->getTree();
        $this->cateInfo=$cateInfo;
        $this->display();
    }

    public function lst(){

        $cateModel=D('Category');
        $cateInfo=$cateModel->getTree();
        $this->assign('cateInfo',$cateInfo);
        $this->display();
    }

}

