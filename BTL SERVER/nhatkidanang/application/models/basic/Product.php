<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Product extends Model {

    private $product_id;
    private $product_name;
    private $product_description;
    private $user_id;
    private $properties = array('product_id', 'product_name', 'product_description', 'user_id');

    public function __construct($data) {
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



}

?>
