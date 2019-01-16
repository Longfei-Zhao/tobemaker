<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');


 class class_Attentionv2
{
    private $db = null;
    private $db_agent = null;

    function __construct(){
        
        // Initialise database object
        $this->db_agent = class_Db::GetInstance();
        $this->db = $this->db_agent->db;
    }
    
    function select_by_condition_count($condition, $orderby = '', $desc = 1, $start = 0, $length = 0){
//        $condition = $this->db->escape($condition);
        
        $sql = "select * from `idea_message` where $condition ";
        
        return $this->db_agent->select2($sql, $orderby, $desc, $start, $length);
    }
    
    function select_to_me($user_id){
        $user_id = $this->db->escape($user_id);
        
        $sql = "select `a`.*, `u`.`user_name`, `u`.`head_pic_url` as `user_head_url` from `attention` as `a` , `user_info` as `u` where "
                . "`a`.`userid` = `u`.`user_id` and "
                . "`a`.`attention_userid` = $user_id";
        
        $result = $this->db->get_results($sql, ARRAY_A);
        
        return $result;
    }
    
    function select_from_me($user_id){
        $user_id = $this->db->escape($user_id);
        
        $sql = "select `a`.*, `u`.`user_name` as `attention_name`, `u`.`head_pic_url` as `attention_head_url` from `attention` as `a` , `user_info` as `u` where "
                . "`a`.`userid` = $user_id and "
                . "`a`.`attention_userid` = `u`.`user_id`";
        
        $result = $this->db->get_results($sql, ARRAY_A);
        
        return $result;
    }
    
}