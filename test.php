<?php

include_once 'config.php';
include_once ROOT_PATH."class/class_idea.php";
include_once ROOT_PATH."class/class_qiniu.php";

$qiniu=new class_qiniu();
$file2='1234.png';
$file1='23456.png';
$res=$qiniu->move($file1,$file2);
var_dump($res);
?>
