<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_invitation_code.php";
$class_invitation_code=new class_invitation_code();

$iTotalRecords =count($class_invitation_code->get_all_code());
$status_list = array(

  array("success" => "正常"),
  array("danger" => "已禁用")
  
);
if(array_key_exists('action',$_POST))
{
   $act=$_POST["action"];
   if($act=='enable')
   {
      $id=$_POST["code_id"];
	  $class_invitation_code->enable_code($id);
	  $res=array();
	  $res["status"]="success";
	  echo json_encode($res);
   }
   elseif($act=='unable')
   {
       $id=$_POST["code_id"];
	  $class_invitation_code->unable_code($id);
	  $res=array();
	  $res["status"]="success";
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

$datalist=$class_invitation_code->get_part_code($iDisplayStart,$real_length);
$real_length= count($datalist);
for($i = 0; $i < $real_length; $i++) {
   $status = $status_list[1];
   $strclolor='green code-enable';
	if($datalist[$i]["used"]==0)
	{
	  $status = $status_list[0];
	  $strclolor='red code-unable';
	}
  $id = $datalist[$i]["id"];
  $records["data"][] = array(
    
    '<label name="id">'.$id.'</label>',
    $datalist[$i]["code"],
	'<span class="label label-sm label-'.(key($status)).' invite-status">'.(current($status)).'</span>',
	'<a  class="btn btn-xs '.$strclolor.'" "><i class="fa fa-search"></i>'.($strclolor=='green code-enable'?'启用':'禁用').'</a>'
     
	
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