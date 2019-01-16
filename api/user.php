<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_user.php";

// 常亮设置
$status_list = array(
  array("success" => "正常"),
  array("danger" => "已屏蔽")
);

$user=new class_user();

// 判断是否为dataTable数据请求
if(isset($_POST["action"])&&isset($_POST["userID"]))
{
  $act=$_POST["action"];
  $user_id=$_POST["userID"];
  $num=count($user_id);
  $i=0;
  if($act=='user_enable')
  {
       while ( $i< $num) {
      # code...
      $user->enable($user_id[$i]);
      $i=$i+1;
    }
      $res= array();
      $res['status']='success';
      echo json_encode($res);
  }
  elseif($act=='user_shield')
  {
  
   while ( $i< $num) {
      # code...
      $user->shield($user_id[$i]);
      $i=$i+1;
    }
      $res= array();
      $res['status']='success';
      echo json_encode($res);
  }
  elseif($act=='user_delete')
  {
  
     while($i< $num) 
	 {
	     $user->delete($user_id[$i]);
         $i=$i+1;
	 }
	   $res= array();
      $res['status']='success';
      echo json_encode($res);
  }
}
if (array_key_exists('draw', $_REQUEST)){
        // 请求来自dataTable

        // 设置总用户条数，用于计算分页数量
        $iTotalRecords =$user->get_num_of_user();

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

        $user_result = $user->get_user_list($iDisplayStart, $real_length);


        $records = array();
        $records["data"] = array(); 

        foreach($user_result as $user_item){
		
            $status = $status_list[1];
			$action_status='green user-enable';
			
			if($user_item['user_activity']=='Y')
			{
			$status=$status_list[0];
			$action_status='red user-shield';
			}
            $records["data"][] = array(
                '<input class="checkboxes" type="checkbox" name="id[]" value="'.$user_item['user_id'].'"/>',
                $user_item['user_id'],
                $user_item['user_name'],
                $user_item['occupation'],
    //            $user_item['self_intro'],
                $user_item['last_login_time'],
                '<span class="label label-sm label-'.(key($status)).' user-status">'.(current($status)).'</span>',
                '<a href="javascript:;" class="btn btn-xs '.$action_status.'"><i class="fa fa-search"></i>'.($action_status=='green user-enable'?'启用用户':'屏蔽用户').'</a>'
				.'<a href="./user_detail.php?action=edit&user_id='.$user_item['user_id'].'" class="btn btn-xs default user-edit"><i class="fa fa-search"></i>编辑</a>'
                . '<a href="./user_detail.php?action=view&user_id='.$user_item['user_id'].'" class="btn btn-xs default user-view"><i class="fa fa-search"></i>查看</a>',
            );
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
}

