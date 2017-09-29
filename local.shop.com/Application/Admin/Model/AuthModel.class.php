<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/2
 * Time: 21:02
 */

namespace Admin\Model;
use Think\Model;

class AuthModel extends Model{

    //自动验证
    protected  $_validate=array(
      array('auth_name','require','权限名称不能为空'),
      array('auth_c','require','权限控制器不能为空'),
      array('auth_a','require','权限方法不能为空'),
      array('auth_pid','require','父类权限不能为空'),
    );


    //无限极分类
    public function getTree(){
       $data= $this->select();
        return $this->_getTree($data);
    }


    public function _getTree($data,$pid=0,$level=0){

        static $list=array();
        foreach($data as $k => $v){
            if($v['auth_pid']==$pid){
                $v['level']=$level;
                $list[]=$v;
                $this->_getTree($data,$v['auth_id'],$level+1);

            }
        }
        return $list;
    }

    //查询有没有子分类权限
    public function  checkChild($auth_id){
        $where=array('auth_pid'=>$auth_id);
        return $this->where($where)->find();
    }

    //获取权限表指定ID下的子权限id
    public function getChild($auth_id){
        $data= $this->select();
        return  $this->_getChild($data,$auth_id);
    }

    public  function  _getChild($data,$auth_id){
        static $ids=array();//定义一个空数组 用来保存满足条件的ID
        foreach($data as $k => $v){
            if($v['auth_pid']==$auth_id) {//当数据表的pid等于接收的ID 说明表中的权限是当前权限的子类

                $ids[]=$v['auth_id'];//把是当前权限的子权限id保存到数组
                $this->_getChild($data,$v['auth_id']);//递归调用 查出所有的子权限
            }
        }
        return $ids;//返回所有满足的子权限ID

    }
}

