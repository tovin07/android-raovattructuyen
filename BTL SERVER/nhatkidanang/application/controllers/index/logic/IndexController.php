<?php

/*
 * @author QuangTuan
 */
require APPLICATION_PATH . '/controllers/index/basic/IndexControllerAction.php';
$indexControllerAction= new IndexControllerAction();
$manager= isset($_GET['manager']) ? $_GET['manager'] : "";
$action= isset($_GET['action']) ? $_GET['action'] : "";
session_start();
switch ($manager) {
    case "user":
        require 'Usercontroller.php';
        break;
    case "post":
        require 'Postcontroller.php';
        break;
    default:
        break;
}
switch ($action) {
    case "":

        break;

    default:
        break;
}
?>
