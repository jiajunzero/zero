<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>填写核对订单信息</title>
	<link rel="stylesheet" href="/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/fillin.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/footer.css" type="text/css">

	<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/Public/Home/js/cart2.js"></script>

</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<?php if(session('?id')){?>
					<li>您好，欢迎来到京西！[<a href="/index.php/Home/Member/login"><?php echo session('username')?></a>]
						[<a href="/index.php/Home/Member/reback">退出</a>]
					</li>
					<?php }else{?>
					<li>您好，欢迎来到京西！[<a href="/index.php/Home/Member/login">登录</a>] [<a href="/index.php/Home/Member/register">免费注册</a>] </li>
					<?php }?>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>

				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>
	
	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="index.html"><img src="/Public/Home/images/logo.png" alt="京西商城"></a></h2>
			<div class="flow fr flow2">
				<ul>
					<li>1.我的购物车</li>
					<li class="cur">2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="fillin w990 bc mt15">
		<div class="fillin_hd">
			<h2>填写并核对订单信息</h2>
		</div>

		<div class="fillin_bd">
			<!-- 收货人信息  start-->
			<div class="address">
				<h3>收货人信息 </h3>
				<!--<div class="address_info">-->
					<!--<p>王超平  13555555555 </p>-->
					<!--<p>北京 昌平区 西三旗 建材城西路金燕龙办公楼一层 </p>-->
				<!--</div>-->

				<div class="address_select">

					<form action="/index.php/Home/Order/subOrder" id='form' name="address_form" method="post">
						<ul>
							<li>
								<label for=""><span>*</span>收 货 人：</label>
								<input type="text" name="shr" class="txt" />
							</li>

							<li>
								<label for=""><span>*</span>详细地址：</label>
								<input type="text" name="address" class="txt address"  />
							</li>
							<li>
								<label for=""><span>*</span>手机号码：</label>
								<input type="text" name="phone" class="txt" />
							</li>
							<li>
								<label for=""><span>*</span>邮编：</label>
								<input type="text" name="zcode" class="txt" />
							</li>
						</ul>
					</form>
					<!--<a href="" class="confirm_btn"><span>保存收货人信息</span></a>-->
				</div>
			<!--</div>-->
			<!-- 收货人信息  end-->

			<!-- 配送方式 start -->

			<!-- 配送方式 end -->

			<!-- 支付方式  start-->

			<!-- 支付方式  end-->

			<!-- 发票信息 start-->

			<!-- 发票信息 end-->

			<!-- 商品清单 start -->
			<div class="goods">
				<h3>商品清单</h3>
				<table>
					<thead>
						<tr>
							<th class="col1">商品</th>
							<th class="col2">规格</th>
							<th class="col3">价格</th>
							<th class="col4">数量</th>
							<th class="col5">小计</th>
						</tr>
					</thead>
					<tbody>
					<?php if(is_array($cartData)): foreach($cartData as $key=>$v): ?><tr>
							<td class="col1">
								<a href=""><img src="<?php echo C('VIEW_IMG_PATH').$v['info']['goods_thumb'];?>" alt="" /></a>  <strong>
								<a href="" style="margin-left: 40px"><?php echo ($v['info']['goods_name']); ?></a></strong></td>
							<td class="col2"> <p><?php echo ($v['att']); ?></p> </td>
							<td class="col3">￥<?php echo ($v['info']['goods_price']); ?></td>
							<td class="col4"> <?php echo ($v['goods_count']); ?></td>
							<td class="col5"><span>￥<?php echo ($v['goods_count']*$v['info']['goods_price']); ?></span></td>
						</tr><?php endforeach; endif; ?>
					</tbody>

				</table>
			</div>
			<!-- 商品清单 end -->

		</div>

		<div class="fillin_ft">
			<a href="javascript:;" id="sub"><span >提交订单</span></a>
			<p>应付总额：<strong><?php echo ($v['prices']); ?></strong></p>
			
		</div>
	</div>
	<!-- 主体部分 end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt15">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="/Public/Home/images/xin.png" alt="" /></a>
			<a href=""><img src="/Public/Home/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="/Public/Home/images/police.jpg" alt="" /></a>
			<a href=""><img src="/Public/Home/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->
</body>
<script>
	$('#sub').click(function(){
	   $('#form').submit();
	})
</script>
</html>