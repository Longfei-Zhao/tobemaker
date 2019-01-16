<?php
include_once "config.php";

include ROOT_PATH."/class/class_idea.php";

if(!empty($_GET["idea_id"])){   // 默认显示主页
    //有id 则请求id对应详细
    $idea_id=$_GET["idea_id"]; //有请求的idea
    // 调用view来显示
    $class_idea=new class_idea();
    $item=$class_idea->get_idea_by_id($idea_id);

}else{
    die("页面传入参数错误");
}

include 'view/project_mobile_page.php';