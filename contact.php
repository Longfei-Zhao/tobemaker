<?php


include_once "config.php";

include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$class_session=new class_session();
if(!$class_session->check_login())
{
   $class_session->changePage(BASE_URL."error.php");
}
$class_user=new class_user();

$current_user = $class_user->get_current_user();


// 导航 当前页面控制
$current_page = 'contact';
$page_level = explode('-', $current_page);


include 'view/contact_page.php';
