<?php
/**
 * @Author: YouLong
 * @Date:   2016-09-06 14:02:01
 * @Last Modified by:   YouLong
 * @Last Modified time: 2016-09-06 14:02:12
 */
header("Content-type: text/html; charset=utf8");
function formatTime($date) {
    $str = '';
    $timer = strtotime($date);
    $diff = $_SERVER['REQUEST_TIME'] - $timer;
    $day = floor($diff / 86400);
    $free = $diff % 86400;
    if($day > 0) {
        return $day."天前";
    }else{
        if($free>0){
            $hour = floor($free / 3600);
            $free = $free % 3600;
                if($hour>0){
                    return $hour."小时前";
                }else{
                    if($free>0){
                        $min = floor($free / 60);
                        $free = $free % 60;
                        if($min>0){
                            return $min."分钟前";
                        }else{
                            if($free>0){
                                return $free."秒前";
                            }else{
                                return '刚刚';
                            }
                       }
                    }else{
                        return '刚刚';
                    }
               }
       }else{
           return '刚刚';
       }
    }
}
echo formatTime("2014-7-8 19:22:01");