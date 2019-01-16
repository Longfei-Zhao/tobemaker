<?php
include_once "../config.php";
include_once ROOT_PATH."class/class_group_auth.php";
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
$current_page = 'idea-idea_recommend';
$page_level = explode('-', $current_page);

$page_level_style = '

';

$page_level_plugins = '
';

$page_level_script = '';
include_once '../config.php';
include_once ROOT_PATH.'class/class_idea.php';
$class_idea=new class_idea();


if(array_key_exists('change_recommend', $_POST)){
$num_of_change=count($_POST)-1;
$keys=array_keys($_POST);
$change_recommend=array_values($_POST);
	$i=0;
	while ($i<$num_of_change) {
		# code...
		$idea_id=$keys[$i];
		$change=$change_recommend[$i];
		//echo $change;

		$sql="UPDATE `idea_info` SET `is_recommend`=".$change." where idea_id=".$idea_id;
		//echo $sql;
		$class_idea->db->query($sql);
		$i++;
		
	}
}

$sql='SELECT * from `idea_info`,`idea_status` where `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_info`.`is_recommend`>0 order by `idea_info`.`is_recommend` desc';
$item_list=$class_idea->select($sql);
$num=count($item_list);

include 'view/idea_recommend.php';