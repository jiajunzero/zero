@extends('admin.common')
@section('title')添加专业@endsection

@section('body')

	<link rel="stylesheet" href="{{asset('back')}}\lib\webuploader\0.1.5\webuploader.css">
	<link rel="stylesheet" href="{{asset('back')}}\lib\zyUpload\control\css\zyUpload.css">
<article class="page-container">
	<form action="{{url('admin/profession')}}" method="post"  class="form form-horizontal" id="form-profession-add" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>专业名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="pro_name" name="pro_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>专业分类：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
		<select class="select" name="cate_id" size="1">
			@foreach($cate as $item)
				<option value="{{$item->id}}">{{$item->cate_name}}</option>
			@endforeach
		</select>

		</span> </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>授课老师：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value=""  id="teachers" name="teachers">
			<input type="hidden" class="input-text" autocomplete="off" value=""  id="teacher_ids" name="teacher_ids">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>价格：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value=""  id="price" name="price">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">市场价格：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value=""  id="price" name="market_price" placeholder="市场价应大于价格">
		</div>
	</div>

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>有效期(天)：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value=""  id="expired_at" name="expired_at">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">点击量：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off"  placeholder="" id="click" name="click">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>专业时长（小时）：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off"  placeholder="" id="duration" name="duration">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>封面图：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<div id="cover_img">选择图片</div>
			<div class="uploader-list" id="webuploader_preview"></div>
			<div id="processing">
				<div class="progress" style="width:100px">
				<span class="progress-bar">
					<span class="sr-only" ></span>
				</span>
				</div>
			</div>
			<div id="error"></div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>轮播图：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<div id="banners"></div>
		</div>
	</div>
	<div id="banner-img"></div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否是推荐专业：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="is_recommend" type="radio" id="is_recommend-1" checked value="1">
				<label for="is_recommend-1">是</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="is_recommend-2" name="is_recommend" value="0">
				<label for="is_recommend-2">否</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red" >*</span>是否是精品专业：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="is_best" type="radio" id="is_best1" checked value="1">
				<label for="is_best1">是</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="is_best2" name="is_best" value="0">
				<label for="is_best2">否</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否是热门专业：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="is_hot" type="radio" id="is_hot" checked value="1">
				<label for="is_hot1">是</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2" name="sex" value="0">
				<label for="is_hot2">否</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value=""  id="sort" name="sort">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>专业简介：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="pro_desc" id="pro_desc" cols="126" rows="5"  autocomplete="off"></textarea>

		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">专业详情：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<script id="container" name="detail" type="text/plain">

			</script>
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
		<input type="hidden" name="cover_img">
	</form>
</article>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/additional-methods.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/zyUpload/control/js/zyUpload.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/zyUpload/core/zyFile.js"></script>
<script src="{{asset('back')}}/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script src="{{asset('back')}}/lib/ueditor/1.4.3/ueditor.all.js"></script>
{{--<script type="text/javascript" src="{{asset('')}}/js/placeImage.js"></script>--}}
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">

$(function(){

	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-profession-add").validate({
//		rules:{
//			adminName:{
//				required:true,
//				minlength:4,
//				maxlength:16
//			},
//			password:{
//				required:true,
//			},
//			password2:{
//				required:true,
//				equalTo: "#password"
//			},
//			sex:{
//				required:true,
//			},
//			phone:{
//				required:true,
//				isPhone:true,
//			},
//			email:{
//				required:true,
//				email:true,
//			},
//			adminRole:{
//				required:true,
//			},
//		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
            $(form).ajaxSubmit(function(msg){
                if(msg.status=='success'){
                    layer.alert('添加成功',{
                        icon:1,
                        skin:'layer-ext-moon'

                    },function(){
                        parent.location.reload();
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    });

                }else{
                    layer.alert(msg.error,{
                        icon:5,
                        skin:'layer-ext-moon'
                    });
                }
            });
		}
	});
});


//弹出选择授课老师分类框
$('#teachers').on('click',function(){
   layer_show('选择授课老师分类','{{url('admin/profession/select_teacher')}}',900,400);
});



var uploader = WebUploader.create({

    // 选完文件后，是否自动上传。
    auto: true,
    // swf文件路径
    swf:"{{asset('back')}}/lib/webuploader/0.1.5/Uploader.swf",
	resize:false,
    // 文件接收服务端。
    server: "{{url('admin/admin/upload/avatar')}}",
	formData:{
        '_token':'{{csrf_token()}}'
	},
    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#cover_img',
    // 只允许选择图片文件。
    accept: {
        title: '图片',
        extensions: 'gif,jpg,jpeg,png'
    }

});

//预览图片
$webuploader_preview=$('#webuploader_preview');
uploader.on( 'fileQueued', function( file ) {

    uploader.makeThumb(file, function (error, src) {
        $webuploader_preview.empty();
        if (error) {
           layer.msg('不能预览图片');
           return;
        } else {
            $webuploader_preview.append('<img src="' + src + '" />');
        }

    },100,100);
});

//进度条]
uploader.on( 'uploadProgress', function( file ,percentage) {
	$('#processing .sr-only').css('width',percentage * 100 + '%')
});

//文件上传成功后 把图片路径提交到控制器进行入库
uploader.on( 'uploadSuccess', function( file ,msg) {
    if(msg.status=='success'){
		$('input[name=cover_img]').val(msg.file)
	}else{
		$('#error').html('文件上传失败')
	}
});

var csrf_token='{{csrf_token()}}';

$("#banners").zyUpload({
    width: "650px", // 宽度
    height: "auto", // 宽度
    itemWidth: "60px", // 文件项的宽度
    itemHeight: "60px", // 文件项的高度
    url: "{{url('admin/admin/upload/profession')}}", // 上传文件的路径
    fileType: ["jpg", "png", "txt", "js"], // 上传文件的类型
//    fileSize: 51200000, // 上传文件的大小
    multiple: true, // 是否可以多个文件上传
    dragDrop: true, // 是否可以拖动上传文件
    del: true, // 是否可以删除文件
    finishDel: false,// 是否在上传文件完成后删除预览
	/* 外部获得的回调接口 */
});

//文件上传成功的回调函数
ZYFILE.onSuccess=function(file, response) {          // 文件上传成功的回调方法
    var response=$.parseJSON(response);  //变成json格式

	//把上传成功的文件地址放到表单隐藏域提交到后台
    $("#banner-img").append("<input data-index='"+file.index+"' type='hidden' name='banner_img[]'  value='"+response.file+"'>");
};

//删除一个文件的回调函数
ZYFILE.onDelete=function(file, response) {          // 文件上传成功的回调方法
	//删除隐藏域中的文件地址
	$('input:hidden[data-index='+file.index+']').remove();
	//删除图片的块元素
	$('#uploadList_'+file.index).remove();
};


</script>
<script>
    var ue = UE.getEditor('container',{
        toolbars: [[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music'
        ]]
    });
</script>

<!--/请在上方写此页面业务相关的脚本-->
@endsection