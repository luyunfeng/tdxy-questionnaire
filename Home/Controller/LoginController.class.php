<?php
namespace Home\Controller;

use Think\Controller;
use Think\Verify;

class LoginController extends Controller
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
            'fontttf' => '4.ttf',              // 验证码字体，不设置随机获取
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
                //表单收集  过来到 username 和password 封装在一个数组里面

                // 去数据库查 这一个组合
                //$info = D('user')->where($userpwd)->find();
                //如果有 保存session 跳转到首页
                //if ($info) {
                if ($userpwd) {
                    //session持久化用户信息(名字)，页面跳转
                    // session('username', $info['username']);
                    //session('userid',$info['userid']);
                    session('username', $userpwd['username']);
                    session('userid', $userpwd['userid']);
                    //dump(session('userid'));
                    // 用户信息没有问题的话 开始做题 跳到题目页面
                    $this->redirect('');
                } else {
                    $error = "用户名或密码错误";
                    $this->assign('error', $error);
                    //echo "用户名或密码错误";
                }
            } else {
                $error = "验证码输入有误";
                $this->assign('error', $error);
                // echo "验证码错误";
                // 回显一下数据
                //dump($userpwd);
                $this->assign('user', $userpwd);

            }
        }


        $this->display();
    }

    // 登陆名 恶意字符判断
    function checkstr($str)
    {
        $needle = "a";//判断是否包含a这个字符
        $tmparray = explode($needle, $str);
        if (count($tmparray) > 1) {
            return true;
        } else {
            return false;
        }
    }
}