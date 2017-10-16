<?php
/**
 * @Author: YouLong
 * @Date:   2016-09-06 13:57:13
 * @Last Modified by:   YouLong
 * @Last Modified time: 2016-09-06 14:00:00
 */
header("Content-type: text/html; charset=utf8");
function format_date($time){
    $t=time()-$time;
//<span style="white-space:pre">    </span>//echo time();
    $f=array(
        '31536000'=>'年',
        '2592000'=>'个月',
        '604800'=>'星期',
        '86400'=>'天',
        '3600'=>'小时',
        '60'=>'分钟',
        '1'=>'秒'
    );
    foreach ($f as $k=>$v)    {
        if (0 !=$c=floor($t/(int)$k)) {
            return $c.$v.'前';
        }
    }
}
echo format_date("1470795010");