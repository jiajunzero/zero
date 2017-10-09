<?php 

if($_SERVER['REQUEST_METHOD']=='POST'){
	foreach($_POST  as $k => $v){
		echo "$k==$v<br>";
	}
}else{
	echo 'error:is_get';
}