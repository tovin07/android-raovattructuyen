<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Usergroup extends Model {

    private $usergroup_id=null;
    private $usergroup_name=null;
    private $usergroup_description=null;
    private $properties = array('usergroup_id', 'usergroup_name', 'usergroup_description');

    public function __construct($data= array()) {
        foreach ($this->properties as $i) {
            if (isset($data[$i])) {
                $this->$i = $data[$i];
            }
        }
    }
    public function getUsergroup_id() {
        return $this->usergroup_id;
    }

    public function setUsergroup_id($usergroup_id) {
        $this->usergroup_id = $usergroup_id;
    }

    public function getUsergroup_name() {
        return $this->usergroup_name;
    }

    public function setUsergroup_name($usergroup_name) {
        $this->usergroup_name = $usergroup_name;
    }

    public function getUsergroup_description() {
        return $this->usergroup_description;
    }

    public function setUsergroup_description($usergroup_description) {
        $this->usergroup_description = $usergroup_description;
    }

    public function getProperties() {
        return $this->properties;
    }

    public function setProperties($properties) {
        $this->properties = $properties;
    }




}

?>
