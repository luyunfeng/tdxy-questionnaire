<?php
namespace Back\Controller;

use Think\Controller;


class ShowDataController extends Controller
{

    public function echarts(){
       // $this->islogin();
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