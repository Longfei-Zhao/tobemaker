<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";

/*
 * 用户管理类，实现了
 * 
 * 1. 用户信息的增删改查
 * 2. 与session类配合实现用户登录
 * 
 */

class class_user
{
    public $db = null;
    
    function class_user(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES utf8");
        
    }
    

    function query_sql($sql){
	   //$sql=$this->db->escape($sql);
      $this->db->query($sql);
    }
    // 添加用户
    function insert($array){
	$keys=array_keys($array);
	for($i=0;$i<count($keys);$i++)
	{
	   $array[$keys[$i]]=$this->db->escape($array[$keys[$i]]);
	}
        $array["user_passcode"]=md5($array["user_passcode"]);
       $num=count($array);
        $keys=array_keys($array);
        $values=array_values($array);
        $aa=null;
        $bb=null;
        $i=0;
        while ($i<$num) {
                        # code...
                 $aa=$aa."`".$keys[$i]."`,";
                 $bb=$bb."'".$values[$i]."',";
                          $i=$i+1;         
        }
        $aa=rtrim($aa,",");
        $bb=rtrim($bb,",");
        $sql="insert into user_info(".$aa.") values(".$bb.")";
        $sql;
        $this->db->query($sql);
        $res=$this->db->get_results("SELECT LAST_INSERT_ID()",ARRAY_A);
        return $res[0]['LAST_INSERT_ID()'];    
    }

	//启用用户
	function enable($userid)
	{
	    $userid=$this->db->escape($userid);
	   $sql='update `user_info` set `user_activity`="Y" where `user_id`='.$userid.' ';
			$this->db->query($sql);
	}
     //【屏蔽用户】
	 function shield($userid)
	 {
	    $userid=$this->db->escape($userid);
		    $sql='update `user_info` set `user_activity`="N" where `user_id`='.$userid.' ';
			$this->db->query($sql);
		  
	 }

    // 根据数组字段插入数据
    public function insert_user($table_name,$array){
	$table_name=$this->db->escape($table_name);
	$keys=array_keys($array);
	for($i=0;$i<count($keys);$i++)
	{
	   $array[$keys[$i]]=$this->db->escape($array[$keys[$i]]);
	}
        $num=count($array);
        $keys=array_keys($array);
        $values=array_values($array);
        $aa=null;
        $bb=null;

        $i=0;
        while ($i<$num) {
                        # code...
                 $aa=$aa."`".$keys[$i]."`,";
                 if($values[$i]!='now()'){
                 $bb=$bb."'".$values[$i]."',";
               }
               else{
                $bb=$bb.$values[$i].",";
               }
                          $i=$i+1;         
        }
        $aa=rtrim($aa,",");
        $bb=rtrim($bb,",");
        $sql="insert into ".$table_name."(".$aa.") values(".$bb.")";
        $this->db->query($sql);
        $res=$this->db->get_results("SELECT LAST_INSERT_ID()",ARRAY_A);
        return $res[0]['LAST_INSERT_ID()'];
    }

    // 删除用户
    function delete($userid){
        $userid = $this->db->escape($userid);
        
        $result = $this->db->query("DELETE FROM `user_info` WHERE `user_id` = '$userid' ");
        
        return true;
    }
    
    // 更新用户信息
    function update($userid, $data){
	$userid=$this->db->escape($userid);
	  $keys=array_keys($data);
	  for($i=0;$i<count($keys);$i++)
	{
	   $data[$keys[$i]]=$this->db->escape($data[$keys[$i]]);
	}
      $values=array_values($data);
      $num_a=count($keys);
      $i=0;
      $aa="";
      $bb="";
      while ($i<$num_a) {
        # code...
        if($data[$keys[$i]]!=""){
        $aa=$aa."`".$keys[$i]."`='".$values[$i]."',";
      }
        $i++;
      }
      $aa=rtrim($aa,",");
      $sql="UPDATE `user_info` SET ".$aa." where `user_id`=".$userid;
	  
      $this->db->query($sql);
      return 1;
        
    }
    
    // 获取用户信息
    function select($userid){
        $userid = $this->db->escape($userid);
        $result = $this->db->get_results("SELECT * FROM `user_info` WHERE `user_id` = ".$userid , ARRAY_A);
        
        return $result;
    }

    function select_by_email($user_email){
        $user_email= $this->db->escape($user_email);
        $result = $this->db->get_results("SELECT * FROM `user_info` WHERE `user_email` ='".$user_email."'", ARRAY_A);
        return $result;
    }
    
    // 获取用户列表
    function get_user_list($start, $length){
        $start= $this->db->escape($start);
		$length= $this->db->escape($length);
        $result = $this->db->get_results("select * from `user_info` limit $start,$length", ARRAY_A);
        
        return $result;
        
    }    
    
    function get_num_of_user(){
        $result = $this->db->get_results("select count(`user_id`) from `user_info`", ARRAY_N);
        return $result[0][0];
        
    }
    
    //获取某组用户信息
    function get_user_by_group($group_id)
    {
	    $group_id= $this->db->escape($group_id);
        $result=$this->db->get_results('select * from `user_info` where `user_group`='.$group_id,ARRAY_A);
            return $result;
    }
    
    function get_current_user()
    {
        $top_user_data = array(
            'head_url' => $_SESSION['head_url'],
            'user_name' => $_SESSION['user_name'],
            'user_id' => $_SESSION['user_id'],
        );
        
        return $top_user_data;
    }
    
}