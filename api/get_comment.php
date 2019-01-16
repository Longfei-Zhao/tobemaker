<?php

/*
文件名 get_comment

项目列表查询
传入

action='get_comment'
start
length
idea_id 

start（开始位置），length（长度）
idea_id=  当前项目id


返回

data（数组），其中每个元素需要包括：user_id,head_pic_url,user_name,context,comment_time
num_of_all：项目总数
*/
include_once "../config.php";
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_comment.php";
include_once ROOT_PATH."class/class_session.php";
include_once ROOT_PATH."class/class_user.php";
    $class_session=new class_session();
    $class_user=new class_user();
    $class_idea=new class_idea();
    $class_comment=new class_comment();
    $current_user = $class_user->get_current_user();
    $user_id=$current_user['user_id'];
    //如果发送了用户id，则获取是否喜欢的信息，否则默认不喜欢
    if(array_key_exists('action', $_POST))
    {
       if($_POST['action']=='get_comment')
       {
        $start=isset($_POST['start'])?$_POST['start']:0;
        $length=isset($_POST['length'])?$_POST['length']:10;
        $idea_id=$_POST['idea_id'];

        //获取评论信息
        $num=$class_comment->get_num_of_comment($idea_id);
        $data=$class_comment->get_part_comment_by_ideaid($idea_id,$start,$length);

        //判断是否加精和是否点赞过

        $top3_min=$class_comment->get_top3_minnum($idea_id);
        $i=0;
        while ($i<count($data)) {
            # code...

            if($data[$i]['comment_like_sum']>=$top3_min)
            {
                $data[$i]['is_digest']=1;
            }
            $data[$i]['is_like']=$class_comment->check_comment_like($user_id,$data[$i]['id']);
            $i++;
        }


        $arr['num_of_all']=$num;
        $arr['data']=$data;
        echo json_encode($arr);
        exit();
       }


       //对评论点赞
       if($_POST['action']=="comment_addlike")
       {
        //  组织数据
        $comment_id=$_POST['id'];
        $user_id=$current_user['user_id'];
        //逻辑处理
        $new_idea_comment=$class_comment->addlike_to_comment($user_id,$comment_id);
        //组织数据并返回
        $arr['status']='success';
        $arr['data']=$new_idea_comment;
        echo json_encode($arr);
        exit();
       }
    }
