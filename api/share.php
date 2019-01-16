<?php
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_share.php";
///获取分享信息
$class_idea=new class_idea();
function addshare($user_id,$idea_id){

	$class_share=new class_share();

		//点赞操作
		$aa=$class_share->click_share($idea_id,$user_id);
		if($aa==1){
			return return_result(2);
		}
		else{
			return return_result(3);
		}
    //返回数据
}
///创建分享记录
///返回状态
function return_result($status){
	$arr=array();
	if($status==1){
		$arr['status']='like_already';
	}
	elseif ($status==2) {
		# code...
		$arr['status']='success';
	}
	elseif ($status==3) {
		# code...
		$arr['status']='error';
	}
	echo json_encode($arr);
}


if(array_key_exists('idea_id',$_GET))
{
	addshare($_GET['user_id'],$_GET['idea_id']);
}
if(array_key_exists('action',$_POST))
{
   $act=$_POST["action"];
   if($act=='delete')
   {
      $idea_id=$_POST['id'];
	  $class_idea->delete($idea_id);
	  $arr=array();
	  $arr['status']='success';
	
	echo json_encode($arr);
   }
}
