<?php
/**
 * @Author: YouLong
 * @Date:   2017-09-10 16:18:01
 * @Last Modified by:   YouLong
 * @Last Modified time: 2017-09-27 20:15:38
 */
namespace Api\Controller;
use Think\Controller;

class UserinfoController extends Controller
{
    public function getRegisterXieyi($telnumber = '', $reason = '')
    {
        $data = json_encode( array("result"=>"failed","text"=>"未知原因"), JSON_UNESCAPED_UNICODE);
        if( !IS_POST ) exit( $data );
        //如果$telnumber $reason他们都为空？怎么办
        if( $telnumber == '' || $reason == '') exit( $data );
        /**
            1经纪人注册 register
            2忘记密码   forgeTpass
            3 绑定手机号 binTel
            4绑定银行卡  binCard
            5 修改手机号 editTel
         */
        $url = '';
        switch ($reason) {
            case 'register':
               $url = "http://www.youlongit.com/registerxieyi.html";
                break;
            case 'forgeTpass':
                 $url = "http://www.youlongit.com/regis.html";
                break;
        }
        if( !$url ) exit( $data );
        $data = array(
            "result"=> "success",
            "text"=> "成功",
            "data"=> [
                "url"=> $url
            ]
        );
        $data = json_encode( $data,  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit( $data );
    }
}