<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/12
 * Time: 11:25
 */

namespace Admin\Model;
namespace Think\Model;

class UserModel extends Model{

    /*
     * 0 .
        有tp_user表结构如下：
        id  用户id
        name  用户名
        passwd 用户密码
        roleid  用户角色id
        addtime   创建用户时间。
        使用ThinkPHP自定义模型的自动验证和自动完成功能，验证表单项并补全信息。规则如下：
        1. 用户名： 必须为6-12位字母数字下划线
        2. 密码： 密码不能为空
        3. 两次密码必须一致
        4. 自动补全roleid为 1
        5. 自动补全addtime为当前时间的 年-月-日 时:分:秒 格式
        6. 必须给出模型的完整代码，包含文件名，内部结构，类，字段定义，字段验证，自动完成*/


    protected $_validate=array(
        array('name','6,12','验证码错误',1,'length'),
        array('passwd','require','密码不能为空'),
        array('repwd','passwd','确认密码不一致',1,'confirm'),
    );

    protected $_auto=array(
        array('roleid','1'),
        array('addtime','getTime',1,'callback')

    );

    private function getTime(){
        return date('Y-m-d H:i:s',time());
    }


}