<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostimageModel
 *
 * @author Quang Tuan
 */
class PostimageModel {
    /*
     * 
     */

    public static function getById($postimage_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_postimage WHERE postimage_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $postimage_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }
    public static function getByPostId($post_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_postimage WHERE post_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $post_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }
    /*
     * 
     */



    public static function insert(Postimage $postimage) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO tbl_postimage(postimage_link, postimage_thumb, post_id, postimage_type) 
            VALUES (?, ?, ?, ?)";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $postimage->postimage_link);
        $st->bindParam(2, $postimage->postimage_thumb);
        $st->bindParam(3, $postimage->post_id);
        $st->bindParam(4, $postimage->postimage_type);
        $result = $st->execute();
        $conn = null;
        return $result;
    }

    /*
     * 
     */

    public static function delete($postimage_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_postimage WHERE postimage_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $postimage_id);
        $st->execute();
        $conn = null;
    }
    
    public static function deleteByPostId($post_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_postimage WHERE post_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $post_id);
        $st->execute();
        $conn = null;
    }

}

?>
