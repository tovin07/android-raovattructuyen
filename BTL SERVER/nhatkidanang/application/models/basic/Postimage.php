<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Postimage extends Model {

    private $postimage_id;
    private $postimage_link;
    private $postimage_thumb;
    private $post_id;
    private $postimage_type;
    private $properties = array('postimage_id', '$postimage_link', 'postimage_thumb', 'post_id', 'postimage_type');

    public function __construct($data) {
        foreach ($this->properties as $i) {
            if (isset($data[$i])) {
                $this->$i = $data[$i];
            }
        }
    }
    public function getPostimage_id() {
        return $this->postimage_id;
    }

    public function setPostimage_id($postimage_id) {
        $this->postimage_id = $postimage_id;
    }

    public function getPostimage_link() {
        return $this->postimage_link;
    }

    public function setPostimage_link($postimage_link) {
        $this->postimage_link = $postimage_link;
    }

    public function getPostimage_thumb() {
        return $this->postimage_thumb;
    }

    public function setPostimage_thumb($postimage_thumb) {
        $this->postimage_thumb = $postimage_thumb;
    }

    public function getPost_id() {
        return $this->post_id;
    }

    public function setPost_id($post_id) {
        $this->post_id = $post_id;
    }

    public function getPostimage_type() {
        return $this->postimage_type;
    }

    public function setPostimage_type($postimage_type) {
        $this->postimage_type = $postimage_type;
    }

    public function getProperties() {
        return $this->properties;
    }

    public function setProperties($properties) {
        $this->properties = $properties;
    }




}

?>
