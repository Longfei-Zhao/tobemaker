<?php

include_once '../config.php';
include_once '../class/class_product.php';
include_once '../class/class_file.php';
include_once ROOT_PATH."class/class_group_auth.php";
include_once '../class/class_check.php';
include_once '../class/class_qiniu.php';
//上传suo xu
$qiniu= new class_qiniu();
$upToken=$qiniu->get_token_to_upload_head();
$class_check=new class_check();
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
$current_page = 'product-product_detail';
$page_level = explode('-', $current_page);

function alertMsg($msg,$status)
{
    if($status=='error')
    {
       echo '<script>alert("'.$msg.'");history.go(-1);</script>';
    }
	else
	{
	   echo '<script>alert("'.$msg.'");</script>';
	}
}
//参数错误检测
if(empty($_GET["productID"])||empty($_GET["action"]))
{

echo '<script language="javascript">alert("参数传递错误！");history.go(-1);</script>';
}
//获取商品目录
$product=new class_product();
$strsql='select * from `product_category`';
$categoryList=$product->select($strsql);
$file=new class_file();
//获取商品详情
$productID=$_GET["productID"];
$strsql='select * from `product_info` where `product_info`.`pf_id`='.$productID;
$productInfo=$product->select($strsql);
//判断状态（编辑/查看）并绑定数据
if(array_key_exists('action',$_GET))
{

	//绑定数据
	$action=$_GET["action"];
	$strDisplay='';
	if($action=='view')
    $strDisplay=' disabled="disabled" ';
	
}

include 'view/product_detail_page.php';
//跳转页面
function changeTo($url)
{
   echo '<script>location.href ="'.$url.'";</script>';
}
// 表单处理
if(array_key_exists('name',$_POST))
{
if($_POST["status"]=='删除')
{
    $product->delete_product($_POST["pf_id"]);
}
else
{
$imgUrl=$_POST["img_url"];
//if(!empty($_POST["img_url"]))
  //$imgUrl=$file->save($_POST["img_url"]);
  //表单提交验证
if(strlen(trim($_POST["link"]))<=0)
{
  alertMsg("链接不能为空！","error");
}
elseif(!empty($_POST["discount"])&&!$class_check->is_double_p($_POST["discount"]))
{
   alertMsg("现价金额数据不合法！","error");
}
elseif(!empty($_POST["price"])&&!$class_check->is_double_p($_POST["price"]))
{
  alertMsg("原价金额数据不合法！","error");
}
else{
  if(!empty($imgUrl))
  $arr=array("pf_name"=>$_POST["name"],"pf_image"=>$_POST["img_url"],"pf_link"=>$_POST["link"],
             "pf_label"=>$_POST["label"],"pf_price"=>$_POST["price"],"pf_discount"=>$_POST["discount"],
			 "pf_status"=>$_POST["status"],"pf_sort"=>$_POST["sort"]);
  else
  $arr=array("pf_name"=>$_POST["name"],"pf_link"=>$_POST["link"],
             "pf_label"=>$_POST["label"],"pf_price"=>$_POST["price"],"pf_discount"=>$_POST["discount"],
			 "pf_status"=>$_POST["status"],"pf_sort"=>$_POST["sort"]);
  $result=$product->update_product($_POST["pf_id"],$arr);
  alertMsg("更新成功！","success");
  }
  //成功信息
  $url=BASE_URL."admin/product_detail.php?action=edit&productID=".$_POST["pf_id"];
changeTo($url);
}
}