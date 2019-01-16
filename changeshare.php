<?php
include_once 'config.php';
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_qiniu.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
include_once ROOT_PATH."class/class_group_auth.php";
$class_session=new class_session();
if(!$class_session->check_login())
{
   $class_session->changePage(BASE_URL."error.php");
}

$class_user=new class_user();
$class_group_auth=new class_group_auth();
$current_user = $class_user->get_current_user();

$qiniu= new class_qiniu();
$upToken=$qiniu->get_token_to_upload_idea();

/*
  前台修改控制器
  1，图片显示与上传修改逻辑暂时无法调试
  待完善：
  1，用户信息cookie或者session获取
*/
// 导航 当前页面控制
$current_page = 'changeshare';
$page_level = explode('-', $current_page);
$new_idea= new class_idea();


if(array_key_exists('idea_id',$_GET)){
    $idea_id=intval($_GET['idea_id']);
}else{
    die('参数错误');
}

// 获取项目信息
$idea_infolist=$new_idea->get_idea_by_id($idea_id);
$idea_info=$idea_infolist[0];



// 检查是否是自己的项目
if ($current_user['user_id'] != $idea_info['user_id']){
    die('没有编辑该项目的权限');
}
//检查是否允许修改
if($idea_info['idea_status']>=5)
{
   die('该状态下的项目不能修改');
}
//  对修改请求的处理保存提交的修改
if(array_key_exists('act',$_POST)&&$_POST['act']=='change_share')
{
    // 检查是否有提交项目的权限，
    if(!$class_group_auth->check_auth("submitproject")) {
 //echo '<script>alert("对不起，您没有权限！");history.go(-1);</script>';
        die('对不起，您没有权限！');
  // return;
    }
    
    //保存图片

    $arr= array();
    $arr['user_id']=$current_user['user_id'];
    //七牛保存图片
    $pic_url=$_POST['img_url'];
   // $url_array = explode("/", $pic_url);
    //$key = end($url_array);
    //$key1 ="upload/".$current_user['user_id']."/".$key;
    //$qiniu->move($key,$key1);
    //$pic_url=QINIU_DOWN.$key1;
   

   //写数据库保存想法
    $idea_id=$_POST['idea_id'];
    $arr['name']=$_POST['title'];
    $arr['content']=$_POST['content'];
    $arr['tags']=$_POST['tags'];
    $arr['create_time']='now()';
    $arr['picture_url']=$pic_url;
    $arr['tags']=$_POST['tags'];
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
	if(abslength(trim($_POST['title']))<=1||abslength(trim($_POST['title']))>15)
	{
	   //返回错误信息
       echo '<script>alert("标题字数应在2-15之间！");history.go(-1);</script>';
       return;
	}
    if(count(explode(',',$_POST['tags']))>5)
    {
       //返回错误信息
       echo '<script>alert("标签过多！不能超过5个！");history.go(-1);</script>';
       return;
    }
    
    if(array_key_exists('cover_display', $_POST))// 是否显示封面  数据库默认显示
    {
//      echo "yes";
        $arr['cover_display']=1;
    }
    else
    {
//      echo "no";
      $arr['cover_display']=0;
    }
    $new_idea->update_idea($idea_id,$arr);
    //注册修改事件
    $change_info=array();
    $change_info['idea_id']=$_POST['idea_id'];
    $change_info['idea_status']=2;
    $change_info['last_change_time']='now()';

    $new_idea->insert("idea_manage",$change_info);   
    $url="Location:".BASE_URL."project.php?idea_id=".$idea_id;
    header($url);
    exit();
}

    
include 'view/changeshare_page.php';

