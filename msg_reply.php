<?php

include_once "config.php";
include_once ROOT_PATH."class/class_product.php";

include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$class_session=new class_session();
$class_user=new class_user();

$result = $class_user->select(@$_GET['to_user']);
$to_user_info = $result[0];

$current_user = $class_user->get_current_user();

// 导航 当前页面控制
$current_page = 'shop';
$page_level = explode('-', $current_page);

include 'view/msg_reply.php';
