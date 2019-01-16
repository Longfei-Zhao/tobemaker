<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_message.php";
include_once ROOT_PATH."class/class_group_auth.php";
$group_auth=new class_group_auth();
$message=new class_message();
if(!empty($_POST["action"]))
{
    $act=$_POST["action"];
	if($act=='read')
	{
	  $msg_id=$_POST["msg_id"];
	  $i=0;
	  while($i<count($msg_id))
	  {
	  $message->mark_read_alredy($msg_id[$i]);
	  $i++;
	  }
	   $res= array();
      $res['status']='success';
      echo json_encode($res);
	}
	elseif($act=='delete')
	{
	    $msg_id=$_POST["msg_ID"];
		$num=count($msg_id);
		$i=0;
		while($i<$num){
		      $message->delete_message($msg_id[$i]);
		      $i++;
		}
		 $res= array();
      $res['status']='success';
      echo json_encode($res);
	}
	elseif($act=='send')
	{
	   $sender_id=$_POST["sender_id"];
	   $recever_id=$_POST["receiver_id"];
	   $context=$_POST["context"];
	   $message->send_to_uid($sender_id,$receiver_id,$context);
	   $res= array();
      $res['status']='success';
      echo json_encode($res);
	}
}


elseif (array_key_exists('draw', $_REQUEST)){
// 请求来自dataTable
       $user_id=$_REQUEST['userid'];
	   
        // 设置总用户条数，用于计算分页数量
        $iTotalRecords =count($message->get_all_message($user_id));

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
        $real_length=$end-$iDisplayStart+1;

        $message_list = $message->get_part_message($user_id,$iDisplayStart,$real_length);


        $records = array();
        $records["data"] = array(); 
        
		
		//var_dump(array_values($groupactionList));
       for($i=0;$i<count($message_list);$i++){
	   
		
           
            $records["data"][] = array(
                '<input class="checkboxes" type="checkbox" name="id['.$message_list[$i]["id"].']" id="id['.$message_list[$i]["id"].']" value="'.$message_list[$i]["id"].'" />',
				'<img alt="" src="">',
                $message_list[$i]["user_name"],
				$message_list[$i]["context"],
				$message_list[$i]["send_time"],
				'<a href="" class="btn btn-xs"><i class="fa fa-search"></i>查看</a><a href="javascript:;" class="btn btn-xs"><i class="fa fa-search"></i>删除</a>'
                
            );
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
}


 