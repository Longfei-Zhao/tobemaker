<?php if ( ! defined('ROOT_PATH')) exit('No direct script access allowed');

/****************************************************************
*  ezSQL initialisation for mySQL
*/
require_once("qiniu/rs.php");
require_once("qiniu/auth_digest.php");
require_once("qiniu/io.php");
require_once("qiniu/http.php");

class class_qiniu{
      public $accessKey = ACCESS_KEY;
      public $secretKey = SECRET_KEY;
      public $bucket = BUCKET;

    function class_qiniu(){

     $accessKey = ACCESS_KEY;
     $secretKey = SECRET_KEY;
     $bucket = BUCKET;
     Qiniu_SetKeys($this->accessKey, $this->secretKey);
    }


    //拿上传token

    public function get_token_to_upload_idea(){
    	$putPolicy = new Qiniu_RS_PutPolicy($this->bucket);
        $putPolicy->deadline=1800;
        $putPolicy->FsizeLimit=2000000;
        $putPolicy->mineLimit="image/jpeg;image/png";
        $upToken = $putPolicy->Token(null);
        return $upToken;
    }
   
    public function get_token_to_upload_head(){
    	
        $putPolicy = new Qiniu_RS_PutPolicy($this->bucket);
        $putPolicy->deadline=1800;
        $putPolicy->FsizeLimit=2000000;
        $putPolicy->mineLimit="image/jpeg;image/png";
        $upToken = $putPolicy->Token(null);
        return $upToken;
    }
    //移动
    public function move($file1,$file2){
        Qiniu_SetKeys($this->accessKey, $this->secretKey);
        $client = new Qiniu_MacHttpClient(null);
        $err = Qiniu_RS_Move($client, $this->bucket, $file1, $this->bucket, $file2);
        if ($err !== null) {
            var_dump($err);
            return $err;
        } else {
           // echo "Success!";
            return "move ok";
        }
    }
    //复制
    public function copy($file1,$file2){
        Qiniu_SetKeys($this->accessKey, $this->secretKey);
        $client = new Qiniu_MacHttpClient(null);
        $err = Qiniu_RS_Copy($client, $this->bucket, $file1, $this->bucket, $file2);

        if ($err !== null) {
            var_dump($err);
            return $err;
        } else {
           // echo "Success!";
            return "copy ok";
        }
    }
}