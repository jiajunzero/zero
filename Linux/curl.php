<?php 

//生成虚拟浏览器
$cn=curl_init();

//为微信api必须设置
curl_setopt($cn,CURLOPT_SAFE_UPLOAD,true);

//设置浏览器地址
curl_setopt($cn,CURLOPT_URL,'http://youngjiajun.com/Media/getcurl.php');
//设置请求成功后百度以html字符串（文档流）的形式返回
curl_setopt($cn,CURLOPT_RETURNTRANSFER,true);
//禁用ssl公用名
curl_setopt($cn,CURLOPT_SSL_VERIFYHOST,0);
//取消认证ssl校验
curl_setopt($cn,CURLOPT_SSL_VERIFYPEER,false);
//设置post请求
curl_setopt($cn,CURLOPT_POST,true);

$data=array(
	'name'=>'jay',
	'age'=>'39',
	'home'=>'taiwan',
);

//提交数据
curl_setopt($cn,CURLOPT_POSTFIELDS,$data);

//执行浏览器 相当于回车 返回数据
$str=curl_exec($cn);
if($str){
	echo $str;
}else{
	echo curl_error($cn);
}
//关闭会话
curl_close($cn);