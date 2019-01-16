<?php

include_once '../config.php';
include_once '../class/class_auth.php';
include_once '../class/class_group.php';
include_once '../class/class_group_auth.php';

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
$current_page = 'auth-give_auth';
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


//获取操作列表
$action=new class_auth();
$actionList=$action->get_action_name_list();
$keys=array_keys($actionList);
//获取群组信息
$group=new class_group();

$groupInfo=$group->get_group_by_id($_GET["groupid"]);

//获取原有权限
$auth=new class_group_auth();

$authList=$auth->get_all_auth($_GET["groupid"]);


include 'view/header.php';

include 'view/leftnav.php';

include 'view/give_auth.php';

include 'view/quick_bar.php';
$page_level_script = '<script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="./assets/user/pages/scripts/auth.js"></script>
<script>
jQuery(document).ready(function() {       
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    TableManaged.init();
	inittable();
	var box=$("#id[view]");
	var i=box.value;
	var j=0;
});
</script>
';

$page_level_script=$page_level_script.'<script>function inittable(){';
for($i=0;$i<count($authList);$i++)
{
     
    $page_level_script= $page_level_script.'$("#id['.$authList[$i]["action_name"].']").Checked="true";';
}
$page_level_script=$page_level_script.'}</script>';
include 'view/footer.php';
//绑定处理


