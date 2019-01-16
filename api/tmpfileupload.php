<?php

include_once "../config.php";
include_once ROOT_PATH."class/class_file.php";
header("Content-type: text/html; charset=utf-8");
$file_instance = new class_file();

$url = $file_instance->save_as_tmp();
//echo $url;
//echo $url;
//$url=urlencode($url);
$data = array();
$data["url"] = $url;
//echo $data["url"];
if ($url == ""){
	//echo "nono";
    $data["err_msg"] = $file_instance->get_error_msg();
}

echo json_encode($data);