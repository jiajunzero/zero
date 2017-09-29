<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>权限列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
        <link href="/Public/Css/page.css" type="text/css" rel="stylesheet"/>
        <link href="/Public/Swal/sweetalert.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：权限管理-》权限列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="/index.php/Admin/Auth/add">【添加权限】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search">
            <span>
                <form action="#" method="get">
                    品牌<select name="s_product_mark" style="width: 100px;">
                        <option selected="selected" value="0">请选择</option>
                        <option value="1">苹果apple</option>
                    </select>
                    <input value="查询" type="submit" />
                </form>
            </span>
        </div>
       <div style="font-size: 13px; margin: 10px 5px;">
    <table class="table_a" border="1" width="100%" id="event_tb">
        <tbody>
        <tr style="font-weight: bold;">
            <td>序号</td>
            <td>权限名称</td>
            <td>权限控制器</td>
            <td>权限方法</td>

            <td align="center">操作</td>
        </tr>
        <?php foreach($data as $k => $v): ?>
        <tr id="product1">
            <td><?php echo ++$k?></td>
            <td><?php echo str_repeat('　',$v['level']).$v['auth_name']?></td>
            <td><?php echo $v['auth_c']?></td>
            <td><?php echo $v['auth_a']?></td>


            <td><?php if($v['auth_id']!=1):?>
                <a href="/index.php/Admin/Auth/upd/auth_id/<?php echo $v['auth_id']?>">

                <button>修改</button></a>
                <button class="del" auth_id="<?php echo $v['auth_id']?>" >删除</button>
                <?php endif?>
            </td>

        </tr>
        <?php endforeach?>

        </tbody>
    </table>
    <div class="pagination" align="center">
        <?php echo ($page); ?>

    </div>
</div>
    </body>
<script src="/Public/Js/jquery.min.js"></script>
<script src="/Public/Swal/sweetalert.min.js"></script>
<script>
    //利用ajax技术实现委托无刷新删除
    $('#event_tb').click(function(event){

       var _target=$(event.target);

       var _class=_target.attr('class');
       console.log(_class);
       if(_class=='del'){

           var auth_id=_target.attr('auth_id');
           $.ajax({
               url:"/index.php/Admin/Auth/del",
               type:'get',
               data:{'auth_id':auth_id},
               dataType:'json',
               success:function(json){
                   if(json.error==0){
                       $(_target).parent().parent().remove();
//                       swal({
//                               title: "确定删除吗？",
//                               text: "你将无法恢复该信息！",
//                               type: "warning",
//                               showCancelButton: true,
//                               confirmButtonColor: "#DD6B55",
//                               confirmButtonText: "确定删除！",
//                               closeOnConfirm: false
//                           },
//                           function(){
                       swal('已删除', "", "success");

//                           });

                   }else{
                       swal(json.info,'','error');
                   }

               }
           })
       }

    })
</script>

</html>