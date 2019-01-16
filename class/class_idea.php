<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/****************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
include_once ROOT_PATH."class/class_pagesurpport.php";
include_once ROOT_PATH."class/class_user.php";


 /*----------idea_类 

 功能  对想法的增删改查等操作

 */

class class_idea
{
    public $db = null;
    public $num_of_waiting;

    function class_idea(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES UTF8");
    }

    // ---------  增删改查基本操作 - 开始
    public function select($sql_select){
	 //$sql_select = $this->db->escape($sql_select);
        $result = $this->db->get_results($sql_select, ARRAY_A);  
        return $result;
    }



   // 在表中增加数据  输入表名和数组字段  ［'cloumn'］=>'values'

    public function insert($table_name,$array){
        $num=count($array);
         $table_name=$this->db->escape($table_name);
	$keys=array_keys($array);
	for($i=0;$i<count($keys);$i++)
	{
	   $array[$keys[$i]]=$this->db->escape($array[$keys[$i]]);
	}
        $values=array_values($array);
        $aa=null;
        $bb=null;
        $i=0;
        while ($i<$num) {
                        # code...
                 $aa=$aa."`".$keys[$i]."`,";
                 if($values[$i]!=='now()'){
                 $bb=$bb."'".$values[$i]."',";
               }
               else{
                $bb=$bb.$values[$i].",";
               }
            $i=$i+1;
        }
        $aa=rtrim($aa,",");
        $bb=rtrim($bb,",");
        $sql="insert into ".$table_name."(".$aa.") values(".$bb.")";
        $this->db->query($sql);
        $res=$this->db->get_results("SELECT LAST_INSERT_ID()",ARRAY_A);
        return $res[0]['LAST_INSERT_ID()'];
    }
    

    // 更新单独表中某个字段
    private function update_one($table_name,$col_name,$value){
	     $table_name=$this->db->escape($table_name);
	  $col_name=$this->db->escape($col_name);
	   $value=$this->db->escape($value);
        $sql_query="update ".$table_name." set ".$col_name."=".$value;
        $this->db->query($sql_query);
    }
    

    // 删除idea信息
  
    public function delete($idea_id){
	$idea_id=$this->db->escape($idea_id);
      $sql='delete from `idea_info` where `idea_id`='.$idea_id;
       $this->db->query($sql);  
      
      
    }
    // 获取某个id详细信息


    public function get_idea_by_id($idea_id){
	$idea_id=$this->db->escape($idea_id);
      $sql="SELECT `idea_info`.*, `idea_status`.*, `user_info`.`head_pic_url` from `idea_info`, `idea_status`, `user_info` where `user_info`.`user_id` = `idea_info`.`user_id` and `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_id`=".$idea_id;
      $result = $this->db->get_results($sql, ARRAY_A); 

      $class_user = new class_user();
      
      $user_info = $class_user->select( $result[0]['user_id'] );

      $result[0]['user_name'] = $user_info[0]['user_name'];
      
      return $result;
    }

   //通过idea_info字段更新数据  传入修改的id和字段=》值 数组实现更新 
   
    public function update_idea($idea_id,$arr)
    {
	$idea_id=$this->db->escape($idea_id);
       $keys=array_keys($arr);
	  for($i=0;$i<count($keys);$i++)
	{
	   $arr[$keys[$i]]=$this->db->escape($arr[$keys[$i]]);
	}
      $values=array_values($arr);
      $num_a=count($keys);
      $i=0;
      $aa="";
      $bb="";
      while ($i<$num_a) {
        # code...
        if(isset($arr[$keys[$i]])){
          if($arr[$keys[$i]]==='now()')
          {
             $aa=$aa."`".$keys[$i]."`=now(),";
          }
          else{
          $aa=$aa."`".$keys[$i]."`='".$values[$i]."',";
        }

      }
        $i++;
      }
      $aa=rtrim($aa,",");
      $sql="UPDATE idea_info SET ".$aa." where idea_id=".$idea_id;
      
      $this->db->query($sql);
    }

    //按关键字获取部分

    function search_by_key_word($key_word,$start,$length)
    {
	$key_word=$this->db->escape($key_word);
	$start=$this->db->escape($start);
	$length=$this->db->escape($length);
      $key_word="%".$key_word."%";
      $sql="SELECT * from `idea_info` where `idea_info`.`idea_id` like '".$key_word."' or `idea_info`.`name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."' or `user_name` like '".$key_word."' limit ".$start.",".$length;
      //echo $sql;
      $result = $this->db->get_results($sql, ARRAY_A);  
      return $result;
    }


////  搜索＋排序
     function get_idea_key_sort_by_rule($sort_key,$type,$start,$length){
      $sort_key=$this->db->escape($sort_key);
	  $type=$this->db->escape($type);
	  $start=$this->db->escape($start);
	  $length=$this->db->escape($length);
      if($type=='pass'){
        $rule=' `idea_info`.`idea_status`=4 ';
      }
      elseif ($type=='produce') {
    # code..
        $rule=' `idea_info`.`idea_status`=5 ';
      }
      elseif ($type=='all') {
    # code...
        $rule=' ((`idea_info`.`idea_status`=4) or (`idea_info`.`idea_status`=5))';
      }

      if($sort_key=='new')
        {
            $sort_rule='`idea_info`.`create_time`';
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and ".$rule." and `idea_info`.`user_id`=`user_info`.`user_id` order by ".$sort_rule."  desc limit ".$start.",".$length;
        }
        elseif($sort_key=='hot')
        {
            $sort_rule='`idea_info`.`sum_like`';
            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and ".$rule." and `idea_info`.`user_id`=`user_info`.`user_id` order by ".$sort_rule."  desc limit ".$start.",".$length;
        }
        elseif($sort_key=='recommend')
        {
            $sort_rule='`idea_info`.`is_recommend`';

            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`is_recommend` >0 and `idea_info`.`user_id`=`user_info`.`user_id` order by `idea_info`.`is_recommend` desc limit ".$start.",".$length;
        }
        else{
        $sort_rule='`idea_info`.`is_recommend`';


            $sql="SELECT `idea_info`.*,`user_info`.`head_pic_url` from `idea_info`, `idea_status`,`user_info` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`is_recommend` >0 and `idea_info`.`user_id`=`user_info`.`user_id` order by `idea_info`.`is_recommend` desc limit ".$start.",".$length;
      }
      $res=$this->db->get_results($sql,ARRAY_A);
      
      $class_user = new class_user();
        
	  
        for($i=0;$i<count($res);$i++)
        {
           $sql='select * from `idea_comment` where `idea_id`=\''.$res[$i]["idea_id"].'\'';
              $res[$i]["sum_comment"]=count($this->db->get_results($sql,ARRAY_A));

              $user_info = $class_user->select( $res[$i]['user_id'] );
              
              $res[$i]["user_name"] = $user_info[0]['user_name'];
        }
        
      return $res;
     }


     function get_ideanum_sort_by_rule($sort_key,$type){
      $type=$this->db->escape($type);
	  $sort_key=$this->db->escape($sort_key);
      if($type=='pass'){
        $rule=' `idea_info`.`idea_status`=4 ';
      }
      elseif ($type=='produce') {
    # code..
        $rule=' `idea_info`.`idea_status`=5 ';
      }
      elseif ($type=='all') {
    # code...
        $rule=' ((`idea_info`.`idea_status`=4) or (`idea_info`.`idea_status`=5))';
      }

      if($sort_key=='new')
        {
            $sort_rule='`idea_info`.`create_time`';
        }
        elseif($sort_key=='hot')
        {
            $sort_rule='`idea_info`.`sum_like`';
        }
        elseif($sort_key=='recommend')
        {
            $sort_rule='`idea_info`.`is_recommend`';
        }
        else{
        $sort_rule='`idea_info`.`is_recommend`';
      }


      if($sort_rule==='is_recommend'){
        $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and ".$rule." and `idea_info`.`is_recommend`>0";

      }

      else{
        # code...
        $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and ".$rule;
      }
      $res=$this->db->get_results($sql,ARRAY_A);
      return $res[0]['count(*)'];
     }



  //     搜索＋排序

    //  按关键字获取全部
    function search_all_by_key_word($key_word)
    {
	$key_word=$this->db->escape($key_word);
      $key_word="%".$key_word."%";
      $sql="SELECT * from `idea_info` where `idea_info`.`idea_id` like '".$key_word."' or `idea_info`.`name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."' or `user_name` like '".$key_word."'";
      $result = $this->db->get_results($sql, ARRAY_A);  
      return $result;
    }

    //按照关键字分类搜索
    function search_part_by_key_word($key,$type,$start,$length){
       $key=$this->db->escape($key);
	  $type=$this->db->escape($type);
	  $start=$this->db->escape($start);
	  $length=$this->db->escape($length);
      if($type=='pass'){
        $rule=' `idea_info`.`idea_status`=4 ';
      }
      elseif ($type=='produce') {
    # code..
        $rule=' `idea_info`.`idea_status`=5 ';
      }
      elseif ($type=='all') {
    # code...
        $rule=' ((`idea_info`.`idea_status`=4) or (`idea_info`.`idea_status`=5))';
      }

      $key=$this->db->escape($key);
      $key_word=$key;


     $sql="SELECT * from `idea_info` where ".$rule." and (`idea_info`.`idea_id` like '".$key_word."' or `idea_info`.`name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."' or `user_name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."') limit ".$start.",".$length;
      $res=$this->db->get_results($sql,ARRAY_A);
      return $res;
     }



     function search_num_by_key_word($key,$type){
	  $key=$this->db->escape($key);
	  $type=$this->db->escape($type);
      
      if($type=='pass'){
        $rule=' `idea_info`.`idea_status`=4 ';
      }
      elseif ($type=='produce') {
    # code..
        $rule=' `idea_info`.`idea_status`=5 ';
      }
      elseif ($type=='all') {
    # code...
        $rule=' ((`idea_info`.`idea_status`=4) or (`idea_info`.`idea_status`=5))';
      }

      $key=$this->db->escape($key);
      $key_word="%".$key."%";


     $sql="SELECT count(*) from `idea_info` where ".$rule." and (`idea_info`.`idea_id` like '".$key_word."' or `idea_info`.`name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."' or `user_name` like '".$key_word."' or `idea_info`.`content` like '".$key_word."')";

    $data=$this->db->get_results($sql,ARRAY_A);
    $num_of_all=$data[0]['count(*)'];
      return $num_of_all;
     }


    // ---------  增删改查基本操作 - 结束
    
    // ---------  审核相关操作 - 开始
    
//---------------所有idea操作

    
    //获取所有项目数量
    public function get_all_idea_num(){
       
        $sql="SELECT count(*) from `idea_info`";
        $result = $this->db->get_results($sql,ARRAY_A);
        return $result[0]['count(*)'];
    }

   //获取部分项目
     public function get_part_ideas($begin,$num){
        
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_info`.`brief`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id` limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
        return $result;
    }

    //获取部分项目加按照状态排序    先获取符合条件的,后排序
     public function get_part_ideas_order_status($begin,$num,$sort_rule){

      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
      if($sort_rule==0){  //增序
        $sql="SELECT  `idea_info`.*, `idea_status`.`status_name` from `idea_info`,`idea_status` where `idea_status`.`status_id`=`idea_info`.`idea_status` order by `idea_info`.`idea_status` asc limit ".$begin.",".$num;
      }
      elseif ($sort_rule==1) {  //倒序
        # code...
        $sql="SELECT  `idea_info`.*, `idea_status`.`status_name` from `idea_info`,`idea_status` where `idea_status`.`status_id`=`idea_info`.`idea_status` order by `idea_info`.`idea_status` desc limit ".$begin.",".$num;

      }
      $result = $this->db->get_results($sql,ARRAY_A);
      return $result;
    }
    
    //  根据id排序获取想法id
    public function get_part_ideas_order_ideaid($begin,$num,$sort_rule){
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
      if($sort_rule==0){
        $sql="SELECT  `idea_info`.*, `idea_status`.`status_name` from `idea_info`,`idea_status` where `idea_status`.`status_id`=`idea_info`.`idea_status` order by `idea_info`.`idea_id` asc limit ".$begin.",".$num;
      }elseif ($sort_rule==1) {
        # code...
        $sql="SELECT  `idea_info`.*, `idea_status`.`status_name` from `idea_info`,`idea_status` where `idea_status`.`status_id`=`idea_info`.`idea_status` order by `idea_info`.`idea_id` desc limit ".$begin.",".$num;
      }
        $result = $this->db->get_results($sql,ARRAY_A);
        return $result;
    }
     // 获取所有待审核项目
    public function get_all_waiting(){
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
      $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.*,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=2 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id`";
        $result = $this->db->get_results($sql,ARRAY_A);
      return $result;
    }

   //------------------- 待审核项目操作

    //获取待审核项目的数目
    public function get_num_of_waiting(){
      $sql="SELECT * from idea_info where idea_status=2";
      $result = $this->db->get_results($sql, ARRAY_A);
      $num=count($result);
      return $num;
    }
    // 获取部分待审核想法
    //传入起点和读取的数目
    //
    public function get_waiting($begin,$num){
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_info`.`brief`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=2 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id` limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
        return $result;
    }
    

    //------------------- 审核通过项目操作

    //获取审核通过项目的数目
    public function get_num_of_passed(){
      $sql="SELECT * from idea_info where idea_status=4";
      $result = $this->db->get_results($sql, ARRAY_A);
      $num=count($result);
      return $num;
    }
    
    //显示部分审核通过的项目
    public function get_part_passed($begin,$num){
        
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_info`.`brief`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=4 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id` limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
        return $result;
    }

    // 显示审核通过想法
    public function get_passed(){
      $sql="SELECT `idea_manage`.`idea_id`,`idea_info`.`name`,`idea_info`.`user_name`,`idea_manage`.`reason`,`idea_manage`.`idea_status`, `idea_status`.`status_name`from `idea_info`,`idea_status`,`idea_manage` where `idea_info`.`idea_status`=4 and `idea_status`.`status_id`=`idea_info`.`idea_status` and `idea_manage`.`idea_id`=`idea_info`.`idea_id`)";
      $result = $this->db->get_results($sql, ARRAY_A);
    }

    public function get_num_of_ideas_by_status($status){
      $sql="SELECT count(*) from `idea_info` where `idea_info`.`idea_status`=".$status;
      $result = $this->db->get_results($sql, ARRAY_A);
      return (int)$result[0]["count(*)"];
    }
    


//--------------------------几类标记

    // 标记想法为审核通过
    public function mark_pass($idea_id,$reason=""){
        // 修改两张表：  基本信息表idea_info 和idea管理表 idea_manage
      $idea_id = $this->db->escape($idea_id);
      $reason=$this->db->escape($reason);
        $sql="update idea_info set `idea_status`=4 where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
        $sql="update idea_manage set `idea_status`=4 ,`reason`=\"".$reason."\",`last_change_time`=now() where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
        return $result;
    }
    // 标记审核不通过
    public function mark_fail($idea_id,$reason=""){
        // 修改两张表：  基本信息表idea_info 和idea管理表 idea_manage
      $idea_id = $this->db->escape($idea_id);
      $reason=$this->db->escape($reason);
        $sql="UPDATE idea_info set `idea_status`=3 where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
        $sql="UPDATE idea_manage set `idea_status`=3 ,`reason`=\"".$reason."\",`last_change_time`=now() where `idea_id`=".$idea_id;
        $result = $this->db->query($sql);
    }
    //
    //标记为下线
	public function mark_offline($idea_id)
	{
	    $idea_id = $this->db->escape($idea_id);
		$sql='update `idea_info` set `idea_status`=7 where `idea_id`='.$idea_id;
		$result = $this->db->query($sql);
	}
    //转为待产
	public function mark_product($idea_id)
	{
	    $idea_id = $this->db->escape($idea_id);
		$sql='update `idea_info` set `idea_status`=5 where `idea_id`='.$idea_id;
		$result = $this->db->query($sql);
	}
    public function get_ideanum_by_userid($type,$user_id){

      if($type=='pass')
      {
        $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=4 and user_id=".$user_id;
      }
      elseif ($type=='produce') {
        # code...
        $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=5 and user_id=".$user_id;

      }
      elseif ($type=='pass_produce') {
        # code...
        $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and (`idea_info`.`idea_status`=4 or `idea_info`.`idea_status`=5) and `idea_info`.`user_id`=".$user_id;
      }

      elseif ($type=='all') {
        # code...
        $sql="SELECT count(*) from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`user_id`=".$user_id;
      }

      $res=$this->db->get_results($sql,ARRAY_A);
      $num=$res[0]['count(*)'];

      return $num;

    }


    public function get_ideas_by_userid($type,$user_id,$start,$length){

      if($type=='pass')
      {
        $sql="SELECT * from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=4 and user_id=".$user_id." limit ".$start.",".$length;
      }
      elseif ($type=='produce') {
        # code...
        $sql="SELECT * from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`idea_status`=5 and user_id=".$user_id." limit ".$start.",".$length;

      }
      elseif ($type=='pass_produce') {
        # code...
        $sql="SELECT * from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and (`idea_info`.`idea_status`=4 or `idea_info`.`idea_status`=5) and `idea_info`.`user_id`=".$user_id." limit ".$start.",".$length;
      }

      elseif ($type=='all') {
        # code...
        $sql="SELECT * from `idea_info`, `idea_status` where `idea_info`.`idea_status`=`idea_status`.`status_id` and `idea_info`.`user_id`=".$user_id." limit ".$start.",".$length;
      }

     // echo $sql;
      $res=$this->db->get_results($sql,ARRAY_A);
      return $res;

    }
}
