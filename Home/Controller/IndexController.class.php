<?php
namespace Home\Controller;

use Think\Controller;
use Think\Verify;

class IndexController extends Controller
{
    public function index()
    {
        // 首页进入后直接跳转到登陆
        $this->redirect('Index/login');

    }

    //登录系统
    public function login()
    {
        if (!empty($_POST)) {
            // post 非空的话 就把 登陆信息收集起来
            //表单收集  过来到 username 和password 封装在一个数组里面
            $userpwd = array(
                'iuser' => $_POST['username'],
                'passwd' => $_POST['password'],
            );
            //校验验证码
            $vry = new Verify();
            //先验证 验证吗是否正确
            // if ($vry->check($_POST['checkcode'])) {
            if (true) {
                // 去数据库查 这一个组合
                $info = D('student')->where($userpwd)->find();
                //如果有 保存session 跳转到首页
                if ($info) {

                    // 验证一下如果 提交过后 就无法进入系统 检查一下是否填过
                    $sql2 = "SELECT istatus FROM think_student WHERE iuser=" . $info['iuser'];
                    $istatus = D()->query($sql2);
                    // 为 1 的话 不能再次登录
                    if ($istatus[0]["istatus"] == 1) {
                        $error = "你已经提交过问卷调查了,无法再次进入";
                        $this->assign('error', $error);
                    }else{
                        //得到当前时间
                        date_default_timezone_set("Asia/Shanghai");// 定在 上海时区
                        $time = date("Y-m-d") . " " . date("H:i:s");
                        // 保存一下登陆时间
                        $sql = "UPDATE think_student SET logintime = '" . $time . "' WHERE iuser = " . $info['iuser'];
                        D()->execute($sql);

                        //session持久化用户信息(名字)，页面跳转

                        $iuser = "id" . (string)$info['iuser'] . ""; // key
                        $_SESSION[$iuser] = $info['iuser']; // 保存
                        // dump($_SESSION);
                        // 用户信息没有问题的话 开始做题 跳到题目页面  带参数 传递
                        $url = 'questionnaire?iuser=' . $info['iuser'];// 目标 url
                        //$this->success('登陆成功', $url, 3);
                        $this->redirect($url);
                    }



                } else {
                    $error = "用户名或密码错误";
                    $this->assign('error', $error);
                    //echo "用户名或密码错误";
                }
            } else {
                $error = "验证码输入有误，看不清？点击一下图片";
                $this->assign('error', $error);
            }
            // 信息填错  回显一下 数据
            $this->assign('user', $userpwd);
        }
        $this->display();
    }

    public function questionnaire()
    {

        if ($_GET['iuser']) {

            $iuser = "id" . $_GET['iuser'];

            // dump($_SESSION[$iuser]);
            // 比较 一下 session 中取出来的值 和 get 请求的值 是否 一致，不一致表示未登录跳回去
            if ($_SESSION[$iuser] == NULL) {
                $this->redirect('Index/login');
            }


            // 在数据中把所有 学生的信息 取出来 根据考号
            $sql = "SELECT * FROM think_student WHERE iuser=" . $_GET['iuser'];
            $studata = D()->query($sql);
            // dump($studata);
            $this->assign('studata', $studata[0]);
        }

        // 调出  问卷
        $questionnaire = $this->getQuestionnaire($iuser);
        //dump($questionnaire);
        $this->assign('questionnaire', $questionnaire);

        $this->display();

    }

    // 调出  问卷
    private function getQuestionnaire()
    {
        // 把题目 从数据库中取出来
        // 先选择题
        $sql_select = "SELECT think_questionsnaire_selected.inumber,
                            think_questionsnaire_selected.text1,
                            think_questionsnaire_selected.itype
                       FROM think_questionsnaire_selected";
        $sql_option = "SELECT think_questionsnaire_option.inumber,
                            think_questionsnaire_option.ioption,
                            think_questionsnaire_option.text1
                      FROM  think_questionsnaire_option";
        $select = D()->query($sql_select);
        $option = D()->query($sql_option);
        //dump($select);
        //dump($option);
        // 将题目和选项合并
        // 遍历选项 ，将题目 放入
        $number = -1;// 题号-1
        for ($i = 0; $i < count($option, COUNT_NORMAL); $i++) {

            if ($option[$i]["ioption"] == "A") {
                $number++;
            }
            //dump($option[$i]['text1']);
            $select[$number][$option[$i]['ioption']] = $option[$i]['text1'];
        }
        // 这里为止 select 保存的
        /*
         array(48) {
               [0] => array(5) {
                ["inumber"] => string(1) "1"
                ["text1"] => string(15) "你是性别是"
                ["itype"] => string(1) "0"
                ["A"] => string(3) "男"
                ["B"] => string(3) "女"
               }
               .....
         }
         * */
        //  需要转换成下面 这个样子
        /*
         * <h5>1.你的性别是</h5>
        <div class="radio-btns">
            <!--name 一样就可以完成单选的功能-->
            <div class="swit">
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio1" class="option"
                                                     value="1A"><i></i>男</label></div>
                </div>
                <div class="check_box">
                    <div class="radio"><label><input type="radio" name="radio1" class="option"
                                                     value="1B"><i></i>女</label></div>
                </div>

                <div class="clear"></div>
            </div>
        </div>
         * */
        $html = "";

        for ($i = 0; $i < count($select, COUNT_NORMAL); $i++) {
            // 标题
            $html = $html . "<h5>" . $select[$i]["inumber"] . ". " . $select[$i]["text1"] . "</h5><div class=\"radio-btns\">
            <div class=\"swit\">";

            for ($j = 0; $j < count($select[$i], COUNT_NORMAL) - 3; $j++) {
                // 判断一下 多选还是单选
                if ($select[$i]["itype"] == "0") { // 单选
                    $html = $html . "<div class=\"check_box\"> <div class=\"radio\"><label><input type=\"radio\" name=\"radio" .
                        $select[$i]["inumber"] . "\" class=\"option\" value=\"" . $select[$i]["inumber"] . "&"
                        . chr(65 + $j) . "\"><i></i>" . chr(65 + $j) . "." . $select[$i][chr(65 + $j)] . "</label></div></div>";
                } else {  // 多选
                    $html = $html . "<div class=\"check_box\"> <div class=\"radio\"><label><input type=\"radio\" name=\"radio" .
                        $select[$i]["inumber"] . chr(65 + $j) . "\" class=\"option\" value=\"" . $select[$i]["inumber"] . "&"
                        . chr(65 + $j) . "\"><i></i>" . chr(65 + $j) . "." . $select[$i][chr(65 + $j)] . "</label></div></div>";

                    // $html = $html.

                }
            }

            $html = $html . "<div class=\"clear\"></div></div></div>";
        }


        // 取出填空题
        $sql_freesponce = "SELECT *FROM think_questionsnaire_freesponce";
        $freesponce = D()->query($sql_freesponce);
        /* [0] => array(3) {
    ["iterm"] => string(9) "2017-2018"
    ["inumber"] => string(2) "49"
    ["text1"] => string(102) "为了更好地学习英语、数学和物理课程，你对这三门基础课程教学有何建议？"
  }*/
        //dump($freesponce);
        for ($m = 0; $m < count($freesponce, COUNT_NORMAL); $m++) {
            $html = $html . "<h5>" . $freesponce[$m]["inumber"] . "." . $freesponce[$m]["text1"] . "</h5>
        <textarea class=\"freesponce\" ></textarea>";
        }


        return $html;
    }

    public function saveAnswer()
    {
        /*
         * array(2) {
          ["answer_select"] => string(9) "15&A,16&D"
          ["answer_fill"] => string(12) "rqewr&&eqe&&"
         }
        ["answer_select"] => string(3) "4&D"
        ["answer_fill"] => string(26) "a'd'sa's'd&&啊实打实&&"
       ["idnumber"] => string(18) "32068419950619641x"
         *
         * */

        // 只要收到 post 请求
        if ($_POST["idnumber"]) {
            // 提交之前把身份查出来    60 分钟直接作废
            $idnumber = $_POST["idnumber"];// 身份证

            // 第一步 提交 选择题
            $split_select = explode(',', $_POST["answer_select"]);
            $sql_value = "";
            foreach ($split_select as $s) {
                $split = explode('&', $s);
                $sql_value = $sql_value . "('2017-2018'," . $split[0] . ",'" . $idnumber . "','" . $split[1] . "'),";
            }
            $sql_value = substr($sql_value, 0, strlen($sql_value) - 1);
            $sql1 = "INSERT INTO think_questionsnaire_sanswer VALUES " . $sql_value;
            //dump($sql1);
            $succsee1 = D()->execute($sql1); // 失败就返回 false
            // 如果 如果发生问题
            if ($succsee1 != false) {

                // 第二步提交填空题
                $split_fill = explode('&&', $_POST["answer_fill"]);
                // 这里默认只能 两题  填空题  多的话需要改 就是 49 和50 题
                //  传入的 文字 还需要转义一下 防止 sql 攻击
                $sql2 = "INSERT INTO think_questionsnaire_fanswer VALUES
                  ('2017-2018',49,'" . $idnumber . "','" . $split_fill[0] . "')," .
                    " ('2017-2018',50,'" . $idnumber . "','" . $split_fill[1] . "');";
                $succsee2 = D()->execute($sql2);
                //dump($sql2);
                if ($succsee2 != false) {

                    // 最后将 填写状态 写成1 表示登陆过  写上完成时间
                    //得到当前时间
                    date_default_timezone_set("Asia/Shanghai");// 定在 上海时区
                    $time = date("Y-m-d") . " " . date("H:i:s");
                    // 保存一下登陆时间
                    $sql3 = "UPDATE think_student SET finishtime = '" . $time . "' ,istatus=1 WHERE idnumber = '" . $idnumber . "'";
                    $succsee3 = D()->execute($sql3);
                    //dump($sql3);
                    if ($succsee3 != false) {

                        // 删除  当前的  session
                        $sql4 = "SELECT iuser FROM think_student WHERE idnumber = '" . $idnumber . "'";
                        $iuser = D()->query($sql4);
                        $iuser = "id" . (string)$iuser[0]["iuser"] . ""; // key

                        unset($_SESSION[$iuser]);

                        //$_SESSION = array();
                        dump($_SESSION);
                        $this->success('已完成，多谢配合，祝你学习愉快....', 'Index/login', 300);

                    } else {
                        //  这里可以 发生错误时 留下 联系方式
                        $this->error("很抱歉系统繁忙请稍后再试,如果一直出现这样问题联系管理员", 'Index/login', 300);
                    }
                } else {
                    $this->error("很抱歉系统繁忙请稍后再试,如果一直出现这样问题联系管理员", 'Index/login', 300);
                }

            } else {
                $this->error("很抱歉系统繁忙请稍后再试,如果一直出现这样问题联系管理员", 'Index/login', 300);
            }

        }

    }

     //生成验证码
    public function verifyImg()
    {
        //根据 文档生成验证吗
        $cfg = array(
            'imageH' => 40,               // 验证码图片高度
            'imageW' => 100,               // 验证码图片宽度
            'fontSize' => 15,              // 验证码字体大小(px)
            'length' => 4,               // 验证码位数
            'fontttf' => '4.ttf',              // 验证码字体，不设置随机获取
        );
        //实例化Verify类对象
        $very = new \Think\Verify($cfg);
        $very->entry();
    }

}