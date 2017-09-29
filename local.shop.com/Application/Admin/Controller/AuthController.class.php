<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/2
 * Time: 20:48
 */
namespace Admin\Controller;

class AuthController extends CommonController{

    //增加权限
    public function add(){
        $authModel=D('Auth');
        if(IS_POST){

            if($authModel->create()){
                if($authModel->add()){
                    $this->success('添加成功',U('Auth/lst'));exit();
                }else{
                    $this->error('添加失败'.$authModel->getDbError());
                }
            }else{
                $this->error('验证失败！'.$authModel->getError());
            }
        }


        $tree=$authModel->getTree();
        $this->assign('tree',$tree);
        $this->display();
    }

    public function lst(){

        $authModel=D('Auth');
        $data=$authModel->getTree();
        $this->assign('data',$data);
        $this->display();
    }

    //无刷新删除
    public function del(){
        if(IS_AJAX){
            $authModel=D('Auth');
            $auth_id=I('get.auth_id');
            $status=$authModel->checkChild($auth_id);

            if($status){
                echo json_encode(array('error'=>1,'info'=>'无法删除！权限下有子权限'));exit();
            }
                $authModel->delete($auth_id);
                echo json_encode(array('error'=>0,'info'=>'删除成功'));exit();

        }
    }

    //修改页
    public function upd(){


        $authModel=D('Auth');

        if(IS_POST){
//            dump($authModel->create());die;
            //创建数据对象 自动验证
            if( $authModel->create() ){

                if( $authModel->save() !==false){//修改数据
                    $this->success('编辑成功',U('lst'));exit();
                }else{
                    $this->error('编辑失败！'.$authModel->getDbError());
                }
            }else{
                $this->error('验证失败！'.$authModel->getError());
            }
        }



        $auth_id=I('get.auth_id');
        //查找满足条件的数据
        $row=$authModel->where(array('auth_id'=>$auth_id))->find();

        $tree=$authModel->getTree();//无限极权限分类

        //获取到所有的主键id 自定义方法
        $ids=$authModel->getChild($auth_id);
        $ids[]=$auth_id;//包含当前id

        $this->assign('ids',$ids);
        $this->assign('row',$row);
        $this->assign('tree',$tree);
        $this->display();
    }

}