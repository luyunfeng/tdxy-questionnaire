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
}