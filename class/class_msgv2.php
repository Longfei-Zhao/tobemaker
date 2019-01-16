<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');


 class class_Msgv2
{
    private $db = null;
    private $db_agent = null;

    function __construct(){
        
        // Initialise database object
        $this->db_agent = class_Db::GetInstance();
        $this->db = $this->db_agent->db;
    }
    
    function insert($data){
        return $this->db_agent->insert_array('idea_message', $data);
    }
    
    function update($msg_id, $data){
        $msg_id = $this->db->escape($msg_id);
        
        return $this->db_agent->update_array('idea_message', $data, "`id` = $msg_id");
    }
    
    //标记删除
    function delete($msg_id){
        $msg_id = $this->db->escape($msg_id);
        
        $sql = "delete from `idea_message` where `id` = $msg_id";
        
        return $this->db->query($sql);
    }
    
    function select_by_condition($condition, $orderby = '', $desc = 1, $start = 0, $length = 0){
//        $condition = $this->db->escape($condition);
        
        $sql = "select * from `idea_message` where $condition ";
        
        return $this->db_agent->select2($sql, $orderby, $desc, $start, $length);
    }
    
    function select_by_userid($user_id){
        $user_id = $this->db->escape($user_id);
        
        $condition = "`sender_id` = $user_id or `receiver_id` = $user_id";
        
        return $this->select_by_condition($condition, 'send_time', 1);
        
    }
    
    function select_by_receiver($user_id){
        $user_id = $this->db->escape($user_id);
        
        $condition = "`receiver_id` = $user_id";
        
        return $this->select_by_condition($condition, 'send_time', 1);
    }
    
    function select_by_receiver_with_userinfo($user_id){
        $user_id = $this->db->escape($user_id);
        
        $sql = "select `i`.*, `u`.`head_pic_url` as `sender_head_url`, `u`.`user_name` as `sender_name` from `idea_message` as `i`, `user_info` as `u`"
            . " where `u`.`user_id` = `i`.`sender_id` and `i`.`receiver_id` = $user_id order by `i`.`send_time` desc";
        
        $result = $this->db->get_results($sql, ARRAY_A);
        
        return $result;
    }
    
    function select_by_usera_userb($to_user_id, $now_user_id, $start, $end){
        $to_user_id = $this->db->escape($to_user_id);
        $now_user_id = $this->db->escape($now_user_id);
        
        
        
        $condition = "(`receiver_id` = $to_user_id and `sender_id` = $now_user_id) or ";
        $condition .= "(`receiver_id` = $to_user_id and `sender_id` = $now_user_id) ";
        $ret = $this->select_by_condition($condition, 'send_time', 1);
//        $this->db->debug();
        return $ret;
    }
    
    function select_by_usera_userb_with_userinfo($to_user_id, $now_user_id, $start, $end){
        $to_user_id = $this->db->escape($to_user_id);
        $now_user_id = $this->db->escape($now_user_id);
        
        $sql = "select `i`.*, `u`.`head_pic_url` as `sender_head_url`, `u`.`user_name` as `sender_name` from `idea_message` as `i`, `user_info` as `u`"
            . " where `u`.`user_id` = `i`.`sender_id` and "
                . " ( "
                    . "(`i`.`receiver_id` = $to_user_id and `i`.`sender_id` = $now_user_id) or "
                    . "(`i`.`receiver_id` = $now_user_id and `i`.`sender_id` = $to_user_id) "
                . " ) order by `i`.`send_time` desc";
        
        $result = $this->db->get_results($sql, ARRAY_A);
        
        return $result;
    }
}
