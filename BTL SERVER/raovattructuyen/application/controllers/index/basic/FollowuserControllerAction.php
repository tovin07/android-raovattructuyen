<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FollowControllerAction
 *
 * @author misugi_jun91
 */
class FollowuserControllerAction {
    //put your code here
    public function followuser(){
        $respone =array();
        $userfollow_id= $_GET['userfollow'];
        $userfollowed_id= $_GET['userfollowed'];
        $followuser= new Followuser();
        $followuser->setUserfollow_id($userfollow_id);
        $followuser->setUserfollowed_id($userfollowed_id);
        $result= FollowuserModel::insert($followuser);
        if ($result == "true")
            $respone['result']= 1;
        else 
            $respone['result']= 0;
        echo (json_encode($respone));
    }
    public function checkfollow(){
        $respone =array();
        $userfollow_id= $_GET['userfollow'];
        $userfollowed_id= $_GET['userfollowed'];
        $result= FollowuserModel::checkFollow($userfollow_id, $userfollowed_id);
        $respone['result']= $result;
        echo (json_encode($respone));
    }
    public function unfollow(){
        $respone =array();
        $userfollow_id= $_GET['userfollow'];
        $userfollowed_id= $_GET['userfollowed'];
        $result= FollowuserModel::delete($userfollow_id, $userfollowed_id);
        if ($result == "true")
            $respone['result']= 1;
        else 
            $respone['result']= 0;
        echo (json_encode($respone));
    }
    public function getUserFollowed(){
        $respone =array();
        $userfollow_id= $_GET['user_id'];
        $page= $_GET['page'];
        $data= FollowuserModel::getAllUserFollowedByUserFollow($userfollow_id, $page, 10);
        $respone['users']= $data['results'];
        $totalPage= $data['totalRows']/10;
        if ($page >= $totalPage)
            $page= 0;
        $respone['page']= $page;
        echo (json_encode($respone));
//        print_r($respone['users']);
    }
}

?>
