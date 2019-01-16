<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');
/****************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
 class class_attention
{
 private $db = null;
//global $arr_action_name;//在此添加action_name
function class_attention()
{
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES utf8");
}

//------添加关注
 function insert($userid,$attention_userid)
{
     $userid=$this->db->escape($userid);
	 $attention_userid=$this->db->escape($attention_userid);
     $sql='insert into `attention` (`userid`,`attention_userid`) values('.$userid.','.$attention_userid.')'; 
     $this->db->query($sql);
	 

}
//-------获取所关注信息
function select_attention($userid)
{
$userid=$this->db->escape($userid);
    $sql='select * from `attention` where `userid`='.$userid;
	$result=$this->db->get_results($sql,ARRAY_A);
	return $result;
}
//--------获取被关注信息
function select_by_attention($attention_userid)
{
    $attention_userid=$this->db->escape($attention_userid);
    $sql='select * from `attention` where `attention_userid`='.$attention_userid;
	$result=$this->db->get_results($sql,ARRAY_A);
	return $result;
}
//---------取消关注
function delete($userid,$attention_userid)
{
    $attention_userid=$this->db->escape($attention_userid);
	$userid=$this->db->escape($userid);
    $sql='delete from `attention` where `userid`='.$userid.' and `attention_userid`='.$attention_userid;
	$this->db->query($sql);
}
//--------验证是否已经关注重复返回true
function checkunique($userid,$attention_userid)
{
     $attention_userid=$this->db->escape($attention_userid);
	 $userid=$this->db->escape($userid);
     $sql='select * from `attention` where `userid`='.$userid.' and `attention_userid`='.$attention_userid;
	 $result=$this->db->get_results($sql,ARRAY_A);
	 return count($result);
}
 //-------获取关注数量
 function get_num_attention($userid)
 {
     $userid=$this->db->escape($userid);
     $sql='select * from `attention` where `userid`='.$userid;
	$result=$this->db->get_results($sql,ARRAY_A);
	return count($result);
 }
 //------- 获取被关注数量
 function get_num_by_attention($attention_userid)
 {
    $attention_userid=$this->db->escape($attention_userid);
    $sql='select * from `attention` where `attention_userid`='.$attention_userid;
	$result=$this->db->get_results($sql,ARRAY_A);
	return count($result);
 }
 //-------获取关注者信息
 function get_part_attention($userid,$begin,$num)
 {
     $userid=$this->db->escape($userid);
	 $begin=$this->db->escape($begin);
	 $num=$this->db->escape($num);
     $sql='select * from `attention` where `userid`='.$userid.' limit '.$begin.','.$num.'';
	$result=$this->db->get_results($sql,ARRAY_A);
	return $result;
 }
 //------获取关注自己的人的信息
 function get_part_attention_me($attention_userid,$begin,$num)
 {
    $attention_userid=$this->db->escape($attention_userid);
	 $begin=$this->db->escape($begin);
	 $num=$this->db->escape($num);
      $sql='select * from `attention` where `attention_userid`='.$attention_userid.' limit '.$begin.','.$num.'';
	$result=$this->db->get_results($sql,ARRAY_A);
	return $result;
 }
}
   

