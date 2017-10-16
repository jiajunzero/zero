<?php
/**
 * @Author: YouLong
 * @Date:   2016-09-06 13:50:08
 * @Last Modified by:   YouLong
 * @Last Modified time: 2016-09-06 13:52:59
 */
    header("Content-type: text/html; charset=utf8");
    date_default_timezone_set("Asia/Shanghai");   //设置时区
    function time_tran($the_time) {
        $now_time = date("Y-m-d H:i:s", time());
        //echo $now_time;
        $now_time = strtotime($now_time);
        $show_time = strtotime($the_time);
        $dur = $now_time - $show_time;
        if ($dur < 0) {
            return $the_time;
        } else {
            if ($dur < 60) {
                return $dur . '秒前';
            } else {
                if ($dur < 3600) {
                    return floor($dur / 60) . '分钟前';
                } else {
                    if ($dur < 86400) {
                        return floor($dur / 3600) . '小时前';
                    } else {
                        if ($dur < 259200) {//3天内
                            return floor($dur / 86400) . '天前';
                        } else {
                            return $the_time;
                        }
                    }
                }
            }
        }
    }


    echo time_tran("2016-9-5 19:22:01");
