<?php

include_once 'config.php';
include_once ROOT_PATH."class/class_message.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
$user=new class_user();
$user_session=new class_session();
if(!$user_session->check_login())
{
   $user_session->changePage(BASE_URL."error.php");
}
$message=new class_message();
//验证用户是否登录
 if (!$user_session->check_login())
 {
   $url="Location:".BASE_URL."index.php";
   header($url);
 }

//获取用户信息
 $userinfo=$user->get_current_user();
 $user_id=$userinfo["user_id"];

include 'view/msg_receive.php';
