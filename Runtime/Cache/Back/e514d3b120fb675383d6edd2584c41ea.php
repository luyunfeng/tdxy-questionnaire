<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>后台管理中心</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="<?php echo (C("BACK_CSS_URL")); ?>styles.css" type="text/css" rel="stylesheet" media="all">
    <link href="<?php echo (C("BACK_CSS_URL")); ?>menustyles.css" type="text/css" rel="stylesheet" media="all">
    <script type="text/javascript" src="<?php echo (C("BACK_JS_URL")); ?>jquery.min.js"></script>
    <script src="<?php echo (C("BACK_JS_URL")); ?>echarts.min.js"></script>
</head>
<body>
<!--头部-->
<table cellspacing=0 cellpadding=0 width="100%"
       background="<?php echo (C("BACK_IMG_URL")); ?>header_bg.jpg" border=0>
    <tr height=56>
        <td width=260><img height=56 src="<?php echo (C("BACK_IMG_URL")); ?>header_left.jpg"
                           width=260></td>
        <td style="font-weight: bold; color: #fff; padding-top: 20px" align=middle><?php echo ($username); ?>
            &nbsp;
            <a style="color: #fff"
               onclick="if (confirm('确定要退出吗？')) return true; else return false;"
               href="<?php echo U('Admin/layout');?>?username=<?php echo ($username); ?>"
               target=_top>退出系统</a>
        </td>
        <td align=right width=268>
            <img height=56 src="<?php echo (C("BACK_IMG_URL")); ?>header_right.jpg" width=268>
        </td>
    </tr>
</table>
<div id="w">
    <nav>
        <ul id="ddmenu">
            <li><a href="<?php echo U('Admin/index');?>">管理中心</a></li>
            <li><a href="<?php echo U('Upload/upload');?>">上传学生信息</a></li>
            <li><a href="<?php echo U('ShowData/echarts');?>">问卷数据分析</a></li>
            <li><a href="<?php echo U('ShowData/suggest');?>">学生建议数据</a></li>
            <li><a href="<?php echo U('ShowData/searchData');?>">学生信息搜索</a>

            </li>
        </ul>
    </nav>
</div>
<style type="text/css">
    .container {
        position:absolute;
        left: 220px;
        top: 250px;
        font-size: 25px;
        line-height: 40px;
    }
</style>
<div class="container">
    <p style="font-size: 28px ;color: #CA6106">题目一:<?php echo ($topic[0]["text1"]); ?></p>
    <?php if(is_array($first_suggests)): foreach($first_suggests as $key=>$suggest): ?>• <?php echo ($suggest["suggest"]); ?><br/><?php endforeach; endif; ?>
    <br/><br/><br/>
    <p style="font-size: 28px ;color: #CA6106">题目二:<?php echo ($topic[1]["text1"]); ?></p>
    <?php if(is_array($second_suggests)): foreach($second_suggests as $key=>$suggest): ?>• <?php echo ($suggest["suggest"]); ?><br/><?php endforeach; endif; ?>

    <br/><br/><br/>
</div>
</body>

</html>