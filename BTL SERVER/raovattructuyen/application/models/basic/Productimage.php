<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Productimage extends Model {

    private $productimage_id= null;
    private $productimage_link= null;
    private $productimage_thumb= null;
    private $product_id= null;
    private $properties = array('productimage_id', '$productimage_link', 'productimage_thumb', 'product_id');

    public function __construct($data= array()) {
        foreach ($this->properties as $i) {
            if (isset($data[$i])) {
                $this->$i = $data[$i];
            }
        }
    }
    public function getProductimage_id() {
        return $this->productimage_id;
    }

    public function setProductimage_id($productimage_id) {
        $this->productimage_id = $productimage_id;
    }

    public function getProductimage_link() {
        return $this->productimage_link;
    }

    public function setProductimage_link($productimage_link) {
        $this->productimage_link = $productimage_link;
    }

    public function getProductimage_thumb() {
        return $this->productimage_thumb;
    }

    public function setProductimage_thumb($productimage_thumb) {
        $this->productimage_thumb = $productimage_thumb;
    }

    public function getProduct_id() {
        return $this->product_id;
    }

    public function setProduct_id($product_id) {
        $this->product_id = $product_id;
    }

    public function getProperties() {
        return $this->properties;
    }

    public function setProperties($properties) {
        $this->properties = $properties;
    }


}

?>
