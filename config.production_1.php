<?php

define('HOSTNAME','www.tobemaker.com' );

define('DESIGNMG_VERSION','0.1');
define('ROOT_PATH',  dirname(__FILE__).'/');

define('BASE_URL','http://'.HOSTNAME.'/' );

/*
 * MySQL
 * 
 */
//define('DATABASE_HOST', 'localhost');
define('DATABASE_HOST', '127.0.0.1');
define('DATABASE_NAME', 'tobemaker');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', 'aeb5c71b');

// 七牛云存储配置
define('ACCESS_KEY','RTmVwPnuQZv2HKjM6_HUQYmS-nSEIHEtUn5U0a68');
define('SECRET_KEY','bm9caZ5h6cEC3ErGiwwvYRo4zsyKEVkLGlhDLM3-');
define('BUCKET', 'tobemaker-pub');
define('QINIU_UP','http://up.qiniu.com/');
define('QINIU_DOWN','http://'.BUCKET.'.qiniudn.com/');


//邮箱工具

define('MAIL_HOST','smtp.126.com');
define('MAIL_ADDRESS', 'tobemaker@126.com');
define('MAIL_PASS', 'tobemaker1');
define('MAIL_USER', 'tobemaker');

// 类自动加载函数，当类找不到定义时，会调用这个函数
// 故要求每个类名都要与它的文件名相同

function __autoload($class_name) {
    require_once ROOT_PATH. 'class/' . strtolower($class_name) . '.php';
}
// 百度统计相关
define('BAIDUTJ_APPID', 'df3dd58eefcc04f3f83897975c10936c');

// 检查当前访问域名与设置的BASE_URL是否一致，避免出现跨站ajax的错误
if ( $_SERVER['HTTP_HOST'] != HOSTNAME ){
    header('Location: '.BASE_URL);
}