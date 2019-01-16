<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/**********************************************************************
*  ezSQL initialisation for mySQL
*/
include_once ROOT_PATH."include/ez_sql_core.php";
include_once ROOT_PATH."include/ez_sql_mysql.php";

class class_ad
{
    private $db = null;

    function class_ad(){
        
        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER,DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
    }

    // select advertise list
    public function get_show_list($max_num=10){
        
        $result = $this->db->get_results("SELECT * FROM ".TABLENAME_AD." WHERE `ad_show` = 1 ORDER BY `create_datetime` DESC LIMIT "
                .intval($max_num), ARRAY_A);
        
        return $result;
    }
    
    public function get_hide_list($max_num=100){
        
        $result = $this->db->get_results("SELECT * FROM ".TABLENAME_AD." WHERE `ad_show` != 1 ORDER BY `create_datetime` DESC LIMIT "
                .intval($max_num), ARRAY_A);
        
        return $result;
    }
    
    // add
    private function add_new_one($img_url, $link, $ad_show = '1'){
        
        $img_url = ($img_url === null) ? 'NULL' : $this->db->escape($img_url);
        $link = ($link === null) ? 'NULL' : $this->db->escape($link);
        $ad_show = ($ad_show === null) ? '1' : $this->db->escape($ad_show);
        
        $result = $this->db->query("INSERT INTO ".TABLENAME_AD." (`img_url`, `link`, `ad_show`) VALUES ('$img_url', '$link', $ad_show) ");
//        $this->db->debug();
        return $result;
    }
    
    public function add_new($data){
        
        if (!is_array($data)){
            // ERROR: Need to be data array
            return false;
        }
        
        $data_array = array();
        
        if (!@is_array($data[0])){
            // only one item
            $data_array[0] = $data;
        }else{
            $data_array = $data;
        }
        
        foreach ($data_array as $item ){
            
            if (array_key_exists('ad_show', $item)){
                assert($this->add_new_one(@$item['img_url'], @$item['link'], @$item['ad_show']) );
            }else{
                assert($this->add_new_one(@$item['img_url'], @$item['link'] ) );
            }
        }
        
        // can not process array
        return true;
        
    }
    
    // delete
    private function delete_one($id){
        $id = $this->db->escape($id);
        
        return $this->db->query("DELETE FROM ".TABLENAME_AD." WHERE `id` = $id");
    }
    
    public function delete($id){
        
        if (is_array($id))
            return false;
        
        return $this->delete_one($id);
        
    }
    
    // update
    private function modify_one($id, $img_url, $link, $ad_show){
        
        $img_url = ($img_url === null) ? 'NULL' : $this->db->escape($img_url);
        $link = ($link === null) ? 'NULL' : $this->db->escape($link);
        $ad_show = ($ad_show === null) ? '1' : $this->db->escape($ad_show);
        
        return $this->db->query("UPDATE ".TABLENAME_AD." SET `img_url` = '$img_url', `link` = '$link', `ad_show` = $ad_show WHERE `id` = $id");
    }
    
    public function modify($id, $img_url, $link, $ad_show){
        
        return $this->modify_one($id, $img_url, $link, $ad_show);
    }

}