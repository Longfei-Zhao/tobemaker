<?php

include_once '../config.php';
include_once '../class/class_product.php';
include_once '../class/class_file.php';
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
$current_page = 'product-product_category_detail';
$page_level = explode('-', $current_page);

//参数错误检测
if(empty($_GET["productID"])||empty($_GET["action"]))
{

echo '<script language="javascript">alert("参数传递错误！");history.go(-1);</script>';
}
//获取商品目录
$product=new class_product();

$category=$product->get_category_by_id($_GET["productID"]);




	//绑定数据
	$action=$_GET["action"];
	$strDisplay='';
	if($action=='view')
    $strDisplay=' disabled="disabled" ';
//计算字符串长度
function abslength($str)
{
    if(empty($str)){
        return 0;
    }
    if(function_exists('mb_abslength')){
        return mb_abslength($str,'utf-8');
    }
    else {
        preg_match_all("/./u", $str, $ar);
        return count($ar[0]);
    }
}	
//跳转页面
function changeTo($url)
{
   echo '<script>location.href ="'.$url.'";</script>';
}
// 表单处理
if(array_key_exists('name',$_POST))
{
//下线处理验证】
$isContain=null;
 if($_POST["status"]=='下线'||$_POST["status"]=='删除')
 {
  $strsql='select * from `product_info` where `pc_id`='.$_POST["pc_id"];
  $isContain=$product->select($strsql);
 }
 if(!$isContain)
 {
 if($_POST["status"]=='删除')
{
    $product->delete_category($_POST["pc_id"]);
	echo '<script type="text/javascript"> alert("删除成功！")</script>';
	changeTo(BASE_URL."admin/product_category_list.php");
}
else
{
if(abslength(trim($_POST["name"]))<=1||abslength(trim($_POST["name"]))>16)
{
   echo '<script>alert("目录名称长度应在2-16之间");history.go(-1);</script>';
}
else
{
  $arr=array("pc_name"=>$_POST["name"],"pc_id"=>$_POST["pc_id"],"pc_status"=>$_POST["status"]);
  
  $result=$product->update_category($_POST["pc_id"],$arr);
   echo '<script type="text/javascript"> alert("更新成功！")</script>';
   changeTo(BASE_URL."admin/product_category_detail.php?action=edit&productID=".$_POST["pc_id"]);
  }
  
}
  }
  else
  {
  //提示目录下含有商品
  echo '<script type="text/javascript"> alert("目录下含有商品，不能执行删除和下线操作")</script>';
  }
  
  //成功信息
}
include 'view/product_category_detail_page.php';
