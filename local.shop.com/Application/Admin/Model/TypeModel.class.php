<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/5
 * Time: 8:44
 */

namespace Admin\Model;
use Think\Model;

class TypeModel extends Model{

    protected $_validate=array(
      array('type_name','require','商品类型名称不能为空'),
    );
}