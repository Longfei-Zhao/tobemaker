<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_invitation_code.php";
include_once ROOT_PATH."class/class_user.php";
$class_invitation_code=new class_invitation_code();
$user=new class_user();
$iTotalRecords =count($class_invitation_code->get_all_user_code());

//if (array_key_exists('action', $_REQUEST)){
//
//    var_dump($_REQUEST);
//    exit();
//}

if(isset($_POST["action"])){
  $act=$_POST["action"];
	if($act=='create')
	{
	   $result=$class_invitation_code->add_code();
		$res= array();
     $res['code']=$result;
     echo json_encode($res);
	}
	if($act=='delete')
	{
	  
	  $class_invitation_code->delete_code($_POST["code"]);
	  $res= array();
     $res['status']="success";
     echo json_encode($res);
	}
}
if(array_key_exists('draw',$_REQUEST))
{
 # code...
// 总项目数
// 当前显示数量
$iDisplayLength = intval($_REQUEST['length']);
$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 

// 开始位置

$iDisplayStart = intval($_REQUEST['start']);

// Draw counter. 
// This is used by DataTables to ensure that the Ajax 
// returns from server-side processing requests are drawn 
// in sequence by DataTables (Ajax requests are asynchronous 
// and thus can return out of sequence). This is used as part 
// of the draw return parameter.
$sEcho = intval($_REQUEST['draw']);

$records = array();
$records["data"] = array(); 

$end = $iDisplayStart + $iDisplayLength;
$end = $end > $iTotalRecords ? $iTotalRecords : $end;
$real_length=$end-$iDisplayStart+1;

 // 获取数据

$datalist=$class_invitation_code->get_part_user_code($iDisplayStart,$real_length);
$real_length= count($datalist);
for($i = 0; $i < $real_length; $i++) {
   
  $id = $datalist[$i]["id"];
  $records["data"][] = array(
    
    $id,
    $datalist[$i]["code"],
	$datalist[$i]["user_name"],
	$datalist[$i]["user_email"],
	
  );
}


/*if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
  $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
}*/
$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
echo json_encode($records);
}
