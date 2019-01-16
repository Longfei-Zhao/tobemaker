<?php
include_once "../config.php";

include_once ROOT_PATH."class/class_feedback.php";

header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');
header('Access-Control-Allow-Methods: OPTIONS, HEAD, POST');
header('Access-Control-Allow-Origin: *');

if( array_key_exists('msg', $_POST) && array_key_exists('userid', $_POST) ){
    $msg = $_POST['msg'];
    $userid = $_POST['userid'];
    
    $feedback = new class_feedback();
    $feedback->insert($msg, $userid);
    
    echo json_encode(array('status'=>'success'));
}else{
    echo json_encode(array('status'=>'missing_param'));
}

