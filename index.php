<?php
/**
 * Created by PhpStorm.
 * User: lucode
 * Date: 2017/5/26
 * Time: 15:37
 */
// 设置为开发者模式，默认为false 产品上线的时候使用
header("content-type:text/html;charset=utf-8");
define('APP_DEBUG',true);
//导入 tp框架
include("../ThinkPHP/ThinkPHP.php");