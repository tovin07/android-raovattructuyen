<?php

/*
 * @author QuangTuan
 */

require APPLICATION_PATH . '/controllers/index/basic/FollowuserControllerAction.php';
$followuserControllerAction = new FollowuserControllerAction();
$action = isset($_GET['a']) ? $_GET['a'] : ""; //action
switch ($action) {
    case "followuser":
        $followuserControllerAction->followuser();
        break;
    case "checkfollow":
        $followuserControllerAction->checkfollow();
        break;
    case "unfollow":
        $followuserControllerAction->unfollow();
        break;
    case "getUserFollowed":
        $followuserControllerAction->getUserFollowed();
        break;
    default :
       
        break;
}
?>
