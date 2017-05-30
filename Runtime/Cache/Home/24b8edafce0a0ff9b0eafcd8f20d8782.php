<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>南京邮电大学通达学院在线问卷调查</title>
    <script type="text/javascript" src="<?php echo (C("JS_URL")); ?>jquery.min.js"></script>
    <link href='//fonts.googleapis.com/css?family=Amaranth:400,400italic,700,700italic' rel='stylesheet'
          type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Josefin+Slab:400,100,100italic,300,300italic,400italic,600,600italic,700,700italic'
          rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
          rel='stylesheet' type='text/css'>

    <link href="<?php echo (C("CSS_URL")); ?>style.css" rel="stylesheet" type="text/css" media="all"/>

</head>
<body>
<div class="content">
    <!--学校的 logo-->
    <img src="<?php echo (C("IMG_URL")); ?>logo.png" style="left:33%; position: relative" alt="logo">
    <h1>2017级新生基础课程学情调查问卷</h1>
    <div class="main">
        <!---后台数据传来学生的个人信息-->
        <h5>名字：<?php echo ($studata["iname"]); ?></h5>

        <h5>专业：<?php echo ($studata["professional"]); ?></h5>
        <h5><div><div style="float:left;">身份证：</div><div style="float:left;" id="idnumber">    <?php echo ($studata["idnumber"]); ?></div></div></h5>

        <!--input type="text" value="johnkeith@mail.com" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'johnkeith@mail.com';}" required="">
        <h5>Your Review <span>( Tips and Guidelines ) </span> </h5>
        <textarea onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">Type here</textarea>
        -->
        <br/>
        <br/>
        <!--
        <h5>1.你的性别是</h5>
        <div class="radio-btns">
          name 一样就可以完成单选的功能
            <div class="swit">

                <div class="check_box">
                    <div class="radio">
                        <label>
                            <input type="radio" name="radio1" class="option" value="1A">
                            <i></i>
                            男
                        </label>
                    </div>
                </div>

                <div class="check_box">
                    <div class="radio">
                        <label>
                            <input type="radio" name="radio1" class="option" value="1B">
                            <i></i>
                            女
                        </label>
                    </div>
                </div>

                <div class="clear"></div>
            </div>
        </div>
        <h5>45.你比较热衷于哪些体育项目？（可多选）
        </h5>
        <div class="radio-btns">
            <div class="swit">
                name 属性不一样就可以完成多选的功能
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio45A" value="45A" class="option"><i></i>A.篮球
                    </label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio45B" value="45B" class="option"><i></i>B.足球</label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio45C" value="45C" class="option"><i></i>C.排球</label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio45D" value="45D" class="option"><i></i>D.羽毛球</label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio45E" value="45E" class="option"><i></i>E.乒乓球
                    </label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio45F" value="45F" class="option"><i></i>F.舞蹈</label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio45G" value="45G" class="option"><i></i>G.武术</label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio45H" value="45H" class="option"><i></i>H.健美操</label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio45I" value="45I" class="option"><i></i>I.田径</label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio45J" value="45J" class="option"><i></i>J.轮滑</label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio45K" value="K"
                                                     class="option"><i></i>K.其他</label>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        -->
        <?php echo ($questionnaire); ?>

        <!--h5>填空题啊</h5>
        <textarea onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">Type here</textarea-->

        <button onclick="submitAll()" style="background: #f78d1d; width: 100% ;height: 40px">提交</button>
    </div>

</div>
<!--到时候 用 JavaScript 完成数据的收集-->
<script type="text/javascript">
    function submitAll() {
        var ischecked = document.getElementsByClassName("option");// 选择题
        var freesponce = document.getElementsByClassName("freesponce");// 填空题
        // 先检查没有没有题目还没写
        //答案数组
        var answer_select = new Array();
        var answer_fill =""; // 不要 用数组 等会逗号 不好分割
        var ttt = 0;// 计数
        //var json="{";
        for (var item = 0; item < ischecked.length; item++) {
            if (ischecked[item].checked) {
                //alert(ischecked[item].getAttribute("value").split("&"));
                /*// 拆分   1&B
                 var split=ischecked[item].getAttribute("value").split("&");

                 json+='"'+String(split[0])+'":"'+String(split[1])+'",';
                 json+=String(split[0])+":"+String(split[1])+",";*/
                answer_select[ttt++] = ischecked[item].getAttribute("value");

            }
        }
        // json=JSON.stringify(json);
        //alert(json);
        for (var item = 0; item < freesponce.length; item++) {
            answer_fill += freesponce[item].value;
            answer_fill+="&&";
        }

        //alert(answer_select);
        //alert(answer_fill);
        //将这两个数组 拆分成  json 形式


        // 模拟 post 请求
        var url = "<?php echo U('Index/saveAnswer');?>";
        post(url, answer_select, answer_fill);
    }

    function post(URL, answer_select, answer_fill) {
        var temp = document.createElement("form");
        temp.action = URL;
        temp.method = "post";
        temp.style.display = "none";
        // 选择题
        var opt = document.createElement("textarea");
        opt.name = "answer_select";
        opt.value = answer_select;
        temp.appendChild(opt);
        // 填空题
        opt = document.createElement("textarea");
        opt.name = "answer_fill";
        opt.value = answer_fill;
        temp.appendChild(opt);
        // 用户名传入
        opt = document.createElement("textarea");
        opt.name = "idnumber";
        // 可能 要 去掉空格
        opt.value = document.getElementById("idnumber").innerHTML.replace(/(^\s*)|(\s*$)/g, "");;

        temp.appendChild(opt);
        document.body.appendChild(temp);
        // 提交
        temp.submit();
        return temp;
    }

</script>
</body>
</html>