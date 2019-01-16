<?php
include_once "config.php";

include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$class_session=new class_session();
$class_user=new class_user();

if ($class_session->check_login()){
    header("Location: ".BASE_URL."project_list.php");
}

include "view/index_page.php";
