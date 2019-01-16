<?php

/*
前台用户信息修改接口

1，传入   user_id  user_name  head_url  user_occupation  user_introduction

2，传出   status:success/error
*/
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_qiniu.php";

include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
//计算字符串长度
function abslength($str)
{
    if(empty($str)){
        return 0;
    }
    if(function_exists('mb_abslength')){
        return mb_abslength($str,'utf-8');
    }
    else {
        preg_match_all("/./u", $str, $ar);
        return count($ar[0]);
    }
}
$class_session=new class_session();
$class_user=new class_user();

$class_idea=new class_idea();
$current_user = $class_user->get_current_user();
$user_id=$current_user['user_id'];
$arr['user_name']=$_POST['user_name'];
//表单验证
if(abslength(trim($_POST['user_name']))<=1||abslength(trim($_POST['user_name']))>16)
{
   $records['status']='user_name_length';
	echo json_encode($records);
}
elseif(abslength(trim($_POST['user_occupation']))<=1||abslength(trim($_POST['user_occupation']))>16)
{
 $records['status']='user_occupation_length';
	echo json_encode($records);
}
elseif(abslength(trim($_POST['user_occupation']))>200)
{
   $records['status']='user_introduction_length';
	echo json_encode($records);
}
else{
	//七牛处理图片
	//$qiniu= new class_qiniu();
	$pic_url=$_POST['head_url'];
	//$url_array = explode("/", $pic_url);
	//$key = end($url_array);
	//$key1 ="upload/".$user_id."/head/".$key;

	// $qiniu->move($key,$key1);
	// $pic_url=QINIU_DOWN.$key1;

	//
	$arr['head_pic_url']=$pic_url;
	$arr['occupation']=$_POST['user_occupation'];
	$arr['self_intro']=$_POST['user_introduction'];
	$res=$class_user->update($user_id,$arr);
	if(abslength(trim($arr['user_name']))<=0||abslength(trim($arr['user_name']))>40)
	{
	   # code...
		$records['status']='error';
		echo json_encode($records);
	}
	else
	{

	$sql="UPDATE `idea_info` set user_name='".$arr['user_name']."' where user_id=".$user_id;

	$class_idea->db->query($sql);
		if($res==1)
		{
			$records['status']='success';
			//$url="Location:".BASE_URL."person.php?user_id=".$user_id;
			//header($url);
			echo json_encode($records);
		}
		else {
			# code...
			$records['status']='error';
			echo json_encode($records);
		}
	}
}
