<?php

/*
 * @author QuangTuan
 */
require APPLICATION_PATH . '/controllers/index/basic/IndexControllerAction.php';

$indexControllerAction= new IndexControllerAction();
$manager= isset($_GET['t']) ? $_GET['t'] : ""; //type
$action= isset($_GET['action']) ? $_GET['action'] : "";
session_start();
switch ($manager) {
    case "user":
        require 'Usercontroller.php';
        break;
    case "post":
        require 'Postcontroller.php';
        break;
    case "product":
        require 'Productcontroller.php';
        break;
    case "comment":
        require 'Commentcontroller.php';
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
