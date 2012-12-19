<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Product extends Model {

    private $product_id= null;
    private $product_name= null;
    private $product_avatar= null;
    private $product_description= null;
    private $user_id= null;
    private $post_publicationDate=null;
    private $post_visiCount=0;
    private $post_lon=null;
    private $post_lat=null;
    private $properties = array('product_id', 'product_name', 'product_avatar', 'product_description', 'user_id','post_publicationDate','post_visiCount', 'post_lon', 'post_lat');

    public function __construct($data= array()) {
        foreach ($this->properties as $i) {
            if (isset($data[$i])) {
                $this->$i = $data[$i];
            }
        }
    }
    public function getProduct_id() {
        return $this->product_id;
    }

    public function setProduct_id($product_id) {
        $this->product_id = $product_id;
    }

    public function getProduct_name() {
        return $this->product_name;
    }

    public function setProduct_name($product_name) {
        $this->product_name = $product_name;
    }

    public function getProduct_description() {
        return $this->product_description;
    }

    public function setProduct_description($product_description) {
        $this->product_description = $product_description;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function getProperties() {
        return $this->properties;
    }

    public function setProperties($properties) {
        $this->properties = $properties;
    }


    public function getProduct_avatar() {
        return $this->product_avatar;
    }

    public function setProduct_avatar($product_avatar) {
        $this->product_avatar = $product_avatar;
    }

      public function setPost_publicationDate($post_publicationDate) {
        $this->post_publicationDate = $post_publicationDate;
    }
    public function getPost_publicationDate() {
        return $this->post_publicationDate;
    }
     public function getPost_visiCount() {
        return $this->post_visiCount;
    }

    public function setPost_visiCount($post_visiCount) {
        $this->post_visiCount = $post_visiCount;
    }
    public function getPost_lon() {
        return $this->post_lon;
    }

    public function setPost_lon($post_lon) {
        $this->post_lon = $post_lon;
    }

    
    public function getPost_lat() {
        return $this->post_lat;
    }

    public function setPost_lat($post_lat) {
        $this->post_lat = $post_lat;
    }



}

?>
