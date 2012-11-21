<?php


class PostModel {
    /*
     * 
     */

    public static function getById($post_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT *,UNIX_TIMESTAMP(post_publicationDate) as post_publicationDate FROM tbl_post WHERE post_id= ?";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $post_id);
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
        $conn= null;
        return $results;
    }
    public static function getAllPosts($page=1,$numberPostPerPage=10,$order="post_id DESC") {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql1 = "SELECT *,UNIX_TIMESTAMP(post_publicationDate) as post_publicationDate FROM tbl_post ORDER BY ".mysql_escape_string($order)." LIMIT ".($page-1)*$numberPostPerPage.",".$numberPostPerPage;
        $st = $conn->prepare($sql1);
        $st->execute();
        $list = array();
        while ($row = $st->fetch()) {         
            $list[] = $row;
        }
        $conn = null;
        return ( array("results" => $list) );
    }

    /*
     * 
     */

    public static function insert(Post $post) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO tbl_post(post_id, post_publicationDate, post_visitCount, product_id, post_uid) 
            VALUES (?, FROM_UNIXTIME(?), ?, ?, ?)";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $post->getPost_id());
        $st->bindValue(2, $post->getPost_publicationDate());
        $st->bindValue(3, $post->getPost_visiCount());
        $st->bindValue(4, $post->getProduct_id());
        $st->bindValue(5, $post->getPost_uid());
        $result = $st->execute();
        $conn = null;
        return $result;
    }
    /*
     * 
     */

    public static function delete($post_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_post WHERE post_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $post_id);
        $st->execute();
        $conn = null;
    }

}

?>
