<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserModel
 *
 * @author Quang Tuan
 */
class UserModel {
    /*
     * 
     */

    public static function getById($user_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_user WHERE user_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $user_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }

    /*
     * 
     */

    public static function getByUsername($user_username) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_user WHERE user_username= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $user_username);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }

    /*
     * 
     */
    /*
     * 
     */

    public static function checkUsername($user_username) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT count(user_id) FROM tbl_user WHERE user_username= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $user_username);
        $st->execute();
        $row = $st->fetch();
        $results = $row['count(user_id)'];
        $conn= null;
        return $results;
    }
    
    public static function checkLogin($user_username, $user_password) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT count(user_id) FROM tbl_user WHERE user_username= ? and user_password= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $user_username);
        $st->bindParam(1, $user_password);
        $st->execute();
        $row = $st->fetch();
        $results = $row['count(user_id)'];
        $conn= null;
        return $results;
    }

    
    /*
     * 
     */

    public static function getUserIdMax() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT max(user_id) FROM tbl_user";
        $st = $conn->prepare($sql);
        $st->execute();
        $row = $st->fetch();
        $results = $row['max(user_id)'];
        $conn= null;
        return $results;
    }
    public static function getAllUsers() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql1 = "SELECT * FROM tbl_user";
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

    public static function insert(User $user) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO tbl_user(user_username, user_password, user_email, user_fullname, user_address, user_tel, user_avatar, user_taikhoan, user_point, user_status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $user->username);
        $st->bindParam(2, $user->password);
        $st->bindParam(3, $user->email);
        $st->bindParam(4, $user->fullname);
        $st->bindParam(5, $user->address);
        $st->bindParam(6, $user->tel);
        $st->bindParam(7, $user->avatar);
        $st->bindParam(8, $user->taikhoan);
        $st->bindParam(9, $user->point);
        $st->bindParam(10, $user->status);
        $result = $st->execute();
        $conn = null;
        return $result;
    }

    /*
     * 
     */

    public static function update($user_id, User $user) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "UPDATE tbl_user SET user_name= ?, user_priceOld= ?, user_priceNew= ?,   
            user_content= ?, user_publicationDate= FROM_UNIXTIME(?), category_id= ?, 
            user_avatar= ?, user_nameX= ?, user_titleDisplay= ?, 
            user_visitCount= ?, user_tagDescription= ?, user_tagKeywords= ?, user_link= ?, user_rate= ?        
             WHERE user_id= ?";
        $st = $conn->prepare($sql);
        $st->execute();
        $conn = null;
    }
    
    public static function deactive($user_username){
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "UPDATE tbl_user SET user_status= 0        
             WHERE user_username= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $user_username);
        $st->execute();
        $conn = null;
    }

    /*
     * 
     */

    public static function delete($user_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_user WHERE user_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $user_id);
        $st->execute();
        $conn = null;
    }

}

?>
