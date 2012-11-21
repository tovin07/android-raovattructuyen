<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Post extends Model {

    private $post_id= null;
    private $post_publicationDate= null;
    private $post_visiCount= 0;
    private $product_id= null;
    private $post_uid=null;
    private $properties = array('post_id', 'post_publicationDate', 'post_visiCount', 'product_id','post_uid');

    public function __construct($data= array()) {
        foreach ($this->properties as $i) {
            if (isset($data[$i])) {
                $this->$i = $data[$i];
            }
        }
    }
    public function getPost_id() {
        return $this->post_id;
    }

    public function setPost_id($post_id) {
        $this->post_id = $post_id;
    }

    public function getPost_publicationDate() {
        return $this->post_publicationDate;
    }

    public function setPost_publicationDate($post_publicationDate) {
        $this->post_publicationDate = $post_publicationDate;
    }

    public function getPost_visiCount() {
        return $this->post_visiCount;
    }

    public function setPost_visiCount($post_visiCount) {
        $this->post_visiCount = $post_visiCount;
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


    public function setPost_uid($post_uid){
        $this->post_uid=$post_uid;
    }
    
    public function getPost_uid(){
        return $this->post_uid;
    }


}

?>
