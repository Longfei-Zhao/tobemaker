<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_check.php";
$class_check=new class_check();
$class_idea=new class_idea();
$iTotalRecords =$class_idea->get_all_idea_num();

//if (array_key_exists('action', $_REQUEST)){
//
//    var_dump($_REQUEST);
//    exit();
//}
function get_detail_by_idea_id($idea_id)
{

  //获取数据
  $requests=$class_idea->get_idea_by_id($idea_id);

  //组织数据
  $cords = array();

  //返回数据
  echo json_encode($cords);
}

function update_one_idea( $idea_id,$arr){
  $class_idea->update_idea($idea_id,$arr);
  // 返回数据
  $res= array();
  $res['status']='success';
  echo json_encode($res);
}

$status_list = array(
  array("info" => "等待完善"),
  array("info" => "新建想法"),
  array("info" => "等待审核"),
  array("danger" => "已拒绝"),
  array("warning" => "已批准积赞中"),
  array("primary"=>"待产"),
  array("success"=>"生产完成"),
  array("default"=>"下线"),
  array("default"=>"积赞失败需下线")
);




/*
1,如果是修改请求项目状态
则做出相应修改
*/
//计算字符串长度
function abslength($str)
{
    if(empty($str)){
        return 0;
    }
    if(function_exists('mb_strlen')){
        return mb_strlen($str,'utf-8');
    }
    else {
        preg_match_all("/./u", $str, $ar);
        return count($ar[0]);
    }
}
if(isset($_POST["action"])&&isset($_POST["ideaId"])){
  $act=$_POST["action"];
  //下线
  if($act=='idea_offline')
  {
     $idea_id=$_POST["ideaId"];
	 $class_idea->mark_offline($idea_id);
	 $res= array();
      $res['status']='success';
      echo json_encode($res);
  }
  //转为待产
  elseif($act=='idea_product')
  {
       $idea_id=$_POST["ideaId"];
	 $class_idea->mark_product($idea_id);
	 $res= array();
      $res['status']='success';
      echo json_encode($res);
  }
     //通过审核
  elseif($act=="idea_pass")
  {
  //echo json_encode($_POST);
  $idea_id=$_POST["ideaId"];
  $num=count($idea_id);
  $i=0;
  $tags=explode(',',$_POST["tags"]);
  //表单验证
  if(abslength(trim($_POST["title"]))<=1||abslength(trim($_POST["title"]))>15)
  {
      $res= array();
      $res['status']='title_length';
      echo json_encode($res);
  }
  elseif(count($tags)>=6)
  {
      $res= array();
      $res['status']='tags_amount';
      echo json_encode($res);
      
  }
  elseif(abslength(trim($_POST["content"]))<=0)
  {
      $res= array();
      $res['status']='content_length';
      echo json_encode($res);
  }
  elseif(abslength(trim($_POST["starttime"]))<=0)
  {
      $res= array();
      $res['status']='starttime_error';
      echo json_encode($res);
  }
  elseif(abslength(trim($_POST["starttime"]))<=0)
  {
      $res= array();
      $res['status']='endtime_error';
      echo json_encode($res);
  }
  elseif($_POST["target"]<=0)
  {
       $res= array();
      $res['status']='target_amount_error';
      echo json_encode($res);
  }
  else{
    while ( $i< $num) {
      # code...
      $class_idea->mark_pass($idea_id[$i]);
	  $arr=array("name"=>$_POST["title"],"tags"=>$_POST["tags"],"content"=>$_POST["content"],"is_recommend"=>$_POST["command"],"begin_time"=>$_POST["starttime"],"end_time"=>$_POST["endtime"],"target"=>$_POST["target"]);
	  $class_idea->update_idea($idea_id[$i],$arr);
      $i=$i+1;
    }
      $res= array();
      $res['status']='success';
      echo json_encode($res);
	  }
     // exit();
  }
     //未通过审核
  elseif ($act=="idea_reject") {
  $idea_id=$_POST["ideaId"];
  $num=count($idea_id);
  $i=0;
    # code...
    while ( $i< $num) {
      # code...
      $class_idea->mark_fail($idea_id[$i]);
      $i=$i+1;
    }
     $res= array();
     $res['status']='success';
     echo json_encode($res);
  }
}
   

      //错误请求
elseif(isset($_POST["action"])&&empty($_POST["ideaId"])){
  $res= array();
     $res['status']='error';
     echo json_encode($res);
}

// 要求排序
elseif ($_POST['order'][0]['column']==5 or $_POST['order'][0]['column']==1) {
  # code...
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
  $real_length=$end-$iDisplayStart;

 // 获取数据
  //状态排序
  if($_POST['order'][0]['column']==5&&$_POST['order'][0]['dir']=="asc"){
  $datalist=$class_idea->get_part_ideas_order_status($iDisplayStart,$real_length,0);
  }
  
  elseif($_POST['order'][0]['column']==5&&$_POST['order'][0]['dir']=='desc'){
  $datalist=$class_idea->get_part_ideas_order_status($iDisplayStart,$real_length,1);
  }

  //  idea_id 排序
  elseif($_POST['order'][0]['column']==1&&$_POST['order'][0]['dir']=="asc"){
  $datalist=$class_idea->get_part_ideas_order_ideaid($iDisplayStart,$real_length,0);
  }
  elseif($_POST['order'][0]['column']==1&&$_POST['order'][0]['dir']=='desc'){
  $datalist=$class_idea->get_part_ideas_order_ideaid($iDisplayStart,$real_length,1);
  }


  $real_length= count($datalist);
  for($i = 0; $i < $real_length; $i++) {
  $status = $status_list[$datalist[$i]["idea_status"]];
 // echo current($status);
  $id = $datalist[$i]["idea_id"];
  $records["data"][] = array(
    '<input class="checkboxes" type="checkbox" name="id[]" value="'.$id.'"/>',
    $id,
    $datalist[$i]["name"],
    $datalist[$i]["user_name"],
    $datalist[$i]["brief"],
    '<span class="label label-'.(key($status)).' idea-status">'.(current($status)).'</span>',
    
     '<a href="javascript:;" class="btn btn-xs red-sunglo idea-reject"><i class="fa fa-times"></i> 拒绝</a>'.
      '<a href="./like_detail.php?idea_id='.$id.'" class="btn btn-xs blue idea-view"><i class="fa fa-pencil"></i> 查看点赞</a>'
      . '<a href="./idea_detail_all.php?idea_id='.$id.'" class="btn btn-xs blue-hoki idea-view"><i class="fa fa-pencil"></i> 编辑</a>',
  );
}
if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
  $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
}
$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
echo json_encode($records);

}

else {
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
$real_length=$end-$iDisplayStart;

 // 获取数据
$datalist=$class_idea->get_part_ideas($iDisplayStart,$real_length);
$real_length= count($datalist);
for($i = 0; $i < $real_length; $i++) {
    $status = $status_list[$datalist[$i]["idea_status"]];
  $id = $datalist[$i]["idea_id"];
  $records["data"][] = array(
    '<input class="checkboxes" type="checkbox" name="id[]" value="'.$id.'"/>',
    $id,
    $datalist[$i]["name"],
    $datalist[$i]["user_name"],
    $datalist[$i]["brief"],
    '<span class="label label-'.(key($status)).' idea-status">'.(current($status)).'</span>',
    '<a href="javascript:;" class="btn btn-xs blue idea-pass"><i class="fa fa-search"></i>批准</a>'
      . '<a href="javascript:;" class="btn btn-xs red idea-reject"><i class="fa fa-search"></i>拒绝</a>'
      . '<a href="./idea_detail_all.php?idea_id='.$id.'" class="btn btn-xs default idea-view"><i class="fa fa-search"></i>查看</a>',
  );
}

if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
  $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
}
$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
echo json_encode($records);
}
