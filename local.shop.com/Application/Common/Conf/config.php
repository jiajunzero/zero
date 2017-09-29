<?php
return array(
	//'配置项'=>'配置值'

    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'yang',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sh_',    // 数据库表前缀

    'IMG_PATH'              =>  './Public/Uploads/',
    'VIEW_IMG_PATH'         => '/Public/Uploads/',
    'DEFAULT_FILTER'        => 'removeXSS',

    'SHOP_URL'              => 'http://nicai02.hktd35t.my03w.com/',
    'SHOP_STR' => 'sdfadfasLDHsD%%$adD<adnsDKHldADD',//数字签名

    //支付宝配置参数
    'alipay_config' => array(
        //成功申请支付宝接口后获取到的PID 2088
        'partner' => 'pid',
        // 卖家收款id
        'seller_id' => 'id',
        //成功申请支付宝接口后获取到的Key 32字符串
        'key' =>'key 32wei',
        // 如果我们配置了同步和异步通知，到时候支付宝会进行通知，但是只会一个为准
        // 异步通知地址，以post方式通知 主要是防止同步不成功，异步是作为同步同时的一个补充方案，同步通知只会通知一次，但是异步通知会按照支付宝内部的一个时间策略进行同时（）
        'notify_url' => 'http://local.shop.com/index.php/home/Order/order4',
        // 同步通知地址，以get方式通知
        // http://shop.sinsea.cn/index.php/Index/Order/order4
        'return_url' => 'http://local.shop.cn/index.php/home/Order/order3',
        // 签名方式
        'sign_type'=>strtoupper('MD5'),
        'input_charset'=> strtolower('utf-8'),
        // 做https请求的使用
        'cacert'=> VENDOR_PATH.'Alipay'.'\\cacert.pem',
        'transport'=> 'http',
        // 支付类型 ，无需修改
        'payment_type' => 1,
        // 产品类型，无需修改
        'service' => 'create_direct_pay_by_user',
        'anti_phishing_key' => '',
        'exter_invoke_ip' => '',
    ),


);