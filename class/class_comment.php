<?php
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
/*******
评论类
主要功能：
1，创建，获取一级评论
2，创建回复，获取回复
3，数据库字段设计：

********************/

class class_comment
{
    private $db = null;

    function class_comment(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES utf8");
    }


    //   //------获取所有评论
    ///  有评论时候返回的是二维数组，result[i]['aa']表示第i条记录的aa字段值
    public function get_all_comment_by_ideaid($idea_id){
         $idea_id = $this->db->escape($idea_id);
    	
    	$sql="SELECT `idea_comment`.*,`idea_info`.`name`,`user_info`.`user_name` from `idea_comment`,`idea_info`,`user_info` where `idea_comment`.`idea_id`=`idea_info`.`idea_id` and `idea_comment`.`sender_id`=`user_info`.`user_id` and `idea_comment`.`idea_id`=".$idea_id." order by `idea_comment`.`comment_time` desc";
    	$result=$this->db->get_results($sql,ARRAY_A);
    	
    		return $result;
    }


  //------   获取部分评论
    public function get_part_comment_by_ideaid($idea_id,$start,$length){
         $idea_id = $this->db->escape($idea_id);
        
        $sql="SELECT `idea_comment`.*,`idea_info`.`name`,`user_info`.`user_name` ,`user_info`.`head_pic_url` from `idea_comment`,`idea_info`,`user_info` where `idea_comment`.`idea_id`=`idea_info`.`idea_id` and `idea_comment`.`sender_id`=`user_info`.`user_id` and `idea_comment`.`idea_id`=".$idea_id." order by `idea_comment`.`comment_time` desc limit ".$start.", ".$length;
        $result=$this->db->get_results($sql,ARRAY_A);
            return $result;

    }


    // 增加评论  传进idea_id，评论者id和评论类容
    //  修改两张表： idea_info 和 idea_comment
    public function add_comment($idea_id,$user_id,$context){
        $idea_id = $this->db->escape($idea_id);
        $user_id = $this->db->escape($user_id);
        $context=$this->db->escape($context);


    
        //------ id_info 添加评论数目
    	$sql="update idea_info set sum_comment=sum_comment+1";
        $this->db->query($sql);

        //idea_comment 添加评论事件
    	$sql="select user_id from idea_info where idea_id=".$idea_id;
    	$result=$this->db->get_results($sql,ARRAY_A);
    	$receiver_id=$result[0]['user_id'];
    	$sql="insert into idea_comment(`idea_id`,`context`,`comment_time`,`sender_id`) values(".$idea_id.",\"".$context."\",now(),".$user_id.")";
    	$result=$this->db->query($sql);
    }


    
     
    //  添加回复  (已经废除的设计)
    //  需要参数  a回复b的评论，需要b的评论事件id，a的id和回复内容
    //  修改一张表：idea_comment 
    public function add_reply($comment_id,$user_id,$context){
        $comment_id = $this->db->escape($comment_id);
        $user_id = $this->db->escape($user_id);
        $context=$this->db->escape($context);

                // 第一步，获取主题id

    	$sql="select idea_id from idea_comment where id=".$comment_id;
    	$result=$this->db->get_results($sql,ARRAY_A);
    	$idea_id=$result[0]['idea_id'];


    	// 第二步：添加回复记录
    	$sql="insert into idea_comment values('$idea_id','$context','1',now(),null,'','$user_id','$receiver_id',0)";
    	$result=$this->db->query($sql);
    	//第三步，关联回复对象和本次回复记录
    	$sql="select * from idea_comment where idea_id=".$idea_id." and context=".$context;
    	$result=$this->db->get_results($sql,ARRAY_A);
    	$id=$result[0]["id"];
    	$sql="update idea_comment set son_id=".$id;
        $this->db->query($sql);
    }


    // 获取评论数目
    public function get_num_of_comment($idea_id)
    {
        $comment_id = $this->db->escape($idea_id);
        $sql="select count(*) from idea_comment where idea_id=".$idea_id;
        $result=$this->db->get_results($sql,ARRAY_A);
        return $result[0]['count(*)'];
    }

    public function get_top3_minnum($idea_id)
    {
        $comment_id = $this->db->escape($idea_id);
        $sql="SELECT * from idea_comment where `idea_id`=".$idea_id." and `comment_like_sum`>0 order by `comment_like_sum` desc";
        $result=$this->db->get_results($sql,ARRAY_A);
        $sum=count($result);
        return $result[$sum-1]['comment_like_sum'];
    }
    //删除评论，暂时没有需求
    public function delete_comment()
    {

    }
    


    public function addlike_to_comment($user_id,$comment_id)
    {
        $user_id=$this->db->escape($user_id);
        $comment_id=$this->db->escape($comment_id);

        $sql="INSERT INTO `comment_like`(`liker_id`,`comment_id`) values (".$user_id." , ".$comment_id.")";
        $this->db->query($sql);
        $sql="UPDATE `idea_comment` set `comment_like_sum`=`comment_like_sum`+1 where `id` =".$comment_id;
        $this->db->query($sql);
        $sql="SELECT * from `idea_comment` where `id`=".$comment_id;
        $res=$this->db->get_results($sql,ARRAY_A);
        ;
        return $res[0];
    }

    public function check_comment_like($user_id,$comment_id)
    {
         $user_id=$this->db->escape($user_id);
        $comment_id=$this->db->escape($comment_id);
        $sql="SELECT * from `comment_like` where `comment_id`=".$comment_id." and liker_id=".$user_id;
        $res=$this->db->get_results($sql,ARRAY_A);
        ;
        return count($res);
    }
}
?>
