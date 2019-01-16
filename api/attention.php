<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_attention.php";
include_once ROOT_PATH."class/class_user.php";
$attention=new class_attention();
$user=new class_user();
//$iTotalRecords =$group->get_group_num();

//if (array_key_exists('action', $_REQUEST)){
//
//    var_dump($_REQUEST);
//    exit();
//}

if(isset($_POST["action"])){
  $act=$_POST["action"];
  if($act=='add')//添加关注
  {
    $userid=$_POST["userid"];
	$attention_userid=$_POST["attention_userid"];
	if(!$attention->checkunique($userid,$attention_userid))
	{
	   $attention->insert($userid,$attention_userid);
	}
	 $res= array();
     $res['status']='success';
     echo json_encode($res);
  }
  elseif($act=='delete')//取消关注
  {
       $userid=$_POST["userid"];
	   $attention_userid=$_POST["attention_userid"];
	   $attention->delete($userid,$attention_userid);
	    $res= array();
        $res['status']='success';
        echo json_encode($res);
  }
  elseif($act=='view-me')//查看我的关注
  {
      $userid=$_POST["userid"];
	   // 总项目数
       // 当前显示数量
    $iTotalRecords=$attention->get_num_attention($userid);
	
    $Length = $_POST['length'];
    $Length = $Length < 0 ? $iTotalRecords : $Length; 
	$iDisplayStart = $_POST['start'];
	$records = array();
    $records["data"] = array(); 
	$end = $iDisplayStart + $Length;
    $end = $end > $iTotalRecords ? $iTotalRecords : $end;
    $real_length=$end-$iDisplayStart+1;
	//获取数据
	$dataList=$attention->get_part_attention($userid,$iDisplayStart-1,$real_length);
	//echo $real_length;
	$real_length= count($dataList);
	for($i = 0; $i < $real_length; $i++) {
	$userinfo=$user->select($dataList[$i]["attention_userid"]);
	$records["data"][] = array(@$userinfo[0]["user_id"],@$userinfo[0]["user_name"],@$userinfo[0]["head_pic_url"]);
	
    
    
	}
	$records["recordsTotal"] = $iTotalRecords;
    $records["start"] = $iDisplayStart;
	
	echo json_encode($records);
  }
  elseif($act=='view-attention-me')
  {
             $attention_userid=$_POST["attention_userid"];
	   // 总项目数
       // 当前显示数量
    $iTotalRecords=$attention->get_num_attention_me($attention_userid);
    $Length = intval($_POST['length']);
    $Length = $Length < 0 ? $iTotalRecords : $Length; 
	$iDisplayStart = intval($_POST['start']);
	$records = array();
    $records["data"] = array(); 
	$end = $iDisplayStart + $Length;
    $end = $end > $iTotalRecords ? $iTotalRecords : $end;
    $real_length=$end-$iDisplayStart;
	//获取数据
	$dataList=$attention->get_part_attention($attention_userid,$iDisplayStart,$real_length);
	 
	$real_length= count($datalist);
	for($i = 0; $i < $real_length; $i++) {
	$userinfo=$user->select($dataList[$i]["attention_userid"]);
	$records["data"][] = array($userinfo[0]["user_id"],$userinfo[0]["user_name"],$userinfo[0]["head_pic_url"]);
	
    
    
	}
	$records["recordsTotal"] = $iTotalRecords;
    $records["start"] = $iDisplayStart;
	
	echo json_encode($records);
  }
  
}

