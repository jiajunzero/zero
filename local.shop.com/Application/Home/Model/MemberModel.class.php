<?php

namespace Home\Model;
use Think\Model;
class MemberModel extends Model{

    //自动验证
    protected $_validate=array(
      array('capt','checkcapt','验证码错误',1,'callback',4),
      array('username','require','用户名不能为空'),
      array('password','require','密码不能为空'),
    );

    protected function checkcapt($capt){
        $verify = new \Think\Verify();
        return $verify->check($capt,'');

    }

    public function _before_insert(&$data, $options)
    {


       $data['password']=md5( $data['password']);
       $data['add_time']=time();
    }

    //插入后钩子 163邮箱
//    public function  _after_insert($data,$options){
//        $email=$data['email'];
//        $user_id=$data['id'];
//        $content="用户：<a href=".C('SHOP_URL')."index.php/Home/Member/active/id/".$user_id.">点击激活</a>";
//
//        sendMail($email, '家俊','测试邮件',$content );
//    }

    //zendCloud
    public function _after_insert($data, $options)
    {
        $id=$data['id'];
        $email=$data['email'];
        $username=$data['username'];

        //载入第三方类库
        vendor('SendCloud.Mailer');//类库路径，用.号作为目录分隔符
        $mailer=new \Mailer();

        $token=md5(C('SHOP_STR').$id);//数字签名 防止用户在浏览器篡改id

        $url=C('SHOP_URL').'index.php/Home/Member/active/id/'.$id.'/token/'.$token;
         $data = [
             'name' => $username,
             'url' => $url,
             'time' => date('Y-m-d H:i:s')
         ];

         $res = $mailer->welcome($email, $data);
//        dump($token);die;
        if(!$res['result']){
            $this->error=$res['message'];
            return false;
        }
    }

    public function login(){

       $username=$this->username;
       $password=$this->password;

       $memData=$this->where("username='$username'")->find();
       if($memData){
            if(md5($password)==$memData['password']){
                session('id',$memData['id']);
                session('username',$memData['username']);
                return true;
            }else{
               return 2;
            }
       }else{
           return 1;
       }

    }

}