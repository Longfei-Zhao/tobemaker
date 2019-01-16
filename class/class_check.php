<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');
/****************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
class class_check
{
    function class_check()
	{
	   
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
//验证手机号码
function is_mobile($moblie)
{
    if(empty($mobile))
	{
	  return true;
	}
   if(preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/",$mobile)){    
    //验证通过    
      return true;   
}else{    
    //手机号码格式不对    
         return false;
}
}
//验证密码格式
function password_able($password,$minLength,$maxLength)
{
    if(strstr($password," "))
	{
	    return 'space_exist';
	}
	elseif(abslength($password)>$maxLength||abslength($password)<$minLength)
	{
	    return 'length_unable';
		
	}
	else
	{
	   return 'success';
	}
}
//验证用户名
 function username_able($user_name,$minLength,$maxLength)
 {
      if(strstr($user_name," "))
	  {
	      return 'space_exist';
	  }
	  elseif(abslength($user_name)>$maxLength||abslength($user_name)<$minLength)
	{
	    return 'length_unable';
		
	}
	else
	{
	   return 'success';
	}
 }
 //验证非负浮点数
 function is_double_p($num)
 {
    if(preg_match("/^\+?(:?(:?\d+\.\d+)|(:?\d+))$/",$num))
	{
	   return true;
	   
	}
	else
	{
	    return false;
	}
 }
 //验证日期格式
 function checkDateIsValid($date, $formats = array("Y-m-d", "Y/m/d")) {
    $unixTime = strtotime($date);
    if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
        return false;
    }
    //校验日期的有效性，只要满足其中一个格式就OK
    foreach ($formats as $format) {
        if (date($format, $unixTime) == $date) {
            return true;
        }
    }

    return false;
}
}