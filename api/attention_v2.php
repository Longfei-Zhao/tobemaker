<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

class attention_v2{
    
    function index(){
        
    }
    
    // select
    function to_me($user_id){
        $class_attention = new class_Attentionv2();
        
        $result = $class_attention->select_to_me($user_id);
        
        return array(
            'status' => 'success',
            'data' => $result,
        );
    }
    
    function from_me($user_id){
        
        $class_attention = new class_Attentionv2();
        
        $result = $class_attention->select_from_me($user_id);
        
        return array(
            'status' => 'success',
            'data' => $result,
        );
        
        
    }
}