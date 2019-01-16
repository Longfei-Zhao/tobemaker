<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/****************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";

 class class_Db
{
    private static $Singleton;
    
    public static function GetInstance(){
        if (!(self::$Singleton instanceof self)){
            self::$Singleton = new self();
        }
        return self::$Singleton;
    }
    
    private function __clone() {}
    
    public $db;
        
    private function __construct(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES UTF8");
    }
    
    function __destruct() {
       $this->db->disconnect();
    }
    
    /*
     * sample:
     * 
     *   $data = array(
     *        'group_id' => '1'
     *        'action_name' => 'edit'
     *   );
     * 
     *   $class_db = class_Db::GetInstance();
     *   $class_db->insert_array('group_auth',$data);
     * 
     */
    function insert_array($table, $data, $override = array()){
        // 合并数组，后者覆盖前者
        $data = array_merge($data, $override);
        
        // 表名转义
        $table = $this->db->escape($table);
        
        // 构造字段名字符串
        $keys = array_keys($data);
        $keys = array_map(array($this->db, 'escape' ), $keys);
        $keys_string = "(`".implode('`,`', $keys)."`)";
        
        // 构造值字符串
        $data = array_map(array($this->db, 'escape' ), $data);
        $values_string = "values ('".implode("','", $data)."')";
        
        $sql = "insert into `$table` $keys_string $values_string";
        
        return $this->db->query($sql);
    }
    
    /*
     * sample:
     * 
     *   $data = array(
     *        'action_name' => 'edit'
     *   );
     * 
     *   $class_db = class_Db::GetInstance();
     *   $class_db->update_array('group_auth',$data, '`auth_id` = 5');
     * 
     */
    function update_array($table, $data, $condition){
        // 表名转义
        $table = $this->db->escape($table);
        
        $set_string = '';
        
        foreach($data as $key => $val){
            $key = $this->db->escape($key);
            $val = $this->db->escape($val);
            
            $set_string .= " `$key` = '$val',";
        }
        $set_string = rtrim($set_string, ',');
        
        $sql = "update `$table` set $set_string where $condition";
        
        return $this->db->query($sql);
    }
    
    function select2($sql, $orderby ='', $desc = 1, $start = 0, $length = 0){
        
        if ($orderby != ''){
            $sql = $sql . " order by $orderby ";
            $sql = $sql . ($desc == 1 ? 'DESC' : 'ASC') . " ";
        }
        if ($length != 0){
            $sql = $sql . "limit $start, $length";
        }
        
        return $this->db->get_results($sql, ARRAY_A);
    }
    
}