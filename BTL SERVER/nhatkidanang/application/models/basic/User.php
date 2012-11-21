<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class User extends Model {

    private $user_id;
    private $user_username;
    private $user_password;
    private $user_email;
    private $user_fullname;
    private $user_address;
    private $user_tel;
    private $user_taikhoan;
    private $user_avatar;
    private $user_point;
    private $user_status;
    private $properties = array('user_id', 'user_username', 'user_password', 'user_password', 'user_email', 'user_fullname', 'user_address', 'user_tel', 'user_taikhoan', 'user_avatar', 'user_point', 'user_status');

    public function __construct($data) {
        foreach ($this->properties as $i) {
            if (isset($data[$i])) {
                $this->$i = $data[$i];
            }
        }
    }
    public function getUser_id() {
        return $this->user_id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function getUser_username() {
        return $this->user_username;
    }

    public function setUser_username($user_username) {
        $this->user_username = $user_username;
    }

    public function getUser_password() {
        return $this->user_password;
    }

    public function setUser_password($user_password) {
        $this->user_password = $user_password;
    }

    public function getUser_email() {
        return $this->user_email;
    }

    public function setUser_email($user_email) {
        $this->user_email = $user_email;
    }

    public function getUser_fullname() {
        return $this->user_fullname;
    }

    public function setUser_fullname($user_fullname) {
        $this->user_fullname = $user_fullname;
    }

    public function getUser_address() {
        return $this->user_address;
    }

    public function setUser_address($user_address) {
        $this->user_address = $user_address;
    }

    public function getUser_tel() {
        return $this->user_tel;
    }

    public function setUser_tel($user_tel) {
        $this->user_tel = $user_tel;
    }

    public function getUser_taikhoan() {
        return $this->user_taikhoan;
    }

    public function setUser_taikhoan($user_taikhoan) {
        $this->user_taikhoan = $user_taikhoan;
    }

    public function getUser_avatar() {
        return $this->user_avatar;
    }

    public function setUser_avatar($user_avatar) {
        $this->user_avatar = $user_avatar;
    }

    public function getUser_point() {
        return $this->user_point;
    }

    public function setUser_point($user_point) {
        $this->user_point = $user_point;
    }

    public function getUser_status() {
        return $this->user_status;
    }

    public function setUser_status($user_status) {
        $this->user_status = $user_status;
    }



}

?>
