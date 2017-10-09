@extends('admin.common')
@section('title')添加专业@endsection

@section('body')

	<link rel="stylesheet" href="{{asset('back')}}\lib\webuploader\0.1.5\webuploader.css">
	<link rel="stylesheet" href="{{asset('back')}}\lib\zyUpload\control\css\zyUpload.css">
<article class="page-container">
	<form action="{{url('admin/course')}}" method="post"  class="form form-horizontal" id="form-profession-add" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="course_name" name="course_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属专业：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
		<select class="select" name="pro_id" size="1">
			@foreach($proInfo as $item)
				<option value="{{$item->id}}">{{$item->pro_name}}</option>
			@endforeach
		</select>

		</span> </div>
	</div>
	
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程描述：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value=""  id="course_desc" name="course_desc">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value=""  id="sort" name="sort">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">是否禁用：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="disabled_at" type="radio" id="disabled_at1" value="1">
				<label for="disabled_at1">是</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="disabled_at2" name="disabled_at" checked value="0">
				<label for="disabled_at2">否</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">课程详情：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<script id="container" name="content" type="text/plain">

			</script>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>备注：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="note" id="note" cols="126" rows="5"  autocomplete="off"></textarea>

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