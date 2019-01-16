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
//验证参数
if(!array_key_exists('userid',$_GET))
{
   die("参数传递不正确！");
}
//获取用户信息
 $userinfo=$user->get_current_user();
 $user_id=$userinfo["user_id"];
 $to_user_id=$_GET["userid"];
include 'view/msg_send.php';
// 表单处理
if (array_key_exists('content',$_POST))
{
    $result=$message->send_to_uid($_POST["user_id"],$_POST["to_user_id"],$_POST["content"]);
	var_dump($result);
	//成功信息
	//echo '<script>alert("发送成功！");history.go(-1);</script>';
}