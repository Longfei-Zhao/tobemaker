<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";

/*
 * 用户邀请码类，实现了邀请码的增删除修改查询
 * 
 * 1. 邀请码的增删改查
 * 
 */

class class_invitation_code
{
    private $db = null;
    
    function class_invitation_code(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES utf8");
        
    }

    //添加邀请码
    function add_code(){
    	$code=rand(10000,100000);
    	$sql="INSERT into `invitation_code`(`code`) values(".$code.")";
    	$this->db->query($sql);
    	return $code;
    }


    //删除邀请码
    function delete_code($code){
	$code = $this->db->escape($code);
    	//$code=rand(10000,100000);
    	$sql="DELETE from `invitation_code`where code=".$code;
    	$this->db->query($sql);
    }
	//获取全部邀请码注册用户
	function get_all_user_code()
	{
	   $sql='select `user_info`.* , `invitation_code`.* from `user_info` ,`invitation_code` where `user_invite_code`!=\'\' and `invitation_code`.`code`=`user_info`.`user_invite_code` order by `code` desc';
	   $result=$this->db->get_results($sql,ARRAY_A);
	   return $result;
	}
	//获取部分邀请码注册用户
	function get_part_user_code($begin,$length)
	{
	$begin = $this->db->escape($begin);
	$length = $this->db->escape($length);
	   $sql='select `user_info`.* , `invitation_code`.* from `user_info` ,`invitation_code` where `user_invite_code`!=\'\' and `invitation_code`.`code`=`user_info`.`user_invite_code` order by `code` desc limit '.$begin.','.$length.'';
	   $result=$this->db->get_results($sql,ARRAY_A);
	   return $result;
	}
	//获取部分邀请码
	function get_part_code($begin,$length)
	{
	$begin = $this->db->escape($begin);
	$length = $this->db->escape($length);
	    $sql='select `invitation_code`.* from `invitation_code` where 1 limit '.$begin.','.$length.'';
	   $result=$this->db->get_results($sql,ARRAY_A);
	   return $result;
	}
	//获取全部邀请码
	function get_all_code()
	{
	    $sql='select `invitation_code`.* from `invitation_code` ';
	   $result=$this->db->get_results($sql,ARRAY_A);
	   return $result;
	}
    // 查询是否可用
    function check_code($code){
	   $code = $this->db->escape($code);
    	$arr = array();
    	$sql="SELECT  * from `invitation_code`where `code`=".$code;
    	$res=$this->db->get_results($sql,ARRAY_A);
    	if(count($res)==0)
    	{
    		$arr['status']='no_code';
    	}
    	elseif ($res[0]['used']==1) {
    		# code...
    		$arr['status']='used';
    	}
    	elseif ($res[0]['used']==0) {
    		# code...
    		$arr['status']='unused';
    	}
    	return $arr;
    }

  //启用邀请码
  function enable_code($code_id)
  {
     $code_id = $this->db->escape($code_id);
       $sql="UPDATE`invitation_code`set `used`=0 where `id`=".$code_id;
    	$this->db->query($sql);
  }
  //禁用邀请码
  function unable_code($code_id)
  {
       $code_id = $this->db->escape($code_id);
      $sql="UPDATE`invitation_code`set `used`=1 where `id`=".$code_id;
    	$this->db->query($sql);
  }
    function mark_used($code){
    	$sql="UPDATE`invitation_code`set `used`=1 where `code`=".$code;
    	$this->db->query($sql);
    }

}

?>    