<?php

include_once "config.php";
include_once ROOT_PATH . "class/class_attention.php";
include_once ROOT_PATH . "class/class_session.php";
include_once ROOT_PATH . "class/class_user.php";
// 导航 当前页面控制
$user_session = new class_session();

$current_page = 'attention';
$page_level = explode('-', $current_page);

//判断是否登陆
$class_user = new class_user();
$current_user = $class_user->get_current_user();


if (!$user_session->check_login()) {
    $user_session->changePage(BASE_URL . "error.php");
}
//获取用户信息
$userid = $_SESSION["user_id"];
$userInfo = $class_user->select($userid);

include 'view/attention_2_page.php';
