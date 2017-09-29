<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/2
 * Time: 20:05
 */

namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{

    public function __construct(){

        parent::__construct();
        if(!session('?id')){
            $this->success('请先登录',U('Back/login'));exit();
        }

        //检验权限  一般把公共的操作放到配置文件
        if(CONTROLLER_NAME=='Index'){
            return true;
        }

        $ConAct=CONTROLLER_NAME.'/'.ACTION_NAME;

        if(session('auth')!='*' && !in_array($ConAct,session('auth'))){
            $this->error('无权访问',U('Index/index'));
        }
    }

}