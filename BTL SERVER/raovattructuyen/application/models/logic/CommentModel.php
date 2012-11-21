<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentModel
 *
 * @author Quang Tuan
 */
class CommentModel {
    /*
     * 
     */

    public static function getById($comment_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_comment WHERE comment_id= ?";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $comment_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }

    public static function getCommentIdMax() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT max(comment_id) FROM tbl_comment";
        $st = $conn->prepare($sql);
        $st->execute();
        $row = $st->fetch();
        $results = $row['max(comment_id)'];
        $conn= null;
        return $results;
    }
    public static function getAllComments() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql1 = "SELECT * FROM tbl_comment";
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
    
    public static function getAllCommentsByProductId($product_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql1 = "SELECT user.user_username,cmt.comment_content, cmt.comment_publicationDate FROM tbl_comment as cmt, tbl_user as user where user.user_id= cmt.user_id and cmt.product_id= ?";
        $st = $conn->prepare($sql1);
        $st->bindValue(1, $product_id);
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

    public static function insert(Comment $comment) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO tbl_comment(comment_content, comment_publicationDate, product_id, user_id) 
            VALUES (?, FROM_UNIXTIME(?), ?, ?)";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $comment->getComment_content());
        $st->bindValue(2, $comment->getComment_publicationDate());
        $st->bindValue(3, $comment->getProduct_id());
        $st->bindValue(4, $comment->getUser_id());
        $result = $st->execute();
        $conn = null;
        return $result;
    }
    /*
     * 
     */

    public static function delete($comment_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_comment WHERE comment_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $comment_id);
        $st->execute();
        $conn = null;
    }

}

?>
