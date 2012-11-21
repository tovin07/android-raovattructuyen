<?php

/*
 * @author QuangTuan
 */
require APPLICATION_PATH . '/controllers/admin/basic/UserControllerAction.php';
$userControllerAction = new UserControllerAction();
$action = isset($_GET['action']) ? $_GET['action'] : "";
switch ($action) {
    case "register":
        $userControllerAction->register();
        break;
    case "checkLogin":
        $userControllerAction->checkLogin();
        break;
    case "checkUsername":
        $userControllerAction->checkUsername();
        break;
    default :
        $userControllerAction->init();
        break;
}
?>
