<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/5
 * Time: 18:59
 */

namespace Admin\Model;

use Think\Model;

class CategoryModel extends Model{

    protected $_validate=array(

      array('cate_name','require','分类名称不能为空'),
    );

    //查询所有数据
    public function  getTree(){
        return $this->order('path')->select();
    }

    //插入后的钩子 定义层级关系
    public function _after_insert($data, $options){
       $cate_id=$data['cate_id'];

       if($data['pid']==0){
           $con=array(
             'cate_id'=>$cate_id,
               'path'=>$cate_id
           );

       }else{
           $parent=$this->find($data['pid']);
           $con=array(
             'cate_id'=>$cate_id,
               'path'=>$parent['path'].'-'.$cate_id,
           );
       }
        $this->save($con);
    }

    //前台获取三级分类
    public function getCate(){
        $data=$this->select();//获取所有分类
        $cate=array();//空数组用来保存三级分类数据

        //循环得到三级分类
        foreach($data as $k1 => $v1){
            if($v1['pid']==0){//顶级分类
                foreach( ($data) as $k2 => $v2 ){
                    if($v2['pid']==$v1['cate_id']){//二级分类
                        foreach( $data as $k3 =>$v3 ){
                            if($v3['pid']==$v2['cate_id']){//三级分类
                                $v2['children'][]=$v3;
                            }
                        }
                        $v1['children'][]=$v2;
                    }
                }
                $cate[]=$v1;
            }
        }
        return $cate;
    }

}