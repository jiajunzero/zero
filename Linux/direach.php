<?php 

//遍历目录下的所有MP3文件
function eachdir($path,$n=0){
	$res=opendir($path);
	while($file=readdir($res)){
		if($file=='.' || $file=='..')continue;
		$fileAll=$path.'/'.$file;
		if(is_dir($fileAll)){
			eachdir($fileAll,$n+1);
		}else{
			//截取以'.'最后出现之后的字符串（.mp3） 从位置1开始截取
			$last=substr(strrchr($fileAll,'.'),1);
			//后缀为MP3的就输出文件
			if($last=='mp3'){
				echo '<span style="">'.$file.'</span><br>';
			}
		}
	}
}
eachdir('D:/');

function eachDir($path,$n=0){
	$res=opendir($path);//打开目录
	while($file=readdir($res)){//循环读取
		if($file=='.'||$file=='..')continue;
		echo str_repeat('-',$n);//根据$n的次数输出字符串'-'
		$filePath=$path.'/'.$file;//拼接路径
		if(is_dir($filePath)){//判断是否为目录
			echo $file.'<br>';
			eachDir($filePath,$n+1);//递归调用
		}else{
			echo '<span style="color:red">'.$file.'<span>';
		}
	}
}

