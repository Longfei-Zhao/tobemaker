<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";

class class_feedback
{
    private $db = null;

    function class_feedback(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES UTF8");
    }

    function insert($msg, $uuid){
        $msg = $this->db->escape($msg);
        $uuid = $this->db->escape($uuid);
        
        $sql="insert into `feedback` (`msg`, `userid`) values ( '$msg', '$uuid'  )";
        $this->db->query($sql);
        
    }

}