<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/31
 * Time: 20:22
 */

namespace Admin\Model;
use Think\Model;

class UserModel extends Model{
    //数据提交自动验证
    protected $_validate=array(
        array('captcha','_checkCode','验证码错误',1,'callback',4),

        array('username','require','用户名不能为空'),
        array('password','require','密码不能为空',1,'regex',1),

        array('repwd','password','确认密码不一致',1,'confirm',1),
        array('repwd','password','确认密码不一致',1,'confirm',2),
//
        array('email','require','邮箱不能为空'),
        array('email','email','邮箱格式不正确'),

        array('username','','用户名已存在',1,'unique', 1),
        array('username','','用户名已存在',1,'unique',2),

        array('password','','邮箱已存在',1,'unique',1),
        array('password','','邮箱已存在',1,'unique',2)
    );

    protected  function _checkCode($code){
        $verify=new \Think\Verify();
        return $verify->check($code,'');
    }

    //自动完成时间
    protected  $_auto=array(
      array('add_time','time',1,'function'),
    );

    //添加数据前的回调函数
    public function _before_insert(&$data, $options)
    {
       $salt=uniqid();//随机字符串
        $data['salt']=$salt;
        $data['login_ip']=ip2long($data['login_ip']);
        //双重加密密码
       $data['password'] = md5(md5($data['password']).$salt);
    }

    //修改数据前的回调函数
    public function _before_update(&$data, $options)
    {
       if($data['password']){
           $salt=uniqid();
           $data['password']=md5(md5($data['password']).$salt);
       }else{
           unset($data['password']);
       }

    }

    //登录验证
    public function login(){
        $username=$this->username;
        $password=$this->password;

        $where=array('username'=>$username);
        $info=$this->where($where)->find();//查询用户名相同的记录
        $salt=$info['salt'];//取出盐
        if($info){
            if( md5( md5($password).$salt)==$info['password']  ){//判断密码是否相同
                session('id',$info['id']);//把用户ID保存到session
                session('username',$info['username']);
                $this->_updInfo($info['id']);
                $this->_roleAuth($info['role_id']);
                return true;
            }else{
                return false;
            }
        }
    }

    //权限验证
    private function _roleAuth($role_id){
        $roleModel=D('Role');
        $authModel=D('Auth');
        //根据用户的角色id查找出对应的权限ID
        $roleInfo=$roleModel->field('role_id_list')->find($role_id);

        if($roleInfo['role_id_list']=='*'){//超级管理员
            session('auth','*');

        //顶级菜单
            $menu=$authModel->where('auth_pid=0')->select();

            foreach($menu as $k=>$v){
                //二级菜单
                $menu[$k]['sub']=$authModel->where('auth_pid='.$v['auth_id'])->select();
            }
            session('menu',$menu);

        }else{
            //普通用户

            //查找出权限表的ID属于角色权限中
            $authInfo=$authModel
                ->field('auth_id,auth_name,auth_c,auth_a,concat(auth_c,"/",auth_a) as url,auth_pid')
                ->where('auth_id in ('. $roleInfo['role_id_list'] .')')
                ->select();

            $menu=array();
            //将获取的控制器和方法转换成一维数组
            $authData=array();
            foreach($authInfo as $k => $v){
                if($v['auth_pid']==0){
                    $menu[]=$v;
                }
                $authData[]=$v['url'];
            }

            //菜单验证
            foreach($menu as $k => $v){
                foreach($authInfo as $key =>$val){
                    if($val['auth_pid']==$v['auth_id']){
                        $menu[$k]['sub']=$val;
                    }
                }
            }
            session('menu',$menu);
            session('auth',$authData);
        }

    }

    private function _updInfo($userid){
        $data=array(
          'id'=>$userid,
          'login_ip'=>ip2long(get_client_ip()),
           'login_time'=>time()
        );

        $this->save($data);
    }

    public function login_time($username){
       return   $this->save(array('username'=>$username,'login_time'=>time()));
    }
}

