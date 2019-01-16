<?php
    include_once "../config.php";
    include_once ROOT_PATH."class/class_comment.php";
    if(isset($_POST["saytext"])){
       $class_comment1=new class_comment();
       echo $_POST["idea_id"];
       $class_comment1->add_comment($_POST["idea_id"],$_POST["user_id"],$_POST["saytext"]);
    }
    else{
        echo "asdfasd";
    }
    if(empty($_GET["idea_id"])){
    	//header('Location: http://www.cc.com');
    }
    else{
    	$idea_id=$_GET["idea_id"];
    	// 调用view来显示
    	include "item.php";
    }
    //  留空  处理提交的评论信息
    //   获取评论者的会话id
    //   获取当前想法id
    //   获取评论内容
    //    调用class_comment 类

    


