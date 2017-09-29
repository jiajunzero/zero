<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/2
 * Time: 15:34
 */
namespace Admin\Controller;
use Think\Controller;
class BackController extends Controller{

    //登录页
    public function login(){

        if(IS_POST){
            $userModel = D('User');
            $data=I('post.');
            if( $userModel->create( $data,4) ){
                $status=$userModel->login();
                if($status){

                    $this->success('登录成功',U('Index/index'));exit;
                }else{
                    $this->error('用户名或密码错误！');
                }
            }else{
                $this->error('验证失败！'.$userModel->getError());
            }
        }

        $this->display();
    }

    //验证码
    public function captcha(){
        $config = array(
            'imageH'    =>  40,    // 验证码图片高度
            'imageW'    =>  100,   // 验证码图片宽度
            'fontSize'  =>  17,    // 验证码字体大小
            'length'    =>  3,     // 验证码位数
            'useNoise'  =>  false, // 关闭验证码杂点
            'useCurve'  =>  false, // 是否画混淆曲线
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    public function loginOut(){
        session(null);
        $this->success('退出成功！',U('login'));
    }
}