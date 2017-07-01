<?php
namespace Back\Controller;

use Think\Controller;


class UploadController extends Controller
{

    //登录系统
    public function upload()
    {


        if ($_FILES) {

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('xlsx', 'xls');// 设置附件上传类型
            $upload->rootPath = './Upload/'; // 设置附件上传根目录
            $upload->savePath = ''; // 设置附件上传（子）目录
            // 上传文件
            $info = $upload->upload();
            if (!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            } else {// 上传成功 获取上传文件信息
                foreach ($info as $file) {
                    $this->assign('info', '/Upload/'.$file['savepath'] . $file['savename']);
                }
            }

            //dump($info);


        }

        $this->display();
    }


}