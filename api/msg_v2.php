<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

class msg_v2{
    
    function index(){
        
    }
    
    // select
    
    function with_2_user(){
        
        $class_msg = new class_Msgv2();
        
        $to_user_id = @$_POST['to_user_id'];
        $now_user_id = @$_POST['now_user_id'];
        $start = intval(@$_POST['start']);
        $end = intval(@$_POST['end']);
        
        if ($end - $start > 50){
            $end = $start + 50;
        }
        
        $result = $class_msg->select_by_usera_userb_with_userinfo($to_user_id, $now_user_id, $start, $end);
        
        return array(
            'status' => 'success',
            'data' => $result,
        );
    }
    
    function to_user(){
        
        $user_id = @$_POST['user_id'];
        
        $start = intval(@$_POST['start']);
        $end = intval(@$_POST['end']);
        
        if ($end - $start > 50){
            $end = $start + 50;
        }
        
        $class_msg = new class_Msgv2();
        $result = $class_msg->select_by_receiver_with_userinfo($user_id);
        
        return array(
            'status' => 'success',
            'data' => $result
        );
        
    }
    
    // action
    
    function mark_read($msg_id){
        
        $data = array(
            'message_status' => 2,
        );
        
        $class_msg = new class_Msgv2();
        
        $status = $class_msg->update($msg_id, $data);
        
        if ($status == true){
            return array(
                'status' => 'success'
            );
        }else{
            return array(
                'status' => 'fail'
            );
        }
    }
    
    function mark_unread($msg_id){
        $data = array(
            'message_status' => 1,
        );
        
        $class_msg = new class_Msgv2();
        
        $status = $class_msg->update($msg_id, $data);
        
        if ($status == true){
            return array(
                'status' => 'success'
            );
        }else{
            return array(
                'status' => 'fail'
            );
        }
    }
    
    function send(){
        
        $data = array(
            'sender_id' => $_SESSION['user_id'],
            'context' => @$_POST['content'],
            'message_status' => 1,
            'receiver_id' => @$_POST['to_user'],
        );
        
        $class_msg = new class_Msgv2();
        $status = $class_msg->insert($data);
        
        if ($status == true){
            return array(
                'status' => 'success'
            );
        }else{
            return array(
                'status' => 'fail'
            );
        }
    }
    
    function delete($msg_id){
        $class_msg = new class_Msgv2();
        
        $status = $class_msg->delete($msg_id);
        
        if ($status == true){
            return array(
                'status' => 'success',
            );
        }else{
            return array(
                'status' => 'fail',
            );
        }
    }
    
}