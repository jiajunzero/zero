<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link href="/Public/Admin/css/admin./Public/Admin/css" type="text//Public/Admin/css" rel="stylesheet" />
        <script language=javascript>
            function expand(el)
            {
                childobj = document.getElementById("child" + el);

                if (childobj.style.display == 'none')
                {
                    childobj.style.display = 'block';
                }
                else
                {
                    childobj.style.display = 'none';
                }
                return;
            }
        </script>
    </head>

    <body>
        <table height="100%" cellspacing=0 cellpadding=0 width=170 
               background=/Public/Admin/img/menu_bg.jpg border=0>
               <tr>
                <td valign=top align=middle>

                    <table cellspacing=0 cellpadding=0 width="100%" border=0>

                        <tr>
                            <td height=10></td></tr>
                    </table>

               <?php $menu=session('menu'); foreach($menu as $k =>$v ): ?>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>

                        <tr height=22>
                            <td style="padding-left: 30px" background=/Public/Admin/img/menu_bt.jpg><a 
                                    class=menuparent onclick=expand(<?php echo $k; ?>)
                                    href="javascript:void(0);"><?php echo $v['auth_name'] ?></a></td></tr>
                        <tr height=4>
                            <td></td></tr>
                    </table>

                    <!-- 二级 -->
                    <table id=child<?php echo $k;?> style="display: none" cellspacing=0 cellpadding=0
                        width=150 border=0>
                        <?php  $sub=$v['sub'] ; foreach($sub as $key => $value): ?>
                        <tr height=20>
                            <td align=middle width=30><img height=9 src="/Public/Admin/img/menu_icon.gif" width=9></td>
                            <td>
                                <a class=menuchild href="<?php echo U($value['auth_c'] . '/' . $value['auth_a']);?>" target="right"><?php echo $value['auth_name'];?></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </table>
                    <?php endforeach ?>

        </table>
    </body>
</html>