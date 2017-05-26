<?php
return array(
	//'配置项'=>'配置值'
    //增加调试信息  在上线的屏蔽掉
    SHOW_PAGE_TRACE => true,
    'VAR_AJAX_SUBMIT'  =>  'ajax',  // 默认的AJAX提交变量
    //前台  Home 配置
    'CSS_URL' => '/tdxy-questionnaire/Home/Public/css/',
    'JS_URL' => '/tdxy-questionnaire/Home/Public/js/',
    'IMG_URL' => '/tdxy-questionnaire/Home/Public/img/',
    //后台  Back 配置
    'BACK_CSS_URL' => '/tdxy-questionnaire/Back/Public/css/',
    'BACK_JS_URL' => '/tdxy-questionnaire/Back/Public/js/',
    'BACK_IMG_URL' => '/tdxy-questionnaire/Back/Public/img/',



    /* 数据库设置 */
    'DB_TYPE' => 'mysql',     // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'stu_questionsnaire',          // 数据库名
    'DB_USER' => 'root',      // 用户名
    'DB_PWD' => '123',          // 密码
    'DB_PORT' => '3306',        // 端口
    'DB_PREFIX' => 'db_',    // 数据库表前缀
    'DB_PARAMS' => array(), // 数据库连接参数
    'DB_DEBUG' => TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE' => true,        // 启用字段缓存
    'DB_CHARSET' => 'utf8',      // 数据库编码默认采用utf8
);