<?php
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
/*******
站内信类
主要功能：
1，获取所有消息，新消息，已经读取的消息
2，给指定人发送消息
3，给指定人群发送群消息
4，针对消息进行回复
5，标记已读 删除

********************/

class class_message
{
    private $db = null;

    function class_message(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES utf8");
    }

    //获取相关信息
    //1,获取全部消息
    function  get_all_message($user_id){
    	$user_id=$this->db->escape($user_id);
    	$sql="SELECT *,`user_info`.`user_name` from `idea_message`,`user_info` where `user_info`.`user_id`=`idea_message`.`sender_id` and `sender_id`=".$user_id;

    	$res=$this->db->get_results($sql,ARRAY_A);
    	return $res;
    }
//获取部分收到消息
function  get_part_message($user_id,$begin,$legth){
    	$user_id=$this->db->escape($user_id);
    	$sql='SELECT `idea_message`.*,`user_info`.`user_name` from `idea_message`,`user_info` where `user_info`.`user_id`=`idea_message`.`sender_id` and `receiver_id`='.$user_id.' order by `idea_message`.`send_time` limit '.$begin.','.$legth.'';

    	$res=$this->db->get_results($sql,ARRAY_A);
    	return $res;
    }
    //2,获取未读取消息

    function get_new_message($user_id){
    	$user_id=$this->db->escape($user_id);
    	$sql="SELECT *,`user_info`.`user_name` from `idea_message`,`user_info` where `user_info`.`user_id`=`idea_message`.`sender_id` and `idea_message`.`message_status`='not_read' and `sender_id`=".$user_id;

    	$res=$this->db->get_results($sql,ARRAY_A);
    	return $res;

    }

    //3,获取已经读取消息

    function get_read_already($user_id){
    	$user_id=$this->db->escape($user_id);
    	$sql="SELECT *,`user_info`.`user_name` from `idea_message`,`user_info` where `user_info`.`user_id`=`idea_message`.`sender_id` and `idea_message`.`message_status`='read_already' and `sender_id`=".$user_id;

    	$res=$this->db->get_results($sql,ARRAY_A);
    	return $res;

    }

    //4,获取已经删除消息

    function get_delet_already($user_id){
    	$user_id=$this->db->escape($user_id);
    	$sql="SELECT *,`user_info`.`user_name` from `idea_message`,`user_info` where `user_info`.`user_id`=`idea_message`.`sender_id` and `idea_message`.`message_status`='delete_already' and `sender_id`=".$user_id;

    	$res=$this->db->get_results($sql,ARRAY_A);
    	return $res;

    }


    //给个人发送消息
    function send_to_uid($sender_id,$reciever_id,$context){
    //	echo $sender_id;
    	$sender_id = $this->db->escape($sender_id);
        $reciever_id = $this->db->escape($reciever_id);
        $context=$this->db->escape($context);
    	$sql='insert into `idea_message`(`sender_id`,`context`,`send_time`,`receiver_id`) values('.$sender_id.',\''.$context.'\',now(),'.$reciever_id.')';
        //echo $sql;
    	$result=$this->db->query($sql);
		return $sql;
    }

    //给群体发送消息

    function send_to_group(){


    }
     // 回复某则消息

    //标记消息已经读取
    function mark_read_alredy($message_id){

        $message_id=$this->db->escape($message_id);
    	$sql="UPDATE idea_message set `message_status`='read_already' where `id`=".$message_id;
    	$result=$this->db->query($sql);

    }

    //删除消息 
    function delete_message($message_id){
    	$message_id=$this->db->escape($message_id);
    	$sql="UPDATE idea_message set `message_status`='delete_already' where `id`=".$message_id;
    	$result=$this->db->query($sql);
    }
}
