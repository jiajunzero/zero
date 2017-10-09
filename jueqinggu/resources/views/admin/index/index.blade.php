@extends('admin.common')
@section('title')在线教育系统后台首页@endsection
@section('body')
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">在线直播教育</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml"></a> <span class="logo navbar-slogan f-l mr-10 hidden-xs">后台</span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
							<li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
							<li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
							<li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<li>{{\Auth::guard('admin')->user()->role->role_name}}</li>
					<li class="dropDown dropDown_hover">
						<a href="#" class="dropDown_A">{{\Auth::guard('admin')->user()->username}}<i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="#">个人信息</a></li>
							<li><a href="#">切换账户</a></li>
							<li><a href="/admin/logout">退出</a></li>
						</ul>
					</li>
					<li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
							<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
							<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
							<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
							<li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
	<div class="menu_dropdown bk_2">
		@foreach($topAuth as $top)
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> {{$top->auth_name}}<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>

			<dd>
				<ul>
					@foreach($sonAuth as $son)
						@if($son->auth_pid==$top->id)
					<li><a data-href="{{url($son->auth_address)}}" data-title="{{$son->auth_name}}" href="javascript:void(0)">{{$son->auth_name}}</a></li>
						@endif
					@endforeach
				</ul>
			</dd>
		</dl>
		@endforeach
	</div>

	{{--<div class="menu_dropdown bk_2">--}}
			{{--<dl id="menu-admin">--}}
				{{--<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
				{{--<dd>--}}
					{{--<ul>--}}
						{{--<li><a data-href="{{url('admin/admin')}}" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>--}}
						{{--<li><a data-href="{{url('admin/role')}}" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>--}}
						{{--<li><a data-href="{{url('admin/auth')}}" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>--}}
					{{--</ul>--}}
				{{--</dd>--}}
			{{--</dl>--}}
		{{--<dl id="menu-admin">--}}
			{{--<dt><i class="Hui-iconfont">&#xe62d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
			{{--<dd>--}}
				{{--<ul>--}}
					{{--<li><a data-href="{{url('admin/member')}}" data-title="会员列表" href="javascript:void(0)">会员列表</a></li>--}}
				{{--</ul>--}}
			{{--</dd>--}}
		{{--</dl>--}}
		{{--<dl id="menu-admin">--}}
			{{--<dt><i class="Hui-iconfont">&#xe62d;</i> 专业分类<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
			{{--<dd>--}}
				{{--<ul>--}}
					{{--<li><a data-href="{{url('admin/professioncate')}}" data-title="专业分类列表" href="javascript:void(0)">专业分类列表</a></li>--}}
				{{--</ul>--}}
			{{--</dd>--}}
		{{--</dl>--}}
		{{--<dl id="menu-admin">--}}
			{{--<dt><i class="Hui-iconfont">&#xe62d;</i> 专业管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
			{{--<dd>--}}
				{{--<ul>--}}
					{{--<li><a data-href="{{url('admin/profession')}}" data-title="专业分类列表" href="javascript:void(0)">专业列表</a></li>--}}
				{{--</ul>--}}
			{{--</dd>--}}
		{{--</dl>--}}
		{{--<dl id="menu-admin">--}}
			{{--<dt><i class="Hui-iconfont">&#xe62d;</i> 点播课程<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
			{{--<dd>--}}
				{{--<ul>--}}
					{{--<li><a data-href="{{url('admin/course')}}" data-title="课程列表" href="javascript:void(0)">课程列表</a></li>--}}
					{{--<li><a data-href="{{url('admin/lesson')}}" data-title="课时列表" href="javascript:void(0)">课时列表</a></li>--}}

				{{--</ul>--}}
			{{--</dd>--}}
		{{--</dl>--}}
		{{--<dl id="menu-admin">--}}
			{{--<dt><i class="Hui-iconfont">&#xe62d;</i> 直播流管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
			{{--<dd>--}}
				{{--<ul>--}}
					{{--<li><a data-href="{{url('admin/livestream')}}" data-title="直播流列表" href="javascript:void(0)">直播流列表</a></li>--}}

				{{--</ul>--}}
			{{--</dd>--}}
		{{--</dl>--}}
		{{--<dl id="menu-admin">--}}
			{{--<dt><i class="Hui-iconfont">&#xe62d;</i> 直播课程管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>--}}
			{{--<dd>--}}
				{{--<ul>--}}
					{{--<li><a data-href="{{url('admin/livecourse')}}" data-title="直播课程列表" href="javascript:void(0)">直播课程列表</a></li>--}}
				{{--</ul>--}}
			{{--</dd>--}}
		{{--</dl>--}}
	{{--</div>--}}
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="我的桌面" data-href="{{url('admin/welcome')}}">我的桌面</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="{{url('admin/welcome')}}"></iframe>
		</div>
	</div>
</section>

<div class="contextMenu" id="myMenu1">
	<ul>
		<li id="open">Open </li>
		<li id="email">email </li>
		<li id="save">save </li>
		<li id="delete">delete </li>
	</ul>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(function(){
	$(".Hui-tabNav-wp").contextMenu('myMenu1', {
		bindings: {
			'open': function(t) {
				alert('Trigger was '+t.id+'\nAction was Open');
			},
			'email': function(t) {
				alert('Trigger was '+t.id+'\nAction was Email');
			},
			'save': function(t) {
				alert('Trigger was '+t.id+'\nAction was Save');
			},
			'delete': function(t) {
				alert('Trigger was '+t.id+'\nAction was Delete')
			}
		}
	});
});
/*资讯-添加*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
</script> 
@endsection