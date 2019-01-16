<?php
/*
api功能  获取某个用户所有项目信息
传入  user_id  start length type
传出  data[]  num_of_all

*/
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$class_session=new class_session();
$class_user=new class_user();

$current_user = $class_user->get_current_user();

    $class_idea=new class_idea();
    $start=isset($_POST['start'])?$_POST['start']:0;
    $length=isset($_POST['length'])?$_POST['length']:4;
    $type=$_POST['type'];
    $user_id=$current_user['user_id'];

    $num=$class_idea->get_ideanum_by_userid($type,$user_id);
    $res=$class_idea->get_ideas_by_userid($type,$user_id,$start,$length);
            $records=array();
            $records['data']=array();
            $records['data']=$res;
            $records['num_of_all']=$num;
            echo json_encode($records);
            exit();

  
?>