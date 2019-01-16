<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');
/****************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
 class class_auth
{
//global $arr_action_name;//在此添加action_name
private $arr_action_name=array("admin"=>"admin","view"=>"view","submitproject"=>"submitproject");

 function get_action_name_list()
{
 
 
return $this->arr_action_name;
}
 function get_action_num()
{
return count($this->arr_action_name);
}
}
   

