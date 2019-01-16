<?php

/* 
  设置报错级别:
    1 E_ERROR 
    2 E_WARNING 
    4 E_PARSE 
    8 E_NOTICE 
    16 E_CORE_ERROR 
    32 E_CORE_WARNING 
    64 E_COMPILE_ERROR 
    128 E_COMPILE_WARNING 
    256 E_USER_ERROR 
    512 E_USER_WARNING 
    1024 E_USER_NOTICE 
    2047 E_ALL 
    2048 E_STRICT 
 */
error_reporting(E_ALL);
//error_reporting(0);

require_once '../config.php';

if (!array_key_exists('PATH_INFO', $_SERVER)){
    die('error input');
}

/*
 * 获取当前用户信息
 */

$session = new class_Session();

/*
 * URI分割，从url中提取要访问的类、方法和参数
 * 
 * api.php/class/method/args...
 */

$uri = $_SERVER['PATH_INFO'];

$uri = trim($uri, '/');

if (strlen($uri)==0){
    die('error input');
}

$uri_array = explode('/', $uri);

$class = $uri_array[0];
$method = "index";
if (count($uri_array) >= 2){
    $method = $uri_array[1];
}

if (!is_file(ROOT_PATH."api/$class.php")){
    die('error class');
}else{
    include ROOT_PATH."api/$class.php";
}

/*
 * 调用方法
 */

$DM = new $class();

if (!method_exists($DM, $method)){
    die('error method');
}
$result = call_user_func_array(array($DM, $method), array_slice($uri_array, 2));

/*
 * 返回结果
 */

echo json_encode($result);
