<?php

/*
 * @author QuangTuan
 */

require APPLICATION_PATH . '/controllers/index/basic/UserControllerAction.php';
$userControllerAction = new UserControllerAction();
$action = isset($_GET['a']) ? $_GET['a'] : ""; //action
switch ($action) {
    case "register":
        $userControllerAction->register();
        break;
    case "checklogin":
        $userControllerAction->checkLogin();
        break;
    case "checkusername":
        $userControllerAction->checkUsername();
        break;
    case "updateavatar":
        $userControllerAction->updateAvatar();
        break;
    case "userinfo":$userControllerAction->getUserInfo();
        break;
    default :
       
        break;
}
?>
