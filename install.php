<?php

require_once 'config.php';

$con = mysql_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD);
if (!$con){
    die('Could not connect: ' . mysql_error());
}

if (mysql_query("CREATE DATABASE ".DATABASE_NAME." CHARSET=utf8",$con)){
    echo "Database created<br/>";
}else{
    die( "Error creating database: " . mysql_error() );
}

mysql_select_db(DATABASE_NAME, $con);

/* 
 * create tables
 */

// ad_img

$sql = "CREATE TABLE IF NOT EXISTS `".TABLENAME_AD."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_url` text NOT NULL,
  `link` text NOT NULL,
  `ad_show` int(11) NOT NULL DEFAULT '0',
  `create_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";

mysql_query($sql, $con);
echo "Table Created! - ". TABLENAME_AD. "<br/>";

//data
$sql = "INSERT INTO `".TABLENAME_AD."` (`id`, `img_url`, `link`, `ad_show`, `create_datetime`) VALUES
(1, 'images/1.jpg', 'http://www.baidu.com/', 1, '2014-06-16 12:59:42'),
(2, 'images/2.jpg', 'http://www.guokr.com/', 1, '2014-06-16 13:00:53'),
(3, 'images/3.jpg', 'http://www.douban.com/', 1, '2014-06-16 13:03:06'),
(4, 'images/1.jpg', 'http://www.zhihu.com/', 0, '2014-06-16 13:03:08');
";

mysql_query($sql, $con);
echo "Data Created! - ". TABLENAME_AD. "<br/>";

// user

$sql = "CREATE TABLE IF NOT EXISTS `".TABLENAME_USER."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
";

mysql_query($sql, $con);
echo "Table Created! - ". TABLENAME_USER. "<br/>";

//data
$sql = "INSERT INTO `".TABLENAME_USER."` (`id`, `username`, `password`, `create_datetime`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2014-06-16 06:52:03');";

mysql_query($sql, $con);
$sql="create table user_info(
    user_id int not null primary key,
    user_name varchar(20) not null,
    user_passcode varchar(40) not null,
    user_email varchar(20) not null,
    user_sex varchar(4),
    user_age int,
    user_birth date,
    user_img_url varchar(30),
    user_ture_name varchar(10),
    user_skill text(100),
    user_edu text(20),
    user_group varchar(10) default 'normal'
    )ENGINE=InnoDB  DEFAULT CHARSET=utf8";
    mysql_query($sql,$con);
echo "Data Created! - ". TABLENAME_USER. "<br/>";
        
// close database connection
mysql_close($con);
?>