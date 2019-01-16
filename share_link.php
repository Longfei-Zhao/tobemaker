<?PHP
include_once "config.php";
include_once ROOT_PATH."class/class_share.php";
header("Content-type:text/html;charset=utf-8");


if(array_key_exists('user_id',$_GET)){

	// 获取所有参数 url user_id  idea_id
	$user_id=$_GET['user_id'];
	$idea_id=$_GET['idea_id'];
	$url=$_GET['url'];

	// 添加分享信息
	add_share_by_wechat($user_id,$idea_id);
	
// 跳转页面
	$jump_url="Location:http://".$url;
	header($jump_url);
}


function add_share_by_wechat($user_id,$idea_id)
{
	# code...
	 $class_share=new class_share();
	 $class_share->share_by_wechat($idea_id,$user_id);
}

?>