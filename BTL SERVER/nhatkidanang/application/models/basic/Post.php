<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Post extends Model {

    private $post_id;
    private $post_publicationDate;
    private $post_visiCount;
    private $post_content;
    private $post_description;
    private $weather_id;
    private $properties = array('post_id', 'post_publicationDate', 'post_visiCount', 'post_content', 'post_description', 'weather_id');

    public function __construct($data) {
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

    public function getPost_content() {
        return $this->post_content;
    }

    public function setPost_content($post_content) {
        $this->post_content = $post_content;
    }

    public function getPost_description() {
        return $this->post_description;
    }

    public function setPost_description($post_description) {
        $this->post_description = $post_description;
    }

    public function getWeather_id() {
        return $this->weather_id;
    }

    public function setWeather_id($weather_id) {
        $this->weather_id = $weather_id;
    }

    public function getProperties() {
        return $this->properties;
    }

    public function setProperties($properties) {
        $this->properties = $properties;
    }




}

?>
