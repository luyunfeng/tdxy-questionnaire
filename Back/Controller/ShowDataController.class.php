<?php
namespace Back\Controller;

use Think\Controller;


class ShowDataController extends Controller
{
    // 内部方法，用来 去除字符串中特殊 符号 包括空格
    private function remove_sign($str){
        $before=array(" ","　","\t","\n","\r","?","=",">","<","&","|","'","\"");
        return str_replace($before, '', $str);
    }

    public function echarts(){
        $this->islogin();
        $this->display();
    }

    // 主要用来 搜索学生是否完成问卷调查
    public  function searchData(){
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
        if ($_POST['student_id']){
            $student_id=$_POST['student_id'];
            // 祛除  空格
            $student_id=$this->remove_sign($student_id);
            // 只要查找 学生的  身份证 名字 完成状态
            $sql="select idnumber,iname,istatus from think_student where idnumber='".$student_id."'";

            $stu_info=D()->query($sql);
            //  主要是控制颜色
            $str_msg_1="";
            $str_msg_2="";
            if($stu_info!=null){
                // 如果 查找到学生信息，就判断 是否 完成问卷
                if($stu_info[0]["istatus"]==0){
                    $str_msg_1="未完成";
                    $this->assign('str_msg_1', $str_msg_1);
                }else{
                    $str_msg_2="已完成";
                    $this->assign('str_msg_2', $str_msg_2);
                }


                $this->assign('stu_info', $stu_info[0]);
            }else{
                $this->assign('stu_error', "查无此人");
            }


        }
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