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
<style>
    .data{position: relative; width: 1000px ;height:200px ;top:50px;

    }
    .charts{width: 800px;height:200px;}
    .question{position: absolute ;top: 50px;left: 650px}

</style>
<div style="left: 250px; position: absolute;top:210px;">

<a  class="button orange" href="<?php echo U('ShowData/echarts');?>?collegebranch=0">理工科</a>
<a  class="button orange" href="<?php echo U('ShowData/echarts');?>?collegebranch=1">文经管</a>

</div>
<div>
<!--div class="data">

    <div class="charts" ></div>
    <div class="question">42. 大一下学期就开设物理课程了，你如何为之做准备
        <p>A. 要提前先温习一下高中知识，到图书馆借些书看看&nbsp;
            </p>
    </div>
</div-->
    <?php echo ($questionnaire); ?>

</div>

<script type="text/javascript">

    // 基于准备好的dom，初始化echarts实例
    var divs=document.getElementsByClassName('charts');
    var count=0;
    var data=<?php echo ($data); ?>;
    //alert(data[0]['inumber']);

    //var myChart;
    for(var i =0;i<divs.length;i++ ){
        var myChart = echarts.init(divs[i]);
        count=i+1;
        // 使用刚指定的配置项和数据显示图表。
        option = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical'

            },
            series : [
                {
                    name: '选项',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    /*
                     * [1] => array(2) {
                     ["A"] => string(1) "2"
                     ["B"] => string(1) "1"
                     }
                     * */
                    data:[
                        {value:data[count]["A"], name:'A'},
                        {value:data[count]["B"], name:'B'},
                        {value:data[count]["C"], name:'C'},
                        {value:data[count]["D"], name:'D'},
                        {value:data[count]["E"], name:'E'},
                        {value:data[count]["F"], name:'F'},
                        {value:data[count]["G"], name:'G'},
                        {value:data[count]["H"], name:'H'},
                        {value:data[count]["I"], name:'I'},
                        {value:data[count]["J"], name:'J'},
                        {value:data[count]["K"], name:'K'},
                        {value:data[count]["L"], name:'L'},
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };


        myChart.setOption(option);
    }

</script>

</body>

</html>