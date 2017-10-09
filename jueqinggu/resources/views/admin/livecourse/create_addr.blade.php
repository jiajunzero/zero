<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>直播流地址</title>
</head>
<body>
	<h4>推流地址：</h4>
	<h3>rtmp://pili-publish.www.sinsea.cn/php-25</h3>
	<h4>推流名称：</h4>
	<h3>edu-2?e=1463023142&token=7O7hf7Ld1RrC_fpZdFvU8aCgOPuhw2K4eapYOdII:-5IVlpFNNGJHwv-2qKwVIakC0ME=</h3>
	<hr/>
	<h4>播放地址:</h4>	
	<h3>rtmp://pili-publish.www.sinsea.cn/php-25/edu-2</h3>
	<hr/>
	<span>直播课程：{!!$course_name!!}</span><br>
	<span>授课老师：{!!$teacher!!}</span><br>
	<span>开始时间：{!!$start_at!!}</span><br>
	<span>结束时间：{!!$end_at!!}</span>
	<h5>发送手机短信或邮件通知授课老师 <button send='sms' >发送短信</button>　<button send='email'>发送邮件</button></h5>
</body>

<script type="text/javascript" src="{{asset('back')}}/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/layer/2.1/layer.js"></script>
<script>


$('button').click(function(){
	var send=$(this).attr('send');
	var data={
	    'send':send
	}
	$.get('/admin/live/send',data,function(msg){
		if(msg.status=='success'){
		    layer.msg('发送成功',{icon:1,time:2000});
		}else{
		    layer.msg('发送失败',{icon:5,time:2000});
		}
	},'json');
});

</script>
</html>