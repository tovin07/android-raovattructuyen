<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FollowpostModel
 *
 * @author Quang Tuan
 */
class FollowpostModel {
    /*
     * 
     */

    public static function getById($post_id, $user_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_followpost WHERE post_id= ? and user_id= ?";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $post_id);
        $st->bindValue(2, $user_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }

    public static function getFollowpostIdMax() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT max(followpost_id) FROM tbl_followpost";
        $st = $conn->prepare($sql);
        $st->execute();
        $row = $st->fetch();
        $results = $row['max(followpost_id)'];
        $conn= null;
        return $results;
    }
    public static function getAllFollowposts() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql1 = "SELECT * FROM tbl_followpost";
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

    public static function insert(Followpost $followpost) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO tbl_followpost(post_id, user_id) 
            VALUES (?, ?)";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $followpost->getPost_id());
        $st->bindValue(2, $followpost->getUser_id());
        $result = $st->execute();
        $conn = null;
        return $result;
    }
    /*
     * 
     */

    public static function delete($post_id, $user_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_followpost WHERE post_id= ? and user_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $post_id);
        $st->bindValue(2, $user_id);
        $st->execute();
        $conn = null;
    }

}

?>
