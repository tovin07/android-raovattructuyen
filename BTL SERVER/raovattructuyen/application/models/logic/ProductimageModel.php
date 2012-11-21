<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductimageModel
 *
 * @author Quang Tuan
 */
class ProductimageModel {
    /*
     * 
     */

    public static function getById($productimage_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_productimage WHERE productimage_id= ?";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $productimage_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }
    public static function getByProductId($product_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_productimage WHERE product_id= ?";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $product_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }
    /*
     * 
     */



    public static function insert(Productimage $productimage) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "INSERT INTO tbl_productimage(productimage_link, productimage_thumb, product_id) 
            VALUES (?, ?, ?)";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $productimage->getProductimage_link());
        $st->bindValue(2, $productimage->getProductimage_thumb());
        $st->bindValue(3, $productimage->getProduct_id());
        $result = $st->execute();
        $conn = null;
        return $result;
    }

    /*
     * 
     */

    public static function delete($productimage_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_productimage WHERE productimage_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $productimage_id);
        $st->execute();
        $conn = null;
    }
    
    public static function deleteByProductId($product_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_productimage WHERE product_id= ?";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $product_id);
        $st->execute();
        $conn = null;
    }

}

?>
