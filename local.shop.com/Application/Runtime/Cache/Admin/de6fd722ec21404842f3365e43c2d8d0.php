<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改角色</title>
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
                <span style="float:left">当前位置是：角色管理-》修改角色信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="/index.php/Admin/Role/lst">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Admin/Role/upd/role_id/3" method="post" enctype="multipart/form-data" name="myform">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>角色名称</td>
                    <td><input type="text" name="role_name" value="<?php echo ($row['role_name']); ?>" /></td>
                    <input type="hidden" name="role_id" value="<?php echo ($row['role_id']); ?>">
                </tr>
                <tr>
                    <td>权限分配</td>
                    <td>


                        <?php foreach ($tree as $k =>$v){ if( strpos(','.$row['role_id_list'].',' , ','.$v['auth_id'].',') !==false){ $checked='checked=checked'; }else{ $checked=''; } ?>

                          <?php echo str_repeat("　",$v['level'])?>
                          <input type="checkbox" <?php echo $checked;?> name="role_id_list[]" value="<?php echo $v['auth_id']?>" />
                            <?php echo $v['auth_name']?><br>
                        <?php }?>
                        </select>
                    </td>
                </tr>



                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="修改">
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