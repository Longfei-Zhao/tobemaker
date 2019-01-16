<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";
class class_file
{
    private $db = null;
    private $tmp_folder;
    private $file_folder;
    
    private $tmp_path;
    private $file_path;
    
    private $error_msg;
            
    function class_file(){
        
        $this->tmp_folder = "tmp/";
        $this->file_folder = "upload/";
        
        $this->tmp_path = ROOT_PATH . $this->tmp_folder;
        $this->file_path = ROOT_PATH . $this->file_folder;
        
        $this->error_msg = "";
		// Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES utf8");
    }
    
    // 保存文件为临时文件，用于用户预览上传的内容。
    // 临时文件夹下的文件定期删除。
    // 当正式提交表单时，调用$this->save()，将文件保存为持久文件。
    // 返回： 临时文件url地址
    function save_as_tmp(){
        if (!array_key_exists('file', $_FILES)){
            $this->error_msg = "系统错误：键不存在";
            return "";
        }
        
        if (
            (
                ($_FILES["file"]["type"] == "image/gif") 
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/pjpeg")
                || ($_FILES["file"]["type"] == "image/png")
                || ($_FILES["file"]["type"] == "image/jpg")
            )
            && 
            (
                // 文件小于 1 MB
                $_FILES["file"]["size"] < 1048576)
            )
        {
            if ($_FILES["file"]["error"] > 0){
                // 上传文件失败
                $this->error_msg = "上传失败，错误代码：". $_FILES["file"]["error"] . "";
		return "";
            }else{
                // 上传成功，转存文件
                
                $savename = $this->gen_filename($_FILES["file"]["name"]);
                
                if (file_exists($this->tmp_path . $savename)){
                    $this->error_msg = "文件已存在";
                }else{
                    copy($_FILES["file"]["tmp_name"],
                            $this->tmp_path . $savename);
                    return BASE_URL . $this->tmp_folder . $savename;
                }
                
            }
        }else{
            $this->error_msg = "文件格式错误或文件大于1MB";
	    return "";
        }
    }
    
    // 保存文件为持久文件
    // 返回持久url地址
    function save($url){
	$url = $this->db->escape($url);
        $url_array = explode("/", $url);
        
        $filename = end($url_array);
        
        $result=copy($this->tmp_path . $filename,
                $this->file_path . $filename);
        if($result)
		{
		unlink($this->tmp_path . $filename);
		}
        return BASE_URL . $this->file_folder . $filename;
        
    }
    
    function gen_filename($filename){
	$filename = $this->db->escape($filename);
        $name_array = explode(".", $filename);
        
        $name = $name_array[0];
        $ext = $name_array[1];
        
        $new_name =substr(md5($name),2,10) . rand(1,10000);

        return $new_name . '.' . $ext;
    }
    
    function get_error_msg(){
        return $this->error_msg;
    }
    
}
