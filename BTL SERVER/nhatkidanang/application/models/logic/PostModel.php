<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostModel
 *
 * @author Quang Tuan
 */
class PostModel {
    /*
     * 
     */

    public static function getById($post_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT *,UNIX_TIMESTAMP(post_publicationDate) as post_publicationDate FROM tbl_post WHERE post_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $post_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }

    public static function getPostIdMax() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT max(post_id) FROM tbl_post";
        $st = $conn->prepare($sql);
        $st->execute();
        $row = $st->fetch();
        $results = $row['max(post_id)'];
        $conn = null;
        return $results;
    }

    public static function getAllPosts() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql1 = "SELECT *,UNIX_TIMESTAMP(post_publicationDate) as post_publicationDate FROM tbl_post";
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

    public static function insert(Post $post) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO tbl_post(post_content, post_description, post_publicationDate, post_visiCount, weather_id) 
            VALUES (?, ?, FROM_UNIXTIME(?), ?, ?)";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $post->post_content);
        $st->bindParam(2, $post->post_description);
        $st->bindParam(3, $post->post_publicationDate);
        $st->bindParam(4, $post->post_visiCount);
        $st->bindParam(5, $post->weather_id);
        $result = $st->execute();
        $conn = null;
        return $result;
    }

    /*
     * 
     */

    public function update($post_id, Post $post) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "UPDATE tbl_post SET post_content= ?, post_description= ?, post_publicationDate= FROM_UNIXTIME(?), post_visiCount= ?, weather_id= ?  
             WHERE post_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $post->post_content);
        $st->bindParam(2, $post->post_description);
        $st->bindParam(3, $post->post_publicationDate);
        $st->bindParam(4, $post->post_visiCount);
        $st->bindParam(5, $post->weather_id);
        $st->bindParam(6, $post_id);
        $st->execute();
        $conn = null;
    }

    public static function delete($post_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_post WHERE post_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $post_id);
        $st->execute();
        $conn = null;
    }

}

?>
