<?php

require_once 'config.php';

$con = mysql_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD);
if (!$con){
    die('Could not connect: ' . mysql_error());
}

if (mysql_query("DROP DATABASE ".DATABASE_NAME,$con)){
    echo "Database deleted<br/>";
}else{
    die( "Error deleting database: " . mysql_error() );
}

