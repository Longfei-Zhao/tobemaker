<?php

include_once '../config.php';
include_once '../class/class_group.php';
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
$current_page = 'auth-group_add';
$page_level = explode('-', $current_page);

$page_level_style = '
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
';

$page_level_plugins = '
<script type="text/javascript" src="./assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
';

$page_level_script = '<script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="./assets/user/pages/scripts/product_list.js"></script>

 
<script>

jQuery(document).ready(function() {       
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    TableManaged.init();
	
		
    
});
</script>
';

include 'view/header.php';

include 'view/leftnav.php';

include 'view/group_add.php';

include 'view/quick_bar.php';

include 'view/footer.php';
//跳转页面
function changeTo($url)
{
   echo '<script>location.href ="'.$url.'";</script>';
}
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
//表单处理
$group=new class_group();
if(array_key_exists('group_name',$_POST))
{
if(abslength(trim($_POST["group_name"]))<=1||abslength(trim($_POST["group_name"]))>16)
{
    echo '<script>alert("群组名称不合法，长度应在2-16之间");history.go(-1);</script>';
}
$arr=array("group_name"=>$_POST["group_name"]);
//验证是否重复
$result=$group->check_is_unique($_POST["group_name"]);

if(!$result)
{
$result=$group->insert($_POST["group_name"]);
//返回成功信息
echo '<script>alert("添加成功");</script>';
changeTo(BASE_URL."admin/group_list.php");
}
else
{
//弹出重复框
echo '<script>alert("已包含该名称群组");history.go(-1);</script>';
}
             

}