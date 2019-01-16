<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/****************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
include_once ROOT_PATH."class/class_pagesurpport.php";

 class class_product
{
    private $db = null;
    public $num_of_waiting;

    function class_product(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES UTF8");
    }

    // ---------  增删改查基本操作 - 开始
    public function select($sql_select){
	   //$sql_select= $this->db->escape($sql_select);
        $result = $this->db->get_results($sql_select, ARRAY_A);  
        if(count($result)>0) 
        {return $result;
        }
        else{
          return false;
        }
    }
   

   // 在表中增加数据  输入表名和数组字段

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
                 $bb=$bb."'".$values[$i]."',";
                          $i=$i+1;         
        }
        $aa=rtrim($aa,",");
        $bb=rtrim($bb,",");
        $sql="insert into ".$table_name."(".$aa.") values(".$bb.")";
        $sql;
        $this->db->query($sql);
        $res=$this->db->get_results("SELECT LAST_INSERT_ID()",ARRAY_A);
        return $res[0]['LAST_INSERT_ID()'];
        //return $result;
    }
    
    // 更新表中某个字段
    private function update_one($table_name,$col_name,$value){
	 $table_name=$this->db->escape($table_name);
	  $col_name=$this->db->escape($col_name);
	   $value=$this->db->escape($value);
        $sql_query="update ".$table_name." set ".$col_name."=".$value;
        $this->db->query($sql_query);
    }
    //删除某个id的商品
    public function delete_product($pf_id){
	$pf_id=$this->db->escape($pf_id);
	$sql='delete from `product_info` where `pf_id`='.$pf_id;
	$this->db->query($sql);
    }
	 //删除某个id的商品目录
    public function delete_category($pc_id){
	$pc_id=$this->db->escape($pc_id);
	$sql='delete from `product_category` where `pc_id`='.$pc_id;
	$this->db->query($sql);
    }
    // 获取某个id详细信息
    public function get_product_by_id($pf_id){
	$pf_id=$this->db->escape($pf_id);
      $sql="SELECT pf.*, pc.pc_name from `product_info` as pf, `product_category` as pc where `product_info`.`pc_id`=pc.`pc_id` and `product_info`.`pf_id`=".$product_id.' order by `pf_sort` desc';
      $result = $this->db->get_results($sql, ARRAY_A);  
      return $result;
    }
    //获取某个id目录信息
	public function get_category_by_id($pc_id)
	{
	$pc_id=$this->db->escape($pc_id);
	$sql='select pc.* from `product_category` as pc where pc.`pc_id`='.$pc_id;
	$result = $this->db->get_results($sql, ARRAY_A);  
      return $result;
	}
   //通过product_info字段更新数据  传入修改的id和字段=》值 数组实现更新 
   
     public function update_product($product_id,$arr)
    {
	  $product_id=$this->db->escape($product_id);
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
        if($arr[$keys[$i]]!=""){
        $aa=$aa."`".$keys[$i]."`='".$values[$i]."',";
      }
        $i++;
      }
      $aa=rtrim($aa,",");
      $sql="UPDATE product_info SET ".$aa." where pf_id=".$product_id;
	  
      $this->db->query($sql);
	  
     // echo $sql;
    }
	//通过product_category字段更新数据  传入修改的id和字段=》值 数组实现更新 
	 public function update_category($product_id,$arr)
    {
       $product_id=$this->db->escape($product_id);
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
        if($arr[$keys[$i]]!=""){
        $aa=$aa."`".$keys[$i]."`='".$values[$i]."',";
      }
        $i++;
      }
      $aa=rtrim($aa,",");
      $sql="UPDATE product_category SET ".$aa." where pc_id=".$product_id;
	  
      $this->db->query($sql);
	  
     // echo $sql;
    }
    // ---------  增删改查基本操作 - 结束
    
    // ---------  审核相关操作 - 开始
    
//---------------所有idea操作

    
    //获取所有商品数量
    public function get_all_product_num(){
       
        $sql="SELECT * from `product_info` order by `pf_sort` desc";
        $result = $this->db->get_results($sql,ARRAY_A);
        return count($result);
    }
    //获取商品目录数量
	 public function get_all_category_num()
	 {
	 $strsql='select * from `product_category` ';
	 $result = $this->db->get_results($strsql,ARRAY_A);
        return count($result);
	 }
	 //获取部分商品目录
	 public function get_part_category($begin,$num)
	 {
	 $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT  `product_category`.* from `product_category` where 1  limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
        return $result;
	 }
   //获取部分商品
     public function get_part_product($begin,$num){
        
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `product_info`.*, `product_category`.`pc_name` from `product_info`,`product_category` where `product_info`.`pc_id`=`product_category`.`pc_id` order by `pf_sort` desc limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
        return $result;
    }
	//获取线上商品
	 public function get_status_product($begin,$num){
        
      $begin = $this->db->escape($begin);
      $num=$this->db->escape($num);
        $sql="SELECT `product_info`.*, `product_category`.`pc_name` from `product_info`,`product_category` where `product_info`.`pf_status`=\"正常\"  and `product_info`.`pc_id`=`product_category`.`pc_id` limit ".$begin.",".$num;
        $result = $this->db->get_results($sql,ARRAY_A);
       // $res = json_encode($result);
        return $result;
    }
    //验证是否重复
    public function check_is_unique($table_name,$arr_columns_value)
	{
	$table_name = $this->db->escape($table_name);
	 $keys=array_keys($arr_columns_value);
	  for($i=0;$i<count($keys);$i++)
	{
	   $arr_columns_value[$keys[$i]]=$this->db->escape($arr_columns_value[$keys[$i]]);
	}
	   $strsql='select * from `'.$table_name.'` ';
	    if (count($arr_columns_value)<=0)
	    {
	        return false;
	    }
	    else
	        {
			    $strsql=$strsql.'where ';
				$keys=array_keys($arr);
			    for($i=0;$i<count($arr_columns_value);$i++)
				{
				    if($i==0)
					{
					    $strsql=$strsql.'`'.$keys[$i].'`='.$arr_columns_value[$keys[$i]].' ';
					}
					else
					{
					     $strsql=$strsql.' and `'.$keys[$i].'`='.$arr_columns_value[$keys[$i]].' ';
					}
				}
	        }
			
		$result=$this->db->get_results($sql,ARRAY_A);
		return count($result);
	}
   

   
     

    //
}
