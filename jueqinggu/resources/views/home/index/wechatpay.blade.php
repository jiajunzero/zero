<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>支付</title>
</head>
<body>
<img src="{{$qrcode}}?data={{$url2}}" alt="" style="width:300px;position:fixed;top:0;left:0;right:0;bottom:0;margin:auto">
</body>
<script type="text/javascript" src="{{asset('back')}}/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/layer/2.1/layer.js"></script>
<script>
    var data={
        'oid':"{{$oid}}"
    };

    //每3秒发送ajax请求到后台查询订单是否已经支付
    var t=setInterval(function(){
        $.get('/order/queryOrder',data,function(msg){
            if(msg.status=='success'){
                layer.msg('支付成功', {
                    icon:1,
                    time: 2000, //20s后自动关闭
                },function(){
                    top.location.href="{{url('member')}}";
                });
            }
        })
    },3000);
</script>
</html>