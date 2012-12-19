<?php

class ProductModel {
    /*
     * 
     */

    public static function getById($product_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT * FROM tbl_product WHERE product_id= ?";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $product_id);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }

    public static function getCategoryName($product_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT category_name from tbl_product, tbl_category WHERE product_id= ? and tbl_product.category_id = tbl_category.category_id ";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $product_id);
        $st->execute();
        $row = $st->fetch();
        $result = $row['category_name'];
        $conn = null;
        return $result;
    }

    /*
     * 
     */

    public static function checkProductName($product_name) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT count(product_id) FROM tbl_product WHERE product_name= ?";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $name);
        $st->execute();
        $row = $st->fetch();
        $results = $row['count(product_id)'];
        $conn = null;
        return $results;
    }

    /*
     * 
     */

    public static function getProductIdMax() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT max(product_id) FROM tbl_product";
        $st = $conn->prepare($sql);
        $st->execute();
        $row = $st->fetch();
        $results = $row['max(product_id)'];
        $conn = null;
        return $results;
    }
    
    public static function getProductIdMaxById($id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT max(product_id) FROM tbl_product where user_id=?";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $id);
        $st->execute();
        $row = $st->fetch();
        $results = $row['max(product_id)'];
        $conn = null;
        return $results;
    }

    /*
     * 
     */

    public static function getAllProduct($page = 1, $numberProductPerPage = 10, $order = "product_id DESC") {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "SELECT count(product_id) FROM tbl_product ";
        $st = $conn->prepare($sql);
        $st->execute();
        $row = $st->fetch();
        $totalRows = $row['count(product_id)'];

        $sql1 = "SELECT * FROM tbl_product 
            ORDER BY " . mysql_real_escape_string($order) . " LIMIT " . ($page - 1) * $numberProductPerPage . "," . $numberProductPerPage;

        $st = $conn->prepare($sql1);

//        $start= ($page-1)*$numberProductPerPage;
//        $orderBy= mysql_real_escape_string($order);
//        $sql= "call getAllProduct($start, $numberProductPerPage, '$orderBy')";
        $st = $conn->prepare($sql1);
        $st->execute();
        $list = array();
        while ($row = $st->fetch()) {
            $list[] = $row;
        }
//        $sql1= "call totalProduct()";
//        $st= $conn->prepare($sql1);
//        $st->execute();
//        $row= $st->fetch();
//        $totalRows= $row['totalRows'];
        $conn = null;
        return ( array("results" => $list, "totalRows" => $totalRows) );
    }

    public static function getAllProductById($id = -1, $page = 1, $numberProductPerPage = 10, $order = "product_id DESC") {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql1 = "SELECT * FROM tbl_product where user_id = ? 
            ORDER BY " . mysql_real_escape_string($order) . " LIMIT " . ($page - 1) * $numberProductPerPage . "," . $numberProductPerPage;
        $st = $conn->prepare($sql1);
        $st->bindValue(1, $id);
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
      public static function getAllProducts() {
      $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      $sql1 = "SELECT *,UNIX_TIMESTAMP(post_publicationDate) as post_publicationDate FROM tbl_product
      ORDER BY product_publicationDate DESC";
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

     */

    public static function insert(Product $product) {
        try {
            $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $sql = "INSERT INTO tbl_product(product_id, product_name, product_avatar, product_description, user_id, post_publicationDate, post_visitCount, post_lon, post_lat) VALUES (?, ?, ?, ?, ?, FROM_UNIXTIME(?), ?, ?, ?)";

            $st = $conn->prepare($sql);
            $st->bindValue(1, $product->getProduct_id());
            $st->bindValue(2, $product->getProduct_name());
            $st->bindValue(3, $product->getProduct_avatar());
            $st->bindValue(4, $product->getProduct_description());
            $st->bindValue(5, $product->getUser_id());
            $st->bindValue(6, $product->getPost_publicationDate());
            $st->bindValue(7, 0);
            $st->bindValue(8, $product->getPost_lon());
            $st->bindValue(9, $product->getPost_lat());

            $result = $st->execute();
            $conn = null;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    /*
     * 
     */

    public static function update($product_id, Product $product) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "UPDATE tbl_product SET product_name= ?, product_description= ?
             WHERE product_id= ?";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $product->getProduct_name());
        $st->bindValue(2, $product->getProduct_description());
        $st->bindValue(3, $product_id);
        $result = $st->execute();
        $conn = null;
        return $result;
    }

    /*
     * 
     */

    public static function delete($product_id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $sql = "DELETE FROM tbl_product WHERE product_id= ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bindValue(1, $product_id);
        $st->execute();
        $conn = null;
    }

}

?>
