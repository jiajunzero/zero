<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link href="{{asset('back')}}/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('back')}}/static/h-ui.admin/css/H-ui.admin.css" rel="stylesheet" type="text/css"  />
    <link href="{{asset('back')}}/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('back')}}/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('back')}}/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('back')}}/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('back')}}/static/h-ui.admin/skin/default/skin.css" id="skin" rel="stylesheet" type="text/css" />



    <title> @yield('title')</title>
</head>
<body>
    @yield('body')
<script type="text/javascript" src="{{asset('back')}}/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script type="text/javascript" src="{{asset('back')}}/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/jquery.form.js"></script>
    @yield('script')
</body>
</html>