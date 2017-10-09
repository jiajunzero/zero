<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:bd="http://www.baidu.com/2010/xbdml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
  <meta http-equiv="pragma" content="no-cache"> 
  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate"> 
  <meta http-equiv="expires" content="0">
  <title>购买信息确认</title>


  <link rel="stylesheet" href="/home/css/bootstrap.min.css">
  <link rel="stylesheet" href="/home/css/bootstrap-theme.min.css">
  {{--<link rel="stylesheet" href="/home/css/componet.css">--}}
  {{--<link rel="stylesheet" href="/home/css/iconfont.css">--}}
  <link rel="stylesheet" href="/home/css/header.css">
  <link rel="stylesheet" href="/home/css/footer.css">
  {{--<link rel="stylesheet" href="/home/css/modal.css">--}}
  <link rel="stylesheet" type="text/css" href="/home/css/order.css">
  {{--<script src="/home/js/hm.js"></script>--}}
  <script src="/home/js/jquery-1.12.1.js" type="text/javascript" charset="utf-8"></script>
  {{--<script src="/home/js/jquery.pagination.js" type="text/javascript" charset="UTF-8"></script>--}}
  <script type="text/javascript" src="/home/js/layer.js"></script>
  <link rel="stylesheet" href="/home/css/layer.css" id="layui_layer_skinlayercss">
  <script type="text/javascript" src="/home/js/artTemplate.js"></script>
  {{--<script src="/home/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>--}}
  {{--<script src="/home/js/jquery.form.min.js" type="text/javascript" charset="utf-8"></script>--}}
  {{--<script src="/home/js/ajax.js" type="text/javascript" charset="utf-8"></script>--}}
  {{--<script type="text/javascript" src="/home/js/helpers.js"></script>--}}
  {{--<script src="/home/js/html5.js" type="text/javascript" charset="utf-8"></script>--}}
  {{--<script src="/home/js/modal.js" type="text/javascript" charset="utf-8"></script>--}}
  {{--<script type="text/javascript" src="/home/js/jquery.dotdotdot.js"></script>--}}
  {{--<script type="text/javascript" src="/home/js/order.js"></script>--}}
  <script>
//  var _hmt = _hmt || [];
//  (function() {
//    var hm = document.createElement("script");
//    hm.src = "https://hm.baidu.com/hm.js?30ed673100bd4991fb9d20db9e374fb1";
//    var s = document.getElementsByTagName("script")[0];
//    s.parentNode.insertBefore(hm, s);
//  })();
  </script>
</head>
<body>
<div class="main">
		<div class="main-title">
			<span>购买信息确认</span>
		</div>
		<div class="main-table">
			<div class="tr clearfix">
				<span class="td1">课程名称</span>
				<span class="td2">课程有效期</span>
				<span class="td3">原价</span>
				<span class="td4">优惠</span>
				<span class="td5">应付</span>
			</div>
            <div class="tab clearfix">
                <div class="td1">
    <span class="img">
      <img src="{{str_replace('https','http',$order->cover_img)}}"></span>
                    <table border="0" cellspacing="" cellpadding="">
                        <tbody>
                        <tr>
                            <td>
                                <span class="name">{{$order->pro_name}}</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="td2">即日起至{{date('Y-m-d',time()+($order->expired_at)) }}</div>
                <div class="td3">￥{{$order->market_price}}</div>
                <div class="td4">-￥{{$order->market_price-$order->price}}</div>
                <div class="td5">￥{{$order->price}}</div></div>
        </div>
    <div class="sub clearfix">
        <a style="cursor:pointer" href="/order/{{$order->id}}/create" data-url="/home/order/{{$order->id}}/create"> 提交订单</a>
        <p>应付金额：
            <span>￥{{$order->price}}</span></p>
    </div>
</div>

{{--<script type="text/javascript" src="/home/js/header.js" charset="utf-8"></script>--}}
<script type="text/javascript" src="/home/js/footer.js"></script>
<div class="footerDT">
    <footer>
        <div class="content">
            <div class="content-item footer-bodys">
                <div class="content-item content-footer-link about-us">
                    <ul class="gate">
                        <li data-id="first" data-url="../html/aboutUs.html">关于我们
                            <span>|</span></li>
                        <li data-id="two" data-url="../html/aboutUs.html">人才招聘
                            <span>|</span></li>
                        <li data-id="three" data-url="../html/aboutUs.html">联系我们
                            <span>|</span></li>
                        <li data-id="four" data-url="../html/aboutUs.html" class="noline">常见问题</li></ul>
                </div>
                <div class="trademark">like it Copyright @ 2017  All Rights Reserved
                    <span style="margin-right:5px;"></span>
                    <span id="cnzz_stat_icon_1260713417">
            {{--<a href="http://www.cnzz.com/stat/website.php?web_id=1260713417" target="_blank" title="站长统计">--}}
              {{--<img border="0" hspace="0" vspace="0" src="/home/img/pic1.gif"></a>--}}
          </span>
                </div>
            </div>
        </div>
    </footer>
</div>
{{--<script src="/home/js/placeHolder.js"></script>--}}
{{--<script type="text/javascript">--}}
    {{--$(function () {--}}
        {{--$('input').placeholder();--}}
    {{--});--}}
{{--</script>--}}

</body></html>