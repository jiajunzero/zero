<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/5
 * Time: 18:11
 */

namespace Admin\Model;
use Think\Model;

class AttrModel extends Model{

    protected $_validate=array(
      array('attr_name','require','属性名称不能为空')

    );
}