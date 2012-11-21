<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Category extends Model {

    private $category_id;
    private $category_name;
    private $category_description;
    private $properties = array('category_id', 'category_name', 'category_description');

    public function __construct($data) {
        foreach ($this->properties as $i) {
            if (isset($data[$i])) {
                $this->$i = $data[$i];
            }
        }
    }
    public function getCategory_id() {
        return $this->category_id;
    }

    public function setCategory_id($category_id) {
        $this->category_id = $category_id;
    }

    public function getCategory_name() {
        return $this->category_name;
    }

    public function setCategory_name($category_name) {
        $this->category_name = $category_name;
    }

    public function getCategory_description() {
        return $this->category_description;
    }

    public function setCategory_description($category_description) {
        $this->category_description = $category_description;
    }

    public function getProperties() {
        return $this->properties;
    }

    public function setProperties($properties) {
        $this->properties = $properties;
    }




}

?>
