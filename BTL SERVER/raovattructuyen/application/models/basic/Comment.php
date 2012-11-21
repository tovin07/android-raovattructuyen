<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Comment extends Model {

    private $comment_id= null;
    private $comment_content= null;
    private $comment_publicationDate= null;
    private $product_id= null;
    private $user_id= null;
    private $properties = array('comment_id', 'comment_content', 'comment_publicationDate', 'user_id', 'product_id');

    public function __construct($data= array()) {
        foreach ($this->properties as $i) {
            if (isset($data[$i])) {
                $this->$i = $data[$i];
            }
        }
    }
    public function getComment_id() {
        return $this->comment_id;
    }

    public function setComment_id($comment_id) {
        $this->comment_id = $comment_id;
    }

    public function getComment_content() {
        return $this->comment_content;
    }

    public function setComment_content($comment_content) {
        $this->comment_content = $comment_content;
    }

    public function getComment_publicationDate() {
        return $this->comment_publicationDate;
    }

    public function setComment_publicationDate($comment_publicationDate) {
        $this->comment_publicationDate = $comment_publicationDate;
    }

    public function getProduct_id() {
        return $this->product_id;
    }

    public function setProduct_id($post_id) {
        $this->product_id = $post_id;
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
