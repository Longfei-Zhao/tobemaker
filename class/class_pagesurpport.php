<?php
/********************************************* 
类名： PageSupport
功能：分页显示MySQL数据库中的数据 
***********************************************/ 
class PageSupport{ 
    //属性
    var $sql;                    //所要显示数据的SQL查询语句 
    var $page_size;                //每页显示最多行数 
    
    var $start_index;            //所要显示记录的首行序号
    var $total_records;            //记录总数 
    var $current_records;        //本页读取的记录数 
    var $result;                //读出的结果 
    
    var $total_pages;            //总页数  
    var $current_page;            //当前页数
    var $display_count = 30;     //显示的前几页和后几页数

    var $arr_page_query;        //数组，包含分页显示需要传递的参数 

    var $first;
    var $prev;
    var $next;
    var $last;
    
    //方法
/********************************************* 
构造函数：__construct()
输入参数：            
        $ppage_size：每页显示最多行数    
***********************************************/ 
 function PageSupport($ppage_size)
 { 
    $this->page_size=$ppage_size; 
    $this->start_index=0;
 } 


/********************************************* 
构造函数：__destruct()
输入参数：            
***********************************************/ 
 function __destruct()
 {
    
 }
        
/********************************************* 
get函数：__get()
***********************************************/ 
 function __get($property_name)
 {  
     if(isset($this->$property_name)) 
     { 
            return($this->$property_name); 
     } 
     else 
     { 
            return(NULL); 
     } 
 }
 
/********************************************* 
set函数：__set()
***********************************************/ 
 function __set($property_name, $value) 
 {     
    $this->$property_name = $value; 
 } 

/********************************************* 
函数名：read_data
功能：    根据SQL查询语句从表中读取相应的记录
返回值：属性二维数组result[记录号][字段名]
***********************************************/ 
 function read_data()
 { 
    $psql=$this->sql; 

    //查询数据，数据库链接等信息应在类调用的外部实现
    $result=mysql_query($psql) or die(mysql_error());

    $this->total_records=mysql_num_rows($result); 
    //利用LIMIT关键字获取本页所要显示的记录
    if($this->total_records>0) 
    {
        $this->start_index = ($this->current_page-1)*$this->page_size;
        $psql=$psql." LIMIT ".$this->start_index." , ".$this->page_size; 
        $result=mysql_query($psql) or die(mysql_error()); 

        $this->current_records=mysql_num_rows($result); 
        //将查询结果放在result数组中
        $i=0; 
        while($row=mysql_fetch_Array($result))
        { 
            $this->result[$i]=$row; 
            $i++; 
        } 
    }

    
    //获取总页数、当前页信息
    $this->total_pages=ceil($this->total_records/$this->page_size);  

    $this->first=1;
    $this->prev=$this->current_page-1;
    $this->next=$this->current_page+1;
    $this->last=$this->total_pages;
 }

 /********************************************* 
函数名：standard_navigate()
功能：    显示首页、下页、上页、未页
***********************************************/ 
 function standard_navigate() 
 {    
    echo "<div align=center>";
    echo "<form action=".$_SERVER['PHP_SELF']." method=\"get\">";
    
    echo "<font color = red size ='4'>第".$this->current_page."页/共".$this->total_pages."页</font>"; 
    echo "    ";
    
    echo "跳到<input type=\"text\" size=\Ř\" name=\"current_page\" value='".$this->current_page."'/>页";
    echo "<input type=\"submit\" value=\"提交\"/>";
    

    //生成导航链接
    if ($this->current_page > 1) {
      echo "<A href=".$_SERVER['PHP_SELF']."?current_page=".$this->first.">首页</A>|"; 
      echo "<A href=".$_SERVER['PHP_SELF']."?current_page=".$this->prev.">上一页</A>|"; 
    }

    if( $this->current_page < $this->total_pages) {
      echo "<A href=".$_SERVER['PHP_SELF']."?current_page=".$this->next.">下一页</A>|";
      echo "<A href=".$_SERVER['PHP_SELF']."?current_page=".$this->last.">末页</A>"; 
    }
    
    echo "</form>";    
    echo "</div>";

 } 
 
  /********************************************* 
函数名：full_navigate()
功能：    显示首页、下页、上页、未页  
生成导航链接 如1 2 3 ... 10 11
***********************************************/ 
 function full_navigate() 
 {    
    echo "<div align=center>";
    echo "<form action=".$_SERVER['PHP_SELF']." method=\"get\">";
    
    echo "<font color = red size ='4'>第".$this->current_page."页/共".$this->total_pages."页</font>"; 
    echo "    ";
    
    echo "跳到<input type=\"text\" size=\Ř\" name=\"current_page\" value='".$this->current_page."'/>页";
    echo "<input type=\"submit\" value=\"提交\"/>";
    
    //生成导航链接 如1 2 3 ... 10 11
    $front_start = 1;
    if($this->current_page > $this->display_count){
        $front_start = $this->current_page - $this->display_count;
    }
    for($i=$front_start;$i<$this->current_page;$i++){
        echo "<a href=".$_SERVER['PHP_SELF']."?page=".$i.">[".$i ."]</a> ";    
    }

    echo "[".$this->current_page."]";

    $displayCount = $this->display_count;
    if($this->total_pages > $displayCount&&($this->current_page+$displayCount)<$this->total_pages){
        $displayCount = $this->current_page+$displayCount;
    }else{
        $displayCount = $this->total_pages;
    }

    for($i=$this->current_page+1;$i<=$displayCount;$i++){
        echo "<a href=".$_SERVER['PHP_SELF']."?current_page=".$i.">[".$i ."]</a> ";    
    }

    //生成导航链接
    if ($this->current_page > 1) {
      echo "<A href=".$_SERVER['PHP_SELF']."?current_page=".$this->first.">首页</A>|"; 
      echo "<A href=".$_SERVER['PHP_SELF']."?current_page=".$this->prev.">上一页</A>|"; 
    }

    if( $this->current_page < $this->total_pages) {
      echo "<A href=".$_SERVER['PHP_SELF']."?current_page=".$this->next.">下一页</A>|";
      echo "<A href=".$_SERVER['PHP_SELF']."?current_page=".$this->last.">末页</A>"; 
    }
    
    echo "</form>";    
    echo "</div>";

 } 
} 
?>
