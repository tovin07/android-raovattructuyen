<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Comment extends Model {

    private $comment_id;
    private $comment_content;
    private $comment_publicationDate;
    private $post_id;
    private $user_id;
    private $properties = array('comment_id', 'comment_content', 'comment_publicationDate', 'user_id', 'post_id');

    public function __construct($data) {
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

    public function getPost_id() {
        return $this->post_id;
    }

    public function setPost_id($post_id) {
        $this->post_id = $post_id;
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
