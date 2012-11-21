<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotificationModel
 *
 * @author Quang Tuan
 */
class NotificationModel {
    /*
     * 
     */

    public static function getById($notification_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_notification WHERE notification_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $notification_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }

    public static function getNotificationIdMax() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT max(notification_id) FROM tbl_notification";
        $st = $conn->prepare($sql);
        $st->execute();
        $row = $st->fetch();
        $results = $row['max(notification_id)'];
        $conn= null;
        return $results;
    }
    public static function getAllNotifications() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql1 = "SELECT * FROM tbl_notification";
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

    public static function insert(Notification $notification) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO tbl_notification(notification_content, post_id, user_id) 
            VALUES (?, ?, ?)";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $notification->notification_content);
        $st->bindParam(2, $notification->post_id);
        $st->bindParam(3, $notification->user_id);
        $result = $st->execute();
        $conn = null;
        return $result;
    }
    /*
     * 
     */

    public static function delete($notification_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_notification WHERE notification_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $notification_id);
        $st->execute();
        $conn = null;
    }

}

?>
