<?php

include_once '../config.php';
include_once '../class/class_user.php';
include_once '../class/class_file.php';
include_once '../class/class_group.php';
include_once '../class/class_check.php';
include_once '../class/class_qiniu.php';
include_once ROOT_PATH."class/class_group_auth.php";
$class_group_auth=new class_group_auth();
$class_check=new class_check();
//上传suo xu
$qiniu= new class_qiniu();
$upToken=$qiniu->get_token_to_upload_head();

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
$current_page = 'user-user_add';
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

    <script src="./assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" ></script>
<script src="./assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" ></script>
<script>
     
jQuery(document).ready(function() {       
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    TableManaged.init();
	$("#fileSelect").fileupload({
                dataType: \'json\',
                done: function (e, data) {
                    if (data.result.key == null){
                        alert("错误：" + data.result.err_msg);
                    }else{
                        var url="'.QINIU_DOWN.'"+ data.result.key;
                        console.log(url);
                        $(\'#image\').attr(\'src\', url);
                        $("#fileurl").val(url);
                        $(\'#upload-progress-label\').text(\'\');
                    }
                },
                progress: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $(\'#upload-progress-label\').text(progress+\'%\');
                }
            });      
	
		
    
});
</script>
';
//跳转页面
function changeTo($url)
{
   echo '<script>location.href ="'.$url.'";</script>';
}
//获取群组信息
$file=new class_file();
$group=new class_group();
$groupList=$group->get_all_group();
include 'view/header.php';

include 'view/leftnav.php';

include 'view/user_add.php';

include 'view/quick_bar.php';


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
//表单处理
$user=new class_user();

$imgUrl=$_POST["img_url"];
//if(!empty())
///{
  //$imgUrl=$file->save($_POST["img_url"]);
///}
if(array_key_exists('real_name',$_POST))
{
//验证表单提交数据合法性
if($class_check->username_able($_POST["user_name"],2,16)!='success')
{
   alertMsg('用户名不合法，长度应在2~16之间且不能含有空格！',"error");
}
elseif($class_check->password_able($_POST["password"],6,16)!='success')
{
    alertMsg('密码不合法，不能含有空格且长度在6~16之间！',"error");
}
elseif(!$class_check->is_email($_POST["email"]))
{ 
   alertMsg('邮箱不合法！',"error");
}
elseif(!empty($_POST["money"])&&!$class_check->is_double_p($_POST["money"]))
{
   alertMsg('金额不合法！',"error");
}
elseif(!$class_check->is_mobile($_POST["mobile"]))
{
   alertMsg('手机号不合法！',"error");
}
elseif($_POST["password"]!=$_POST["confirmpaaword"])
{
   alertMsg('两次密码不一致！',"error");
}
else{
if(!empty($imgUrl))
  {
$arr=array("user_name"=>$_POST["user_name"],"real_name"=>$_POST["real_name"],"sex"=>$_POST["sex"],"user_passcode"=>$_POST["password"],
             "birth"=>$_POST["birth"],"head_pic_url"=>$_POST["img_url"],"user_email"=>$_POST["email"],
			 "user_mobile"=>$_POST["mobile"],"money"=>$_POST["money"],"user_group"=>$_POST["group"],
			 "occupation"=>$_POST["occupation"]);
			 $result=$user->insert($arr);
} 
	else
{
$arr=array("user_name"=>$_POST["user_name"],"real_name"=>$_POST["real_name"],"sex"=>$_POST["sex"],"user_passcode"=>$_POST["password"],
             "birth"=>$_POST["birth"],"user_email"=>$_POST["email"],
			 "user_mobile"=>$_POST["mobile"],"money"=>$_POST["money"],"user_group"=>$_POST["group"],
			 "occupation"=>$_POST["occupation"]);
			 $result=$user->insert($arr);
}	
//返回成功信息
alertMsg("添加成功！","success");
changeTo(BASE_URL."admin/user_list.php");
}
             

}
include 'view/footer.php';
