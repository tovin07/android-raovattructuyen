<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryModel
 *
 * @author Quang Tuan
 */
class CategoryModel {
    /*
     * 
     */

    public static function getById($category_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_category WHERE category_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $category_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }

    /*
     * 
     */

    public static function getByCategoryname($category_name) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_category WHERE category_name= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $category_categoryname);
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

    public static function getCategoryIdMax() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT max(category_id) FROM tbl_category";
        $st = $conn->prepare($sql);
        $st->execute();
        $row = $st->fetch();
        $results = $row['max(category_id)'];
        $conn= null;
        return $results;
    }
    public static function getAllCategorys() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql1 = "SELECT * FROM tbl_category";
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

    public static function insert(Category $category) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO tbl_category(category_name, category_description) 
            VALUES (?, ?)";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $category->category_name);
        $st->bindParam(2, $category->category_description);
        $result = $st->execute();
        $conn = null;
        return $result;
    }

    /*
     * 
     */

    public static function update($category_id, Category $category) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "UPDATE tbl_category SET category_name= ?, category_description= ?
             WHERE category_id= ?";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $category->getCategory_name());
        $st->bindParam(2, $category->getCategory_description());
        $st->bindParam(3, $category_id);
        $st->execute();
        $conn = null;
    }
    /*
     * 
     */

    public static function delete($category_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_category WHERE category_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindParam(1, $category_id);
        $st->execute();
        $conn = null;
    }

}

?>
