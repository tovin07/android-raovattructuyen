<?php

/*
 * @author QuangTuan
 */ 
define("APPLICATION_PATH", "application");
require (APPLICATION_PATH . "/configs/config.php");
//require (APPLICATION_PATH . "/controllers/index/logic/IndexController.php"); 
require APPLICATION_PATH . '/models/logic/UserModel.php';
$data= array();
$data['user_username']= "aa";
$data['user_password']= "bb";
$data['user_email']= "cc";
$data['user_status']= "1";
$user= new User($data);
echo $user->user_username;
//echo $user->username;
//echo $user->password;
//$data_json= json_encode((array)$user);
//$newarray= Tool::object_to_array($user);
//print_r($newarray);
//$json  = json_encode($user);
//$array = json_decode($json, true);
//print_r($array);
//
//$array= (array)$user;
//echo json_encode($array);
//var_dump(json_decode($data_json), true);
//echo $data_decode['username'];
?>
