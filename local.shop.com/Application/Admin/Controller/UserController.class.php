<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/31
 * Time: 20:05
 */

namespace Admin\Controller;
use Admin\Controller\CommonController;

class UserController extends  CommonController{
    public function add(){
        //添加用户处理
        if(IS_POST){//表单提交
            //实例化模型类
            $userModel=D('User');
            //创建数据对象 进行自动验证
            if($userModel->create()){
                //验证通过添加入库
                if($userModel->add()){
                    $this->success('添加成功!',U('lst'));exit();
                }else{
                    $this->error('添加失败',$userModel->getDbError());//mysql级别错误
                }
            }else{
                //验证不通过
                $this->error('验证失败'.$userModel->getError());
            }
        }
        $roleInfo=M('Role')->select();
        $this->assign('roleInfo',$roleInfo);

        $this->display();
    }

    //展示用户信息
    public function lst(){
//        实现分页
        $User = M('User'); // 实例化User对象
        $count      = $User->count('id');// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(2)

        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $lsts = $User
            ->field('a.*,b.role_name')
            ->join('a left join sh_role b on a.role_id=b.role_id')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();


//        if(IS_AJAS){
////
//            $content=array(
//              'page'=>$show,
//              'data'=>$this->fetch('User:data')
//            );
////            $this->assign('lsts',$lsts);  // 赋值数据集
//            echo  json_encode($content);die;
//        }     $
        $this->assign('lsts',$lsts);  // 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板

    }

    //修改用户信息
    public function upd(){

        $userModel=D('User');
        //表单提交处理
        if(IS_POST){

            if($userModel->create()){
                if ($userModel->save()!==false){
                    $this->success('编辑成功',U('lst'));exit();
                }else{
                    $this->error('编辑失败！'.$userModel->getDbError());
                }
            }else{
                $this->error('验证失败！'.$userModel->getError());
            }
        }

        $roleInfo=M('Role')->select();
        $this->assign('roleInfo',$roleInfo);

        //回显用户信息

        $row=$userModel->find(I("get.id"));
        $this->assign('row',$row);
        $this->display();
    }

    //删除记录
    public function del(){
        //接收数据
//        $id=I('get.id');
//        //利用模型对象删除数据
//        $userModel=D('User');
//        $con=$userModel->delete($id);
//        if($con){
//            $this->redirect(('Admin/User/lst'));
//        }else{
//            $this->error('系统繁忙');
//        }

        //无刷新删除
        if(IS_AJAX){
            $u_id=I('get.u_id');//接收数据

            $userModel=D('User');
            if($u_id==1){
               echo json_encode(array('errCode'=>1,'info'=>'超级管理员不能删除'));
            }else{
                if($userModel->delete($u_id)){
                    echo json_encode(array('errCode'=>0,'info'=>'删除成功'));
                }else{
                    echo json_encode(array('errCode'=>1,'info'=>'系统繁忙'));
                }
            }

        }
    }


}