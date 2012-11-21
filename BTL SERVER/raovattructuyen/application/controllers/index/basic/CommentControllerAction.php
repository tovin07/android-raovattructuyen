<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentControllerAction
 *
 * @author misugi_jun91
 */
class CommentControllerAction {

    /**
     * checkcommentname=1; co the dang ki
     * register=1; dang ki hoan tat
     */
    public function postComment() {
        $respone = array();
        if (isset($_POST)) {
            $comment = new Comment($_POST);
            $pubDate = time();
            $comment->setComment_publicationDate($pubDate);
            $result=  CommentModel::insert($comment);
            $respone['result']=$result;
        }
        echo json_encode($respone);
    }

    public function viewComment() {

        $respone = array();
        if (isset($_GET['product_id'])) {
            $data = CommentModel::getAllCommentsByProductId($_GET['product_id']);
            $respone['comments']= $data['results'];
            echo json_encode($respone);
        } else {
            $respone['result']= 0;
            echo json_encode($respone);
        }
    }

}

?>
