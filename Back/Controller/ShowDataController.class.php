<?php
namespace Back\Controller;

use Think\Controller;


class ShowDataController extends Controller
{

    // 内部方法，用来 去除字符串中特殊 符号 包括空格
    private function remove_sign($str)
    {
        $before = array(" ", "　", "\t", "\n", "\r", "?", "=", ">", "<", "&", "|", "'", "\"");
        return str_replace($before, '', $str);
    }

    //  图表展示
    public function echarts()
    {
        ini_set('memory_limit','128M');
        // 判别一下文理科
        if ($_GET) {
            // 题目 拼接成完整的 html 发送到前端
            $html = $this->getQuestionnaire($_GET['collegebranch']);
            $this->assign('questionnaire', $html);
            unset($html);
            //  选择题统计结果的数据
            $data = $this->getChoiceQuestionData($_GET['collegebranch']);
            // 转换成 json 数据 ，然后到前台去解析
            $this->assign('data', json_encode($data));
            unset($data);
        }
        $this->display();
    }

    //  得到选择题统计数据    分文理科
    private function getChoiceQuestionData($collegebranch)
    {
        ini_set('memory_limit','128M');
        //  选择题 统计结果
        $sql = "SELECT inumber ,answer,count(answer) AS count FROM think_questionsnaire_sanswer 
               WHERE collegebranch=" . $collegebranch . "
                  GROUP BY inumber ,answer;";
        $data = D()->query($sql);
        $newdata[1]["A"]=0;
        //  处理一下统计结果然后返回
        for ($i = 0; $i < count($data, COUNT_NORMAL); $i++) { //intval
            $newdata[$data[$i]['inumber']][$data[$i]['answer']] = (int)$data[$i]['count'];
        }
        //  初始化一下A选项 如果还没有学生 达题的话  没有初始化会出一点小 BUG
        for ($i = 1; $i <= 48; $i++) {
            if( $newdata[$i]==null){
                $newdata[$i]['A'] = 0;
            }
        }
        unset($data);
        /*  返回如下数据
         *  列出 选择题 数据
         *  [1] => array(2) {
               ["A"] => string(1) "2"
               ["B"] => string(1) "1"
            }
            [2] => array(1) {
               ["A"] => string(1) "3"
            }
            [3] => array(4) {
               ["A"] => string(1) "3"
               ["B"] => string(1) "3"
               ["E"] => string(1) "1"
               ["F"] => string(1) "1"
           }
          */

        return $newdata;
    }

    // 把题目 从数据库中取出来
    private function getQuestionnaire($collegebranch)
    {

        // 先选择题
        $sql_select = "SELECT think_questionsnaire_selected.inumber,
                            think_questionsnaire_selected.text1,
                            think_questionsnaire_selected.itype
                       FROM think_questionsnaire_selected  WHERE collegebranch=" . $collegebranch;
        $sql_option = "SELECT think_questionsnaire_option.inumber,
                            think_questionsnaire_option.ioption,
                            think_questionsnaire_option.text1
                      FROM  think_questionsnaire_option  WHERE collegebranch=" . $collegebranch;

        $select = D()->query($sql_select);
        $option = D()->query($sql_option);
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
        unset($option);
        /*
         * 合并结束
         array(48) {
           [0] => array(5) {
             ["inumber"] => string(1) "1"
             ["text1"] => string(15) "你是性别是"
            ["itype"] => string(1) "0"
            ["A"] => string(3) "男"
           ["B"] => string(3) "女"
        }
        转换成
        /*<div class="data"><div class="charts" ></div>
          <div class="question">42. 大一下学期就开设物理课程了，你如何为之做准备
         <p>A. 要提前先温习一下高中知识，到图书馆借些书看看&nbsp;</p></div></div>
         * */
        $html = "";
        for ($i = 0; $i < count($select, COUNT_NORMAL); $i++) {
            // 标题
            $html = $html . "<div class=\"data\"><div class=\"charts\" ></div><div class=\"question\">" .
                $select[$i]["inumber"] . ". " . $select[$i]["text1"] . "<p>";
            for ($j = 0; $j < count($select[$i], COUNT_NORMAL) - 3; $j++) {
                /*$html = $html . "<div class=\"check_box\"> <div class=\"radio\"><label><input type=\"radio\" name=\"radio" .
                    $select[$i]["inumber"] . "\" class=\"option\" value=\"" . $select[$i]["inumber"] . "&"
                    . chr(65 + $j) . "\"><i></i>" . chr(65 + $j) . "." . $select[$i][chr(65 + $j)] . "</label></div></div>";*/
                $html = $html . chr(65 + $j) . "." . $select[$i][chr(65 + $j)] . "&nbsp;";

            }
            $html = $html . "</p></div></div>";
        }
        return $html;

    }

    // 主要用来 搜索学生是否完成问卷调查
    public function searchData()
    {
        // 根据学生名字 搜索
        /*
        if ($_POST['student_name']){
            $iname=$_POST['student_name'];
            // 祛除  空格
            $iname=$this->remove_sign($iname);
            // 只要查找 学生的  身份证 名字 完成状态
            $sql="select dnumber,iname,istatus from think_student where iname='".$iname."'";

            $stu_info=D()->query($sql);
            $str_msg="";
            if($stu_info!=null){
                // 如果 查找到学生信息，就判断 是否 完成问卷
                if($stu_info[0]["istatus"]==0){
                    $str_msg="未完成";
                }else{
                    $str_msg="已完成";
                    $this->assign('stu_info', $stu_info);
                }
            }else{
                $this->assign('stu_error', "查无此人");
            }


        }*/

        // 根据学生 身份证搜索
        if ($_POST['student_id']) {
            $student_id = $_POST['student_id'];
            // 祛除  空格
            $student_id = $this->remove_sign($student_id);
            // 只要查找 学生的  身份证 名字 完成状态
            $sql = "SELECT idnumber,iname,istatus FROM think_student WHERE idnumber='" . $student_id . "'";

            $stu_info = D()->query($sql);
            //  主要是控制颜色
            $str_msg_1 = "";
            $str_msg_2 = "";
            if ($stu_info != null) {
                // 如果 查找到学生信息，就判断 是否 完成问卷
                if ($stu_info[0]["istatus"] == 0) {
                    $str_msg_1 = "未完成";
                    $this->assign('str_msg_1', $str_msg_1);
                } else {
                    $str_msg_2 = "已完成";
                    $this->assign('str_msg_2', $str_msg_2);
                }


                $this->assign('stu_info', $stu_info[0]);
            } else {
                $this->assign('stu_error', "查无此人");
            }


        }
        $this->display();
    }


    public  function suggest()
    {
        $sql="SELECT text1 AS suggest FROM think_questionsnaire_fanswer  WHERE length(text1)>0 AND(inumber=49 OR inumber=36);";
        $first_suggests = D()->query($sql);
        $this->assign('first_suggests', $first_suggests);
       // dump($first_suggests);
        unset($first_suggests);
        $sql="SELECT text1 AS suggest FROM think_questionsnaire_fanswer  WHERE length(text1)>0 AND(inumber=50 OR inumber=37);";
        // 找出 这两题的  题目
        $second_suggests = D()->query($sql);
        $this->assign('second_suggests', $second_suggests);
        unset($second_suggests);
         // 查询出 题目
        $sql_topic="SELECT text1 FROM think_questionsnaire_freesponce WHERE collegebranch=0";
        $topic = D()->query($sql_topic);
        $this->assign('topic', $topic);
       // dump($topic);
        $this->display();
    }



    // 判断是否登陆
    public function islogin()
    {
        if (!isset($_SESSION['username'])) {
            $this->error('对不起,您还没有登录!请先登录再进行浏览', U('Admin/login'), 2);
        } else {
            $session = $_SESSION['username'];
            $this->assign('username', $session);

        }
    }


}