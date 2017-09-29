<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加属性</title>
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
                <span style="float:left">当前位置是：属性管理-》添加属性信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="/index.php/Admin/Attr/lst">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Admin/attr/add" method="post" enctype="multipart/form-data" name="myform">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>属性名称</td>
                    <td><input type="text" name="attr_name" placeholder="attr_name..." /></td>
                </tr>
                <tr>
                    <td>商品类型</td>
                    <td>
                        <select name="type_id">
                            <option value="0">请选择</option>

                            <?php if(is_array($typeInfo)): foreach($typeInfo as $key=>$info): ?><option value="<?php echo ($info['type_id']); ?>"><?php echo ($info['type_name']); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>属性类型</td>
                    <td>单选<input type="radio" name="attr_type" value="0" />
                    唯一<input type="radio" name="attr_type" value="1" /></td>
                </tr>
                <tr>
                    <td>属性录入方式</td>
                    <td>手工<input type="radio" name="attr_input_type" value="0" />
                        列表<input type="radio" name="attr_input_type" value="1" />
                    </td>
                </tr>

                <tr>
                    <td>属性可选值</td>
                    <td>
                        <textarea name="attr_values" cols="40" rows="5" placeholder="attr_values..." ></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
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
        rules:{
            username:{
                required:true,
                rangelength:[2,10]
            },
            password:{
                required:true,
                rangelength:[5,15]
            },
            repwd:{
                required:true,
                equalTo:"#password"
            },
            email:{
                required:true,
                email:true
            }
        }
    })
</script>
    <script>
        $('#auto_email').completer({
            separator:'@',
            source:["163.com",'qq.com','139.com','gmail.com']
        });
    </script>
</html>