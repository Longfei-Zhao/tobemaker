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

// 排序方式
$sort_rule = 'new';
// 关键字查询
$search_word = null;

if (array_key_exists('sort', $_GET)){
    $sort_rule = $_GET['sort'];
}

if (array_key_exists('search', $_GET)){
    $search_word = $_GET['search'];
}

// 导航 当前页面控制
$current_page = 'project_list';
$page_level = explode('-', $current_page);

include 'view/project_list_page.php';