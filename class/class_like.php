<?php

if (!defined('ROOT_PATH'))
    exit('No direct script access allowed');

/* * ********************************************************************
 *  ezSQL initialisation for mySQL
 */
include_once ROOT_PATH . "include/ez_sql_core.php";
include_once ROOT_PATH . "include/ez_sql_mysql.php";

class class_like {

    private $db = null;

    function class_like() {

        // Initialise database object and establish a connection
        // at the same time - db_user / db_password / db_name / db_host
        $this->db = new ezSQL_mysql(DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME, DATABASE_HOST);
        $this->db->query("SET NAMES 'UTF8'");
    }

    //获取喜欢数目
    function get_like_num($idea_id) {
        $idea_id = $this->db->escape($idea_id);
        $sql = "select * from idea_like where `idea_id`=" . $idea_id . " and `like_type`=0";
        return count($this->db->get_results($sql));
    }

    function get_like_info($idea_id, $user_id = null) {

        $idea_id = $this->db->escape($idea_id);
        $user_id = $this->db->escape($user_id);
        $sql = "select * from idea_like where `idea_id`=" . $idea_id . " and `liker_id`=" . $user_id . " and `like_type`=0";
        // 有过点赞记录直接返回
        if (count($this->db->get_results($sql)) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    //获取想买记录
    function get_wantbuy_info($idea_id, $user_id) {
        $idea_id = $this->db->escape($idea_id);
        $user_id = $this->db->escape($user_id);
        $sql = "select * from `idea_like` where `idea_id`=" . $idea_id . " and `liker_id`=" . $user_id . " and `like_type`=1";
        $result = $this->db->get_results($sql, ARRAY_A);
        //return $result;
        // 有过点赞记录直接返回
        if (count($result) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

//---------添加想买记录
    public function add_buy($idea_id, $user_id) {
        $idea_id = $this->db->escape($idea_id);
        $user_id = $this->db->escape($user_id);
        $tmp = $this->db->get_results("SELECT * FROM idea_info WHERE `idea_id` = " . $idea_id, ARRAY_A);
        $idea_name = $tmp[0]["name"];
        $sql = "insert into `idea_like`(`idea_id`,`liker_id`,idea_name,`like_time`,`like_type`) values (" . $idea_id . "," . $user_id . ",\"" . $idea_name . "\", now(),1)";
        $this->db->query($sql);
        $sql = "update `idea_info` set `sum_like`=`sum_like`+1 where `idea_id`=" . $idea_id;
        $this->db->query($sql);
        return 1;
    }

    ///----------增加点赞记录
    public function add_like($idea_id, $user_id = null) {
        //先查询是是否有点赞记录，如果有则直接返回true
        //如果没有 修改两张表  idea_like——点赞关系表 和 和idea_info中的sum_like字段
        $idea_id = $this->db->escape($idea_id);
        $user_id = $this->db->escape($user_id);

        $tmp = $this->db->get_results("SELECT * FROM idea_info WHERE `idea_id` = " . $idea_id, ARRAY_A);
        $idea_name = $tmp[0]["name"];
        $sql = "insert into `idea_like`(`idea_id`,`liker_id`,`idea_name`,`like_time`) values (" . $idea_id . "," . $user_id . ",\"" . $idea_name . "\", now())";

        $this->db->query($sql);
        $sql = "update `idea_info` set `sum_like`=`sum_like`+1 where `idea_id`=" . $idea_id;
        $this->db->query($sql);
        $this->check_to_change_produce($idea_id);
        return 1;
    }

    // 取消点赞  （暂时没有用到）
    public function delet_like($idea_id, $user_id) {
        //先查询是是否有点赞记录，如果有则直接返回true
        //如果没有 修改两张表  idea_like——点赞关系表 和 和idea_info中的sum_like字段
        $idea_id = $this->db->escape($idea_id);
        $user_id = $this->db->escape($user_id);
        $sql = "select * from `idea_like` where `idea_id`=" . $idea_id . " and `liker_id`=" . $user_id . " and `like_type`=0";
        // 没有过点赞记录直接返回
        if (count($this->db->get_results($sql)) == 0) {
            return true;
        }
        //取消点赞
        else {
            $tmp = $this->db->get_results("SELECT * FROM `idea_info` WHERE `idea_id` = " . $idea_id, ARRAY_A);
            $idea_name = $tmp[0]["name"];
            $sql = "delete  from `idea_like` where `idea_id`=" . $idea_id . " and `liker_id`=" . $user_id . " and `like_type`=0";
            $this->db->query($sql);
            $sql = "update `idea_info` set `sum_like`=`sum_like`-1 where `idea_id`=" . $idea_id;
            $this->db->query($sql);
            return true;
        }
    }

    //取消超想买
    public function delet_buy($idea_id, $user_id) {
        //先查询是是否有点赞记录，如果有则直接返回true
        //如果没有 修改两张表  idea_like——点赞关系表 和 和idea_info中的sum_like字段
        $idea_id = $this->db->escape($idea_id);
        $user_id = $this->db->escape($user_id);
        $sql = "select * from `idea_like` where `idea_id`=" . $idea_id . " and `liker_id`=" . $user_id . " and `like_type`=1";
        // 没有过点赞记录直接返回
        if (count($this->db->get_results($sql)) == 0) {
            return true;
        }
        //取消点赞
        else {
            $tmp = $this->db->get_results("SELECT * FROM `idea_info` WHERE `idea_id` = " . $idea_id, ARRAY_A);
            $idea_name = $tmp[0]["name"];
            $sql = "delete  from `idea_like` where `idea_id`=" . $idea_id . " and `liker_id`=" . $user_id . " and `like_type`=1";
            $this->db->query($sql);
            $sql = "update `idea_info` set `sum_like`=`sum_like`-1 where `idea_id`=" . $idea_id;
            $this->db->query($sql);
            return true;
        }
    }

    //--------获取点赞数目
    public function get_sum_like($idea_id) {
        $idea_id = $this->db->escape($idea_id);
        $sql = "select `sum_like` from `idea_info` where `idea_id`=" . $idea_id;
        $result = $this->db->get_results($sql, ARRAY_A);
        if ($result[0]["sum_like"] > 0) {
            return $result[0]["sum_like"];
        } else {
            return 0;
        }
    }

    //--------获取超想买数目
    public function get_sum_buy($idea_id) {
        $idea_id = $this->db->escape($idea_id);
        $sql = "select `sum_like` from `idea_info` where `idea_id`=" . $idea_id;
        $result = $this->db->get_results($sql, ARRAY_A);
        if ($result[0]["sum_like"] > 0) {
            return $result[0]["sum_like"];
        } else {
            return 0;
        }
    }

    //积赞达到一定数量就待产
    public function check_to_change_produce($idea_id) {
        $idea_id = $this->db->escape($idea_id);
        $sum = $this->get_sum_like($idea_id);
        $sql = "SELECT * from idea_info where idea_id=" . $idea_id;
        $res = $this->db->get_results($sql, ARRAY_A);
        $limit = $res[0]["target"];
        $idea_status = $res[0]['idea_status'];
        //  积赞超过目标
        if ($sum >= $limit && intval($idea_status) == 4) {
            $sql = "UPDATE `idea_info` set `idea_status`=5 where `idea_id`=" . $idea_id;
            $this->db->query($sql);
            //超喜欢清零
            $sql = "update `idea_info` set `sum_like`=0 where `idea_id`=" . $idea_id;
            $this->db->query($sql);
        } else {
            return 0;
        }
    }

    public function check_buy_by_group($data, $user_id, $flag) {
        $i = 0;
        $tmp = count($data);
        while ($i < $tmp) {
            # code...
            if ($flag === 1) {
                $idea_id = $data[$i]['idea_id'];
                $check_like = $this->get_wantbuy_info($idea_id, $user_id);
                if ($check_like == 1) {
                    $data[$i]['likeit'] = 1;
                } else {
                    $data[$i]['likeit'] = 0;
                }
                $i++;
            } else {
                $data[$i]['likeit'] = 0;
                $i++;
            }
        }
        return $data;
    }

    public function check_like_by_group($data, $user_id, $flag) {
        $i = 0;
        $tmp = count($data);
        while ($i < $tmp) {
            # code...
            if ($flag === 1) {
                $idea_id = $data[$i]['idea_id'];
                $check_like = $this->get_like_info($idea_id, $user_id);
                if ($check_like == 1) {
                    $data[$i]['likeit'] = 1;
                } else {
                    $data[$i]['likeit'] = 0;
                }
                $i++;
            } else {
                $data[$i]['likeit'] = 0;
                $i++;
            }
        }
        return $data;
    }

    // 获取点赞详细信息
    public function get_like_detail($idea_id) 
    {
        $sql = "SELECT `idea_like`.* ,`user_info`.`user_name` from `idea_like`,`user_info` where `user_info`.`user_id`=`idea_like`.`liker_id` and `idea_like`.`idea_id`=" . $idea_id;
        $res = $this->db->get_results($sql, ARRAY_A);
        return $res;
    }
}
