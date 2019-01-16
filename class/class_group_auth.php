<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/****************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
include_once ROOT_PATH."class/class_pagesurpport.php";
include_once ROOT_PATH."class/class_session.php";
 class class_group_auth
{
    private $db = null;
    public $num_of_waiting;

    function class_group_auth(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES UTF8");
    }
// 检查权限
    // 判断当前用户是否具备执行操作action_name的权限
    // 权限管理采用用户组+权限矩阵的方式实现
    public function check_auth($action_name, $return_bool = true){

        // ------- 获取用户所在的权限组 -------
        // 权限组类型：anonymous(0) / none(-1) / "group name"
        $action_name=$this->db->escape($action_name);
	  
        $user_group = 0;
        $user_session=new class_session();
        // 判断用户是否登录
        if (!$user_session->check_login()){
            // 用户未登录，标记为匿名
            $user_group = 0;
        }else{
            //用户已登录，获取系统中的分组
            if (array_key_exists('group', $_SESSION) && $_SESSION['group'] != ""){
                $user_group = $_SESSION['group'];
            }else{
                $user_group = -1;
            }
        }

        // 判断用户所在组是否具有该权限
        // 查询二元组（用户组，权限）是否在数据库中
        $result = $this->db->get_row("SELECT * FROM `group_auth` WHERE `group_name` = '$user_group' AND `action_name` = '$action_name'", ARRAY_A);     
        
        if ( !is_null($result) && count($result) > 0){
            
            return true;
        }else{
            
            return false;
        }
    }
    // ---------  增删改查基本操作 - 开始
    public function select($sql_select){
	//$sql_select=$this->db->escape($sql_select);
        $result = $this->db->get_results($sql_select, ARRAY_A);  
        if(count($result)>0) 
        {return $result;
        }
        else{
          return false;
        }
    }
   

   // 在表中增加数据  输入表名和数组字段

     function insert($group_id,$action_name){
	     $group_id=$this->db->escape($group_id);
		 $action_name=$this->db->escape($action_name);
	     if(!$this->check_is_unique($group_id,$action_name))
            {
			     $sql='insert into `group_auth` (`group_name`,`action_name`) values('.$group_id.',\''.$action_name.'\')';
				 $result = $this->db->get_results($sql, ARRAY_A);  
                    return $result; 
			}		 
        else
		{
		     return true;
		}
        //return $result;
    }
    
    // 更新表中某个字段
    private function update_one($table_name,$col_name,$value){
	$table_name=$this->db->escape($table_name);
	  $col_name=$this->db->escape($col_name);
	   $value=$this->db->escape($value);
        $sql_query="update ".$table_name." set ".$col_name."=".$value;
        $this->db->query($sql_query);
    }
    //删除某个id的 权限
    public function delete_auth($auth_id){
	 $auth_id=$this->db->escape($auth_id);
	$sql='delete from `group_auth` where `auth_id`='.$auth_id;
	$this->db->query($sql);
    }
	// 删除某个组的某个权限
     public function delete_group_auth($group_id,$action_name)
	 {
	 $group_id=$this->db->escape($group_id);
	   $action_name=$this->db->escape($action_name);
	    $sql='delete from `group_auth` where `group_name`='.$group_id.' and `action_name`=\''.$action_name.'\'';
		$this->db->query($sql);
	 }
    
  
	
    // ---------  增删改查基本操作 - 结束
    
    // ---------  审核相关操作 - 开始
    
//---------------所有idea操作

    
    
	 public function get_all_auth($group_id)
	 {
	    $group_id=$this->db->escape($group_id);
        $sql='SELECT  `group_auth`.`action_name` from `group_auth` where `group_name`='.$group_id;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
        return $result;
	 }
   
    //验证是否重复
    public function check_is_unique($group_id,$action_name)
	{ 
	     $group_id=$this->db->escape($group_id);
	   $action_name=$this->db->escape($action_name);
	   $sql='select * from `group_auth` where `group_name`='.$group_id.' and `action_name`=\''.$action_name.'\'';
	    $result = $this->db->get_results($sql,ARRAY_A);
		return count($result);
	}
   

   
     

    //
}
