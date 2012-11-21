<?php

/*
 * @author QuangTuan
 */

require APPLICATION_PATH . '/controllers/index/basic/CommentControllerAction.php';
$commentControllerAction = new CommentControllerAction();
$action = isset($_GET['a']) ? $_GET['a'] : ""; //action
switch ($action) {
    case "postComment":
        $commentControllerAction->postComment();
        break;
    case "viewComment":
        $commentControllerAction->viewComment();
        break;
    default :
       
        break;
}
?>
