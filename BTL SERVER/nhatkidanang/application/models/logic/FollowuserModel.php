<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FollowuserModel
 *
 * @author Quang Tuan
 */
class FollowuserModel {
    /*
     * 
     */

    public static function getById($userfollow_id, $userfollowed_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_followuser WHERE userfollow_id= ? and userfollowed_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $userfollow_id);
        $st->bindParam(2, $userfollowed_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }

    public static function getFollowuserIdMax() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT max(followuserfollowed_id) FROM tbl_followuser";
        $st = $conn->prepare($sql);
        $st->execute();
        $row = $st->fetch();
        $results = $row['max(followuserfollowed_id)'];
        $conn= null;
        return $results;
    }
    public static function getAllFollowusers() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql1 = "SELECT * FROM tbl_followuser";
        $st = $conn->prepare($sql1);
        $st->execute();
        $list = array();
        while ($row = $st->fetch()) {
            $list[] = $row;
        }
        $totalRows = $st->rowCount();
        $conn = null;
        return ( array("results" => $list, "totalRows" => $totalRows) );
    }

    /*
     * 
     */

    public static function insert(Followuser $followuser) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO tbl_followuser(userfollow_id, userfollowed_id) 
            VALUES (?, ?)";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $followuser->userfollow_id);
        $st->bindParam(2, $followuser->userfollowed_id);
        $result = $st->execute();
        $conn = null;
        return $result;
    }
    /*
     * 
     */

    public static function delete($userfollow_id, $userfollowed_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_followuser WHERE userfollow_id= ? and userfollowed_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $userfollow_id);
        $st->bindParam(2, $userfollowed_id);
        $st->execute();
        $conn = null;
    }

}

?>
