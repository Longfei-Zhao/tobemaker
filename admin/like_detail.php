<?php

include_once '../config.php';
include_once ROOT_PATH."class/class_group_auth.php";
include_once ROOT_PATH.'class/class_like.php';
$class_group_auth=new class_group_auth();
//判断权限
if(!$class_group_auth->check_auth("admin"))
  {
  $url="Location:".BASE_URL."error.php";
  header($url);
    //echo '<script>alert("对不起，您没有权限！");history.go(-1);</script>';
	//die('对不起，您没有权限！请登录或联系管理员！');
	//return;
  }
// 导航 当前页面控制
$current_page = 'idea-like_detail';
$page_level = explode('-', $current_page);
$idea_id=$_GET['idea_id'];
$like_info=new class_like();
$list=$like_info->get_like_detail($idea_id);
include 'view/like_detail.php';
