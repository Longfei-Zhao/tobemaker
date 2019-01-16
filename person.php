<?php

include_once "config.php";
include_once ROOT_PATH."class/class_qiniu.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
include_once ROOT_PATH."class/class_attention.php";
//上传suo xu
$qiniu= new class_qiniu();
$upToken=$qiniu->get_token_to_upload_head();

// 导航 当前页面控制
$current_page = 'person';
$page_level = explode('-', $current_page);
$class_session=new class_session();
if(!$class_session->check_login())
{
   $class_session->changePage(BASE_URL."error.php");
}
$class_user=new class_user();

$current_user = $class_user->get_current_user();
//  准备数据
if(array_key_exists('user_id', $_GET)){
	$user_info=$class_user->select($_GET['user_id']);
        
	if(count($user_info)==0)
	{
		echo "no user";
		header("Location:".BASE_URL);
	}else{
		$user_info=$user_info[0];
//                var_dump($user_info);
	}
}else{
    $user_id = $_SESSION['user_id'];
    $user_info = $class_user->select($user_id);
    $user_info=$user_info[0];
}

include 'view/person_page.php';
