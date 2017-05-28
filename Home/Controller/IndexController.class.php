<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function index()
    {

        // 首页进入后直接跳转到登陆
        $this->redirect('Login/login');

    }
    public  function  questionnaire(){
     // 判断一下是否登陆  待完成
     $this->display();

    }
}