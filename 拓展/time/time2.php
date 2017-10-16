<?php
/**
 * @Author: YouLong
 * @Date:   2016-09-06 13:53:48
 * @Last Modified by:   YouLong
 * @Last Modified time: 2016-09-06 13:56:07
 */
header("Content-type: text/html; charset=utf8");
function time_tranx($the_time){
   $now_time = date("Y-m-d H:i:s",time()+8*60*60);
   $now_time = strtotime($now_time);
   $show_time = strtotime($the_time);
   $dur = $now_time - $show_time;
   if($dur < 0){
        return $the_time;
   }else{
        if($dur < 60){
         return $dur.'秒前';
        }else{
             if($dur < 3600){
              return floor($dur/60).'分钟前';
             }else{
                  if($dur < 86400){
                     return floor($dur/3600).'小时前';
                  }else{
                       if($dur < 259200){ //3天内
                            return floor($dur/86400).'天前';
                       }else{
                            return $the_time;
                       }
                  }
            }
        }
   }
}
echo time_tranx("2016-9-4 19:22:01");