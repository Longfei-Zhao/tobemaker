<?php
  /* 
   * Paging

   */
include_once "../config.php";
include_once ROOT_PATH."class/class_product.php";
$class_product=new class_product();
$iTotalRecords =$class_product->get_all_category_num();

//if (array_key_exists('action', $_REQUEST)){
//
//    var_dump($_REQUEST);
//    exit();
//}
function get_detail_by_category_id($pc_id)
{

  //获取数据
  $requests=$class_product->get_category_by_id($pf_id);

  //组织数据
  $cords = array();

  //返回数据
  echo json_encode($cords);
}

function update_one_category( $pf_id,$arr){
  $class_product->update_category($pf_id,$arr);
  // 返回数据
  $res= array();
  $res['status']='success';
  echo json_encode($res);
}

$status_list = array(

  array("success" => "正常"),
  array("danger" => "下线")
  
);
//如果是修改请求
//则做出相应修改
if(isset($_POST["action"])&&isset($_POST["productID"])){
  $act=$_POST["action"];
  $pf_id=$_POST["productID"];
  $num=count($pf_id);
  $i=0;

  
}

elseif(isset($_POST["action"])&&empty($_POST["productID"])){
  $res= array();
     $res['status']='error';
     echo json_encode($res);
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
$end = $end > $iTotalRecords ? $iTotalRecords+1 : $end;
$real_length=$end-$iDisplayStart;

 // 获取数据

$datalist=$class_product->get_part_category($iDisplayStart,$real_length);
$real_length= count($datalist);
for($i = 0; $i < $real_length; $i++) {
if($datalist[$i]["pc_status"]=='正常')
    $status = $status_list[0];
	else $status = $status_list[1];
  $id = $datalist[$i]["pc_id"];
  $records["data"][] = array(
    '<input class="checkboxes" type="checkbox" name="id[]" value="'.$id.'"/>',
    $id,
    $datalist[$i]["pc_name"],
	
	$datalist[$i]["pc_addDate"],
	
    '<span class="label label-sm label-'.(key($status)).' pc-status">'.(current($status)).'</span>',
    '<a  class="btn btn-xs blue product-pass" href="./product_category_detail.php?action=edit&productID='.$id.'"><i class="fa fa-search"></i>编辑</a>'
      . '<a href="./product_category_detail.php?action=view&productID='.$id.'" class="btn btn-xs default product-view"><i class="fa fa-search"></i>查看</a>',
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
