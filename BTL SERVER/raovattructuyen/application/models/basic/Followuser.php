<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Followuser
 *
 * @author misugi_jun91
 */
class Followuser extends Model{
    private $userfollow_id;
    private $userfollowed_id;
    private $properties = array('userfollow_id', 'userfollowed_id');
    
    public function __construct($data= array()) {
        foreach ($this->properties as $i) {
            if (isset($data[$i])) {
                $this->$i = $data[$i];
            }
        }
    }
    public function getUserfollow_id() {
        return $this->userfollow_id;
    }

    public function setUserfollow_id($userfollow_id) {
        $this->userfollow_id = $userfollow_id;
    }

    public function getUserfollowed_id() {
        return $this->userfollowed_id;
    }

    public function setUserfollowed_id($userfollowed_id) {
        $this->userfollowed_id = $userfollowed_id;
    }

    public function getProperties() {
        return $this->properties;
    }

    public function setProperties($properties) {
        $this->properties = $properties;
    }


    
    
}

?>
