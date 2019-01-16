<?php
include_once "../config.php";
include_once ROOT_PATH."class/class_user.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_invitation_code.php";
include_once ROOT_PATH."class/class_findpass_code.php";
include_once ROOT_PATH."class/class_check.php";
require_once ROOT_PATH."class/class.smtp.php";
$class_check=new class_check();
$class_user =new class_user();
$class_session=new class_session();
$class_findpass=new class_findpass_code();
/*

//发送找回请求
传入

action='findpass'
user_email
传出

status＝'no_user'/'success'
-重置密码(找回密码所用)



//   已被废除的接口设计
传入

action='resetpass'
user_email
reset_code
new_password
传出

status＝'code_error'/'success'



-重置密码(修改密码所用)

传入

action='resetpass'
user_email
old_password
new_password
传出

status＝'oldpass_error'/'success'


*/
 

//验证邮箱
	function is_email($user_email)
{
if(empty($user_email))
{
  return false;
}
    $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
    if (strpos($user_email, '@') !== false && strpos($user_email, '.') !== false)
    {
        if (preg_match($chars, $user_email))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}

//处理找回密码请求
//检测请求是否合格
function check_change(){
	global $class_user;
	global $class_findpass;
	$mail=$_POST['user_email'];
	if(array_key_exists('old_password', $_POST)){
        //表单验证
		if(!is_email($mail))
		{
		   $result['status']='email_error';
			echo json_encode($result);
			exit();
		}
		elseif(strlen(trim($_POST['new_password']))<6||strlen(trim($_POST['new_password']))>16)
		{
		    $result['status']='password_length_error';
			echo json_encode($result);
			exit();
		}
		else{
		$res=$class_user->select_by_email($mail);
		if(count($res)==0)
		{
			$result['status']='no_user';
			echo json_encode($result);
			exit();
		}
		else {
			# code...
			$password=md5($_POST['old_password']);
			$aa=rtrim($res[0]['user_passcode']);
			if($aa == $password)
			{
					return 1;
			}
			else {
				$result['status']='oldpass_error';
			echo json_encode($result);
			exit();
			}
		}
		}
	}

	elseif (array_key_exists('reset_code', $_POST)) {

		# code...
		$res=$class_findpass->check_code($_POST['reset_code'],$mail);
		if($res==0)
		{
			$result['status']='no_user';
			echo json_encode($result);
			exit();
		}
		else{
			$res=$class_user->select_by_email($mail);
			$user_id=$res[0]['user_id'];
			$change_arr=array();
			$password=md5($_POST['new_password']);
			$change_arr['user_passcode']=$password;
			$class_user->update($user_id,$change_arr);
			return 1;
		}
	}
}



function mail_code($target_mail,$content){

########################################## 
$smtpserver = MAIL_HOST;//SMTP服务器 
$smtpserverport = 25;//SMTP服务器端口 
$smtpusermail = MAIL_ADDRESS;//SMTP服务器的用户邮箱 
$smtpemailto = $target_mail;//发送给谁 
$smtpuser = MAIL_USER;//SMTP服务器的用户帐号 
$smtppass = MAIL_PASS;//SMTP服务器的用户密码 
$mailsubject = "找回密码, 来自tobemaker";//邮件主题 
$mailbody = $content;//邮件内容 
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
########################################## 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
$smtp->debug = false;//是否显示发送的调试信息 
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); 
}

//  验证是否可以找回
if(array_key_exists("action",$_POST)&&$_POST['action']=='findpass')
{
     //验证邮箱格式
	 if($class_check->is_email($_POST['user_email']))
	 {
	//获取信息
	 $mail=$_POST['user_email'];

	 $checkres=$class_user->select_by_email($mail);
     if(count($checkres)==0){
        //不存在该用户名

       $result['status']='no_user';
	    echo json_encode($result);
	    exit();
    }
	//生成验证码
	//$code=rand(100000,1000000);
	$code=$class_findpass->change_code($mail);

	// 发送邮件
	$content="您的新密码:".$code."<br/>  请您登录后重置密码！";
	mail_code($mail,$content);
	//返回信息
	$result['status']='success';
	echo json_encode($result);
	exit();
	}
	else
	{
	   $result['status']='email_error';
	echo json_encode($result);
	}

}

// 重置密码

if(array_key_exists("action",$_POST)&&$_POST['action']=='resetpass')
{
	//检测修改权限
	//检测是否需要验证码以及验证码是否合格
	
	$res=check_change();
	if($res==0){
		$result['status']='error';
		 echo json_encode($result);
		 exit();
	}
    //  组织数据

    $arr=array();

    $arr['user_passcode']=md5($_POST['new_password']);
   // $arr['invite_code']=$_POST[]

    $arr['user_email']=$_POST['user_email'];
    //$arr['user_mobile']=$_POST['mobile'];
    //检测用户数据

    $checkres=$class_user->select_by_email($arr['user_email']);
	//更新密码
	$sql="UPDATE `user_info` set `user_passcode` = '".$arr['user_passcode']." ' where `user_email`= '".$arr['user_email']."'";
	$class_user->query_sql($sql);
	$result['status']='success';
	echo json_encode($result);
	exit();
}
?>