<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsergroupModel
 *
 * @author Quang Tuan
 */
class UsergroupModel {
    /*
     * 
     */

    public static function getById($usergroup_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_usergroup WHERE usergroup_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $usergroup_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }

    /*
     * 
     */

    public static function getByUsergroupname($usergroup_name) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_usergroup WHERE usergroup_name= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $usergroup_usergroupname);
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
    /*
     * 
     */

    public static function getUsergroupIdMax() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT max(usergroup_id) FROM tbl_usergroup";
        $st = $conn->prepare($sql);
        $st->execute();
        $row = $st->fetch();
        $results = $row['max(usergroup_id)'];
        $conn= null;
        return $results;
    }
    public static function getAllUsergroups() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql1 = "SELECT * FROM tbl_usergroup";
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

    public static function insert(Usergroup $usergroup) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO tbl_usergroup(usergroup_name, usergroup_description) 
            VALUES (?, ?)";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $usergroup->usergroup_name);
        $st->bindParam(2, $usergroup->usergroup_description);
        $result = $st->execute();
        $conn = null;
        return $result;
    }

    /*
     * 
     */

    public static function update($usergroup_id, Usergroup $usergroup) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "UPDATE tbl_usergroup SET usergroup_name= ?, usergroup_description= ?
             WHERE usergroup_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $usergroup->getUsergroup_name());
        $st->bindParam(2, $usergroup->getUsergroup_description());
        $st->bindParam(3, $usergroup_id);
        $st->execute();
        $conn = null;
    }
    /*
     * 
     */

    public static function delete($usergroup_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_usergroup WHERE usergroup_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $usergroup_id);
        $st->execute();
        $conn = null;
    }

}

?>
