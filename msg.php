<?php

include_once "config.php";
include_once ROOT_PATH."class/class_product.php";

include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$user_session=new class_session();

//判断是否登陆
$class_user=new class_user();
$current_user = $class_user->get_current_user();

if(!$user_session->check_login())
{
   $user_session->changePage(BASE_URL."error.php");
}
//获取用户信息
$userid=$_SESSION["user_id"];
$userInfo=$class_user->select($userid);



// 导航 当前页面控制
$current_page = 'shop';
$page_level = explode('-', $current_page);



include 'view/msg.php';
