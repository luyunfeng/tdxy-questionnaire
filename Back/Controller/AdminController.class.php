<?php
namespace Back\Controller;

use Think\Controller;
use Think\Verify;

class AdminController extends Controller
{
    //生成验证码
    public function verifyImg()
    {
        //根据 文档生成验证吗
        $cfg = array(
            'imageH' => 40,               // 验证码图片高度
            'imageW' => 100,               // 验证码图片宽度
            'fontSize' => 15,              // 验证码字体大小(px)
            'length' => 4,               // 验证码位数
            'fontttf' => '4.ttf',      // 验证码字体，不设置随机获取
        );
        //实例化Verify类对象
        $very = new \Think\Verify($cfg);
        $very->entry();
    }

    //登录系统
    public function login()
    {
        if (!empty($_POST)) {
            // post 非空的话 就把 登陆信息收集起来
            $userpwd = array(
                'username' => $_POST['username'],
                'password' => $_POST['password'],
            );

            //校验验证码
            $vry = new Verify();
            //先验证 验证吗是否正确
            if ($vry->check($_POST['checkcode'])) {

                //$info = D('management')->where($userpwd)->find();
                $info = D();
                $sql = "SELECT  *
                         FROM think_management
                         WHERE iuser='".$userpwd['username']."' AND passwd='".$userpwd['password']."'";

                $data = $info->query($sql);
                //如果有 保存session 跳转到首页
                if ($data) {
                    //session持久化用户信息(名字)，页面跳转
                    session('username', $userpwd['username']);
                    // 用户信息没有问题的话 进入首页

                    $this->redirect('Admin/index');
                } else {
                    $error = "用户名或密码错误";
                    $this->assign('error', $error);
                    //echo "用户名或密码错误";

                }
            } else {
                $error = "验证码输入有误，看不清？点击一下图片";
                $this->assign('error', $error);
                // echo "验证码错误";
                // 回显一下数据
                //dump($userpwd);
                $this->assign('user', $userpwd);
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
            //dump($session);
        }
    }

    //退出系统
    public function layout()
    {
        if (!empty($_GET)) {
            session('username', null);
        }
        $this->redirect('Admin/login');
    }

    public function index()
    {    //判断 是否登陆
        $this->islogin();

        $this->display();
    }

}