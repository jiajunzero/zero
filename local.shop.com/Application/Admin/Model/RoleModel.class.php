<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/4
 * Time: 10:36
 */

namespace Admin\Model;
use Think\Model;

class RoleModel extends Model{

    //角色自动验证
    protected $_validate=array(
      array('role_name','require','角色名称不能为空')
    );

    //添加钩子
    public function _before_insert(&$data, $options)
    {
        //将对应的权限数组转换成字符串
       $data['role_id_list']=implode(',',$data['role_id_list']);
    }

    //修改钩子
    public function _before_update(&$data, $options)
    {
        //将对应的权限数组转换成字符串
        $data['role_id_list']=implode(',',$data['role_id_list']);
    }
}