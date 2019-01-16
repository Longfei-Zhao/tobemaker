<?php

/*
前台项目展示接口

1，传入   $user_id start（开始位置），length（长度） type
       sort_rule:"new"/"hot"/"recommend"

user_id=-1  表示首页获取数据

type="pass" 获取集赞通过的数据
type="produce"  获取待生产的项目
type="pass_prduce" 获取集赞和待生产的项目

2，传出   
         num_of_all    符合条件总数
         data          数据数组
*/
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_like.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";

$class_session=new class_session();
$class_user=new class_user();

$current_user = $class_user->get_current_user();

$num_of_all=null;
    $class_idea=new class_idea();
    $class_like=new class_like();
    //如果发送了用户id，则获取是否喜欢的信息，否则默认不喜欢
    if(array_key_exists('user_id', $current_user))
    {
        $get_likeit=1;
        $user_id=$current_user['user_id'];
    }
    else{
        $get_likeit=0;
        $user_id=null;
    }


    if(array_key_exists('q', $_POST)&&strlen($_POST['q'])>0&&!array_key_exists('buy', $_POST)){
            //装备参数
    $key_word="%".$_POST['q']."%";
    $type=$_POST['type'];

    ////获取总数
        $num_of_all=$class_idea->search_num_by_key_word($key_word,$type);
        $start=isset($_POST['start'])?$_POST['start']:0;
        $length=isset($_POST['length'])?$_POST['length']:6;
        //  获取当前页面数据
        $data=$class_idea->search_part_by_key_word($key_word,$type,$start,$length);

         // 标记是否喜欢
        $data=$class_like->check_like_by_group($data,$user_id,$get_likeit);
        //
        $result['num_of_all']=$num_of_all;
        $result['num_of_currentpage']=count($data);
        $result['data']=$data;
        echo json_encode($result);
        exit();
    }

    elseif(!array_key_exists('buy', $_POST)){
    $start=isset($_POST['start'])?$_POST['start']:0;
    $length=isset($_POST['length'])?$_POST['length']:6;
    //装备参数
    $sort_key=$_POST['sort_rule'];
    $type=$_POST['type'];
//获取总数
    $num_of_all=$class_idea->get_ideanum_sort_by_rule($sort_key,$type);
    //  获取当前页面数据
    $data=$class_idea->get_idea_key_sort_by_rule($sort_key,$type,$start,$length);
    // 标记是否喜欢
    $data=$class_like->check_like_by_group($data,$user_id,$get_likeit);

    $records=array();
    $records['data']=array();
    $records['data']=$data;
            $records['num_of_all']=$num_of_all;
            echo json_encode($records);
            exit();
        }
    elseif(array_key_exists('buy', $_POST))
	{
	   $start=isset($_POST['start'])?$_POST['start']:0;
    $length=isset($_POST['length'])?$_POST['length']:6;
    //装备参数
    $sort_key=$_POST['sort_rule'];
    $type=$_POST['type'];
//获取总数
    $num_of_all=$class_idea->get_ideanum_sort_by_rule($sort_key,$type);
    //  获取当前页面数据
    $data=$class_idea->get_idea_key_sort_by_rule($sort_key,$type,$start,$length);
    // 标记是否喜欢
    $data=$class_like->check_buy_by_group($data,$user_id,$get_likeit);

    $records=array();
    $records['data']=array();
    $records['data']=$data;
            $records['num_of_all']=$num_of_all;
            echo json_encode($records);
            exit();
	}
    
?>

