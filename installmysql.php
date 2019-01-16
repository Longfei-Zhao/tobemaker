<?php
   $sql="create table idea_info(
   	idea_id int not null primary key,
   	name varchar(60) not null,
   	key_word varchar(30),
   	brief text(200) not null,
   	content text(1000) not null,
   	user_id int  not null,
   	user_name varchar(20),
   	picture_url varchar(100),
   	vedio_url varchar(100),
   	creat_time datetime,
   	begin_time datetime,
   	end_time datetime,
   	idea_status int,
   	success_time datetime,
   	price double(6,2),
   	sun_comment int,
   	sum_like int,
   	sum_attention int,
   	sum_view int,
   	sum_buy int,
   	group_id int,
   	is_recommend tinyint default 0
   	)ENGINE=InDB DEFAULT CHARSET=utf8";

   $sql="create table idea_manage(
	manage_id int not null auto_increment primary key,
	idea_id int not null,
	idea_status int ,
	reason text ,
	admin_id int,
	comment_time datetime,
	last_change_time datetime
	)ENGINE=InDB DEFAULT CHARSET=utf8";

$sql="create table user_info(
	user_id int not null auto_increment primary key,
	user_name varchar(30),
	ture_name varchar(30),
	user_email varchar(30),
	user_mobile varchar(30),
	user_passcode varchar(40),
	sex varchar(10),
	user_group varchar(20) default 'normal',
	register_time datetime,
	last_login_time datetime,
	login_ip varchar(30),
	num_surpport int default 0,
	num_attention int default 0,
	num_share int default 0,
	money double(6,2),
	age int,
	birth date,
	head_pic_url varchar(100),
	self_intro text(500),
	description text(2000),
	occupation varchar(30)
	)ENGINE=InDB DEFAULT CHARSET=utf8";

$sql="create table idea_status(
	status_id int,
	status_name varchar(20)
	)ENGINE=InDB DEFAULT CHARSET=utf8";












$sql="create table idea_recommend(
	idea_id int,
	idea_name varchar(60),
	recommned_sort int,
	recommend_reason text(200),
	recommend_time datetime
	)ENGINE=InDB DEFAULT CHARSET=utf8";

$sql="create table idea_like(
	idea_id int,
	idea_name varchar(60),
	liker_id int,
	like_time datetime,
	like_ip varchar(20)
	)ENGINE=InDB DEFAULT CHARSET=utf8";










$sql="create table idea_share(
	idea_id int,
	idea_name varchar(60),
	share_user_id int,
	like_time datetime,
	like_table varchar(20)
	)ENGINE=InDB DEFAULT CHARSET=utf8";



$sql="create table idea_comment(
    idea_id int,
    commentator_id int,
    context text,
    is_close int,
    commnet_time datetime,
    pic_url varchar(100)
    )ENGINE=InDB DEFAULT CHARSET=utf8";







?>