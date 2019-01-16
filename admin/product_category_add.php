<?php

include_once '../config.php';
include_once '../class/class_product.php';
include_once '../class/class_file.php';
include_once '../class/class_check.php';
include_once ROOT_PATH."class/class_group_auth.php";
//跳转页面
function changeTo($url)
{
   echo '<script>location.href ="'.$url.'";</script>';
}
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
$current_page = 'product-product_add';
$page_level = explode('-', $current_page);
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
//保存表单内容到数据库
$product=new class_product();
if(array_key_exists('name',$_POST))
{
if(abslength(trim($_POST["name"]))<=1||abslength(trim($_POST["name"]))>16)
{
   echo '<script>alert("目录名称长度应在2-16之间");history.go(-1);</script>';
}
else
{
    $time=time();
    $arr=array("pc_name"=>$_POST["name"],"pc_addDate"=>date("y-m-d",$time));
	$result=$product->insert('product_category',$arr);
	//成功后弹出成功信息
	 echo '<script type="text/javascript"> alert("添加成功！")</script>';
	  changeTo(BASE_URL."admin/product_category_list.php");
}
}

include 'view/product_category_add.php';
