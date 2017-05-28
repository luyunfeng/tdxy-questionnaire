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
    <img src="<?php echo (C("IMG_URL")); ?>logo.png" style="left:33%; position: relative" alt="logo">
    <h1>2017级新生基础课程学情调查问卷</h1>
    <div class="main">

        <h5>名字：德玛西亚</h5>

        <h5>专业：软件工程</h5>
        <!--input type="text" value="johnkeith@mail.com" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'johnkeith@mail.com';}" required="">
        <h5>Your Review <span>( Tips and Guidelines ) </span> </h5>
        <textarea onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">Type here</textarea>
        -->
        <br/>
        <h5>1.你的性别是</h5>
        <div class="radio-btns">
            <div class="swit">
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio1" checked=""><i></i>男</label></div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio1"><i></i>女</label></div>
                </div>

                <div class="clear"></div>
            </div>
        </div>
        <h5>2.高中三年你对英语课的兴趣</h5>
        <div class="radio-btns">
            <div class="swit">
                <div class="check_box">
                    <div class="radio1"><label><input type="radio" name="radio2" checked=""><i></i>Very Good</label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio1"><label><input type="radio" name="radio2"><i></i>Good</label></div>
                </div>
                <div class="check_box">
                    <div class="radio1"><label><input type="radio" name="radio2"><i></i>Fair</label></div>
                </div>
                <div class="check_box">
                    <div class="radio1"><label><input type="radio" name="radio2"><i></i>Poor</label></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <h5>7.你选择了上大学，你对学英语的计划（可多选）
        </h5>
        <div class="radio-btns">
            <div class="swit">
                <div class="check_box">
                    <div class="radio2"><label><input type="radio" name="radio71" ><i></i>A. 尽早过四六级 </label>
                </div>
                </div>
                <div class="check_box">
                    <div class="radio2"><label><input type="radio" name="radio72"><i></i>B. 自己想考托福、雅思、GRE</label></div>
                </div>
                <div class="check_box">
                    <div class="radio2"><label><input type="radio" name="radio73"><i></i> C. 好好学，争取考研 </label></div>
                </div>
                <div class="check_box">
                    <div class="radio2"><label><input type="radio" name="radio74"><i></i>D. 随大流，不挂科就行</label></div>
                </div>
                <div class="check_box">
                    <div class="radio2"><label><input type="radio" name="radio71" ><i></i>A. 尽早过四六级   </label>
                    </div>
                </div>
                <div class="check_box">
                    <div class="radio2"><label><input type="radio" name="radio72"><i></i>B. 自己想考托福、雅思、GRE</label></div>
                </div>
                <div class="check_box">
                    <div class="radio2"><label><input type="radio" name="radio73"><i></i> C. 好好学，争取考研 </label></div>
                </div>
                <div class="check_box">
                    <div class="radio2"><label><input type="radio" name="radio74"><i></i>D. 随大流，不挂科就行</label></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <form>
            <h5>Is there anything you would like to tell us?</h5>
            <textarea onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">Type here</textarea>
            <input type="submit" value="Send Feedback">
        </form>
    </div>

</div>


</body>
</html>