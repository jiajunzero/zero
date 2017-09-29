<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改权限</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
        <link href="/Public/Css/completer.css" type="text/css" rel="stylesheet">
    </head>
    <style>
        label.error{
            color:red;
            margin-left: 5px;
        }
    </style>
    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：权限管理-》修改权限信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="/index.php/Admin/Auth/lst">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Admin/Auth/upd/auth_id/22" method="post" enctype="multipart/form-data" name="myform">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>权限名称</td>
                    <td><input type="text" name="auth_name" value="<?php echo ($row['auth_name']); ?>" /></td>
                    <input type="hidden" name="auth_id" value="<?php echo ($row['auth_id']); ?>"/>
                </tr>
                <tr>
                    <td>上级权限</td>
                    <td>
                        <select name="auth_pid">
                            <option value="">请选择</option>
                            <option value="0">顶级权限</option>
                            <?php foreach ($tree as $k =>$v){ if(in_array($v['auth_id'],$ids)){ continue; } if($v['auth_id']==$row['auth_pid']){ $selected="selected=selected"; }else{ $selected=''; } ?>
                            <option <?php echo $selected;?> value="<?php echo $v['auth_id']?>"><?php echo str_repeat("　",$v['level']).$v['auth_name']?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>权限控制器</td>
                    <td><input type="text" name='auth_c' value="<?php echo ($row['auth_c']); ?>" /></td>
                </tr>
                <tr>
                    <td>权限方法</td>
                    <td><input type="text" name="auth_a" value="<?php echo ($row['auth_a']); ?>" /></td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="编辑">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
<script src="/Public/Js/jquery.min.js"></script>
<script src="/Public/Js/jquery.validate.min.js"></script>
<script src="/Public/Js/validate_zh_cn.js"></script>
<script src="/Public/Js/completer.min.js"></script>
<script>
    $("form[name=myform]").validate({
        rules: {

            repwd: {
                required: true,
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true
            }
        }
    })
</script>

</html>