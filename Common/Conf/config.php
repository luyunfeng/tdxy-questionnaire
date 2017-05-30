<?php
return array(
    //'配置项'=>'配置值'
    //增加调试信息  在上线的屏蔽掉
    SHOW_PAGE_TRACE => true,
    'VAR_AJAX_SUBMIT' => 'ajax',  // 默认的AJAX提交变量
    //'SESSION_AUTO_START' => true, //是否开启session
    /*'SESSION_OPTIONS'         =>  array(
        'name'                =>  'BJYSESSION',                    //设置session名
        'expire'              =>  60,                            //SESSION保存时间
        'use_trans_sid'       =>  1,                               //跨页传递
        'use_only_cookies'    =>  0,                               //是否只开启基于cookies的session的会话方式
    ),*/
    'SESSION_OPTIONS' => array('use_only_cookies' => 0, 'use_trans_sid' => 1),


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
    'DB_NAME' => 'think_stu_questionsnaire',          // 数据库名
    'DB_USER' => 'root',      // 用户名
    'DB_PWD' => '123',          // 密码
    'DB_PORT' => '3307',        // 端口
    'DB_PREFIX' => 'think_',    // 数据库表前缀
    'DB_PARAMS' => array(), // 数据库连接参数
    'DB_DEBUG' => TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE' => true,        // 启用字段缓存
    'DB_CHARSET' => 'utf8',      // 数据库编码默认采用utf8
);