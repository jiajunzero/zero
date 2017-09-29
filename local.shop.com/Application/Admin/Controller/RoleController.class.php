<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/4
 * Time: 10:23
 */

namespace Admin\Controller;

class RoleController extends CommonController{

    //增加角色
    public function add(){
        if(IS_POST){
            $roleModel=D('Role');
            if($roleModel->create()) {

                if ($roleModel->add()) {
                    $this->success('添加成功',U('lst'));exit();
                }else{
                    $this->error('添加失败'.$roleModel->getDbError());
                }
            }else{
                $this->error('验证失败！'.$roleModel->getError());
            }

        }

        $tree=D('Auth')->getTree();
        $this->assign('tree',$tree);
        $this->display();
    }

    //角色列表
    public function lst(){
        $roleModel=D('Role');

        $data=$roleModel
            ->field('a.*,group_concat(b.auth_name) as auth_name')
            ->join('a left join sh_auth b on find_in_set(b.auth_id,a.role_id_list)')
            ->group('a.role_id')
            ->select();

        $this->assign('data',$data);
        $this->display();
    }

    //角色修改
    public function upd(){
        $roleModel=D('Role');
        if(IS_POST){
            if($roleModel->create()){
                if($roleModel->save()){
                    $this->success('编辑成功',U('lst'));exit();
                }else{
                    $this->error('编辑失败'.$roleModel->getDbError());
                }
            }else{
                $this->error('验证失败！'.$roleModel->getError());
            }

        }

        //查找需要编辑的数据 实现回显
        $row=$roleModel->where( array('role_id'=>I('get.role_id') ) )->find();

        $tree=D('Auth')->getTree();
        $this->assign('row',$row);
        $this->assign('tree',$tree);
        $this->display();


    }

    //删除用户
    public function del(){
        if(IS_AJAX){
            $roleModel=D('Role');
            if(I('role_id')=='1'){
                echo json_encode(array('error'=>1,'info'=>'超级管理员不能删除'));exit();
            }
            if($roleModel->delete(I('role_id'))){
                echo json_encode(array('error'=>0,'info'=>'删除成功'));exit();
            }else{
                echo json_encode(array('error'=>2,'info'=>'无法删除'));
            }
        }
    }
}