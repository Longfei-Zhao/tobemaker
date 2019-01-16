<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_auth.php";
include_once ROOT_PATH."class/class_group_auth.php";
$group_auth=new class_group_auth();
$auth=new class_auth();

//获取权限
$authList=$auth->get_action_name_list();
//如果是修改请求
//则做出相应修改

if(isset($_POST["action"])&&isset($_POST["auths"])){
  $act=$_POST["action"];
  
  //var_dump($_POST);
if($act=='auth_update')
{
$auths=$_POST["auths"];
  $group_id=$_POST["groupid"];
  $num=count($auths);
  $i=0;
    while($i<$num)
	{
	    $group_auth->insert($group_id,$auths[$i]);
	    $i++;
	}
	for($i=0;$i<count($authList);$i++)
	{
	    if(!in_array($authList[$i],$auths))
		{
		    $group_auth->delete_group_auth($group_id,$authList[$i]);
		}
	}
	 $res= array();
      $res['status']='success';
      echo json_encode($res);
}
elseif($act=='cancel')
{
   $group_id=$_POST["groupid"];
   $auths=$_POST["auths"];
   $group_auth->delete_group_auth($group_id,$auths);
   $res= array();
      $res['status']='success';
      echo json_encode($res);
}
elseif($act=='enable')
{
    $group_id=$_POST["groupid"];
   $auths=$_POST["auths"];
   $group_auth->insert($group_id,$auths);
  $res= array();
      $res['status']='success';
      echo json_encode($res);
}

  else
  {
     $res= array();
      $res['status']='success';
      echo json_encode($res);
  }
}

elseif(isset($_POST["action"])){
  $res= array();
     $res['status']='error';
     echo json_encode($res);
}
// 常亮设置
$status_list = array(
  array("success" => "正常"),
  array("danger" => "无权限")
);
function checkin($value,$arr)
{
   for($i=0;$i<count($arr);$i++)
   {
      if($value==$arr[$i]["action_name"])
	  {
	     return true;
	  }
   }
   return false;
}
if (array_key_exists('draw', $_REQUEST)){
// 请求来自dataTable
       $group_id=$_REQUEST['group_id'];
	   
        // 设置总用户条数，用于计算分页数量
        $iTotalRecords =$auth->get_action_num();

        // 当前显示数量
        $iDisplayLength = intval($_REQUEST['length']);
        // lenth = -1, 表示显示全部信息
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


        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        $real_length=$end-$iDisplayStart;

        $action_list = $auth->get_action_name_list();


        $records = array();
        $records["data"] = array(); 
        $keys=array_keys($action_list);
		//获取用户拥有的权限
		$groupactionList=$group_auth->get_all_auth($group_id);
		
		//var_dump(array_values($groupactionList));
       for($i=0;$i<count($action_list);$i++){
	   $action_status='green func-enable';
		if(checkin($action_list[$keys[$i]],$groupactionList))
		{
		 $action_status='red func-cancel';
		}
           
            $records["data"][] = array(
                '<input class="checkboxes" type="checkbox" name="id['.$action_list[$keys[$i]].']" id="id['.$action_list[$keys[$i]].']" value="'.$action_list[$keys[$i]].'" />',
                $action_list[$keys[$i]],
				'<a href="javascript:;" class="btn btn-xs '.$action_status.'"><i class="fa fa-search"></i>'.($action_status=='green func-enable'?'添加权限':'取消权限').'</a>'
                
            );
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
}


 