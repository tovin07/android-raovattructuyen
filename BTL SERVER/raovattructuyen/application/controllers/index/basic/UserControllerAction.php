<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserControllerAction
 *
 * @author misugi_jun91
 */
class UserControllerAction {

    /**
     * checkusername=1; co the dang ki
     * register=1; dang ki hoan tat
     */
    public function register() {
        $respone = array();
        $user_username = $_POST['user_username'];
        $checkusername = UserModel::checkUsername($user_username);

        if ($checkusername == 0) {
            $respone['checkusername'] = 1;
            $regiser = UserModel::insert(new User($_POST));
            if ($regiser == 1) {
                $respone['register'] = 1;
                $usid = UserModel::getIDByUsername($user_username);
                $respone['uid'] = $usid;
            } else {
                $respone['register'] = 0;
            }
        } else {
            $respone['register'] = 0;
            $respone['checkusername'] = 0;
        }
        $respone['user_username'] = $_POST['user_username'];
        echo json_encode($respone);
    }

    public function checkLogin() {

        $respone = array();
        $username = $_POST['user_username'];
        $password = $_POST['user_password'];
        $result = UserModel::checkLogin($username, $password);
        if ($result == 0)
            $respone['uid'] = -1;
        else {
            $data= UserModel::getByUsername($username);
            $user= new User($data);
            $respone['uid'] = $user->getUser_id();
            $respone['username'] = $user->getUser_username();
           $respone['avatar'] = $user->getUser_avatar()!= "" ? $user->getUser_avatar() : "/public/images/noavatar.jpg";
        }
        echo (json_encode($respone));
    }

    public function updateAvatar() {
        
    }

    public function getUserInfo() {
        $id = $_GET['user_id'];
        $user = new User(UserModel::getById($id));
        $respone = array();
        $respone['fullname'] = $user->getUser_fullname();
        $respone['email'] = $user->getUser_email();
        $respone['phone'] = $user->getUser_tel();
        $respone['address'] = $user->getUser_address();
        $respone['taikhoan'] = $user->getUser_taikhoan();
        echo json_encode($respone);
    }

}

?>
