<?php


include_once "config.php";

include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
include_once ROOT_PATH."class/class_like.php";

$class_session=new class_session();
if(!$class_session->check_login())
{
   $class_session->changePage(BASE_URL."error.php");
}
$class_user=new class_user();
$class_like = new class_like();

$current_user = $class_user->get_current_user();

// 导航 当前页面控制
$current_page = 'project';
$page_level = explode('-', $current_page);

include ROOT_PATH."/class/class_idea.php";
include_once ROOT_PATH."/class/class_comment.php";
        //获取数据
$class_comment=new class_comment();

$user_id=$current_user['user_id']; 

$preview_status = false;

//如果是评论请求
if(array_key_exists('saytext', $_POST)){
    
	if(strlen(trim($_POST["saytext"]))<=0)
	{
	    //返回错误信息
		echo '<script>alert("评论内容不能为空");history.go(-1);</script>';return;
	}
    $class_comment->add_comment($_POST["idea_id"],$user_id,$_POST["saytext"]);
}

//如果预览  如果预览请求
if(array_key_exists('title', $_POST)){
    //预览页面的数据
    $item[0]['name']=$_POST['title'];
    $item[0]['content']=$_POST['content'];
    $item[0]['picture_url']=$_POST['img_url'];
    $item[0]['user_id']=$current_user['user_id'];
    if(isset($_POST['cover_display'])){
        $item[0]['cover_display']=$_POST['cover_display'];
    }
    $item[0]['tags'] = $_POST['tags'];
    $item[0]['user_name']=$current_user['user_name'];
	$item[0]['idea_status'] = 0;
    $is_like_item = 0;
    
    $preview_status = true;
}else{
    
    if(!empty($_GET["idea_id"])){   // 默认显示主页
    //有id 则请求id对应详细
    $idea_id=$_GET["idea_id"]; //有请求的idea
    // 调用view来显示
	$class_idea=new class_idea();
	$item=$class_idea->get_idea_by_id($idea_id);
    
	if($item[0]["idea_status"]<5)
    $is_like_item = $class_like->get_like_info($idea_id, $user_id);
    else
	{
	  $is_like_item = $class_like->get_wantbuy_info($idea_id, $user_id);
	}

    }else{
        die("页面传入参数错误");
    }
    
}



//计算字符串长度
function abslength($str)
{
    if(empty($str)){
        return 0;
    }
    if(function_exists('mb_strlen')){
        return mb_strlen($str,'utf-8');
    }
    else {
        preg_match_all("/./u", $str, $ar);
        return count($ar[0]);
    }
}

include 'view/project_page.php';

