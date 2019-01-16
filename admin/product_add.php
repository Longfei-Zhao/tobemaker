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
$current_page = 'product-product_add';
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
//跳转页面
function changeTo($url)
{
   echo '<script>location.href ="'.$url.'";</script>';
}
//获取目录数量及内容
$product=new class_product();
$strsql='select * from `product_category`';
$categoryList=$product->select($strsql);
$file=new class_file();
$imgUrl='';
//保存表单内容到数据库
//var_dump($_POST);
if(array_key_exists('category',$_POST))
{
//if(!empty($_POST["img_url"]))
//$imgUrl=$file->save($_POST["img_url"]);
//验证表单内容合法性
if(empty($_POST["img_url"]))
{
   alertMsg('图片不能为空！',"error");
}
elseif(strlen(trim($_POST["link"]))<=0)
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
else
{
$time = time();
$arr= array("pf_name"=>$_POST["name"],"pf_image"=>$_POST["img_url"],
            "pf_link"=>$_POST["link"],"pf_label"=>$_POST["label"],
			"pf_price"=>$_POST["price"],"pf_discount"=>$_POST["discount"],
			"pc_id"=>$_POST["category"],"pf_addDate"=>date("y-m-d",$time));

$result=$product->insert('product_info',$arr);
alertMsg("添加成功！","success");
$url=BASE_URL."admin/product_list.php";
changeTo($url);
}
}

include 'view/product_add.php';
