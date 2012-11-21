<?php

/*
 * @author QuangTuan
 */
ini_set("display_errors", true); 
ini_set ('magic_quotes_gpc', 0);
date_default_timezone_set("Asia/Ho_Chi_Minh");
define("DB_DSN", "mysql:host=localhost;dbname=db_raovat");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("ROOT_PATH", "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER["SCRIPT_NAME"]) . "/"); 


define("CLASS_PATH", APPLICATION_PATH . "/models/basic");
define("CLASSLOGIC_PATH", APPLICATION_PATH . "/models/logic");
require (CLASS_PATH . "/Tool.php");
require (CLASS_PATH . "/Model.php");
require (CLASS_PATH . "/User.php");
require (CLASSLOGIC_PATH . "/UserModel.php");
require (CLASS_PATH . "/Product.php");
require (CLASSLOGIC_PATH . "/ProductModel.php");
require (CLASS_PATH . "/Notification.php");
require (CLASSLOGIC_PATH . "/NotificationModel.php");
require (CLASS_PATH . "/Category.php");
require (CLASSLOGIC_PATH . "/CategoryModel.php");
require (CLASS_PATH . "/Comment.php");
require (CLASSLOGIC_PATH . "/CommentModel.php");
require (CLASS_PATH . "/Followpost.php");
require (CLASSLOGIC_PATH . "/FollowpostModel.php");
require (CLASS_PATH . "/Followuser.php");
require (CLASSLOGIC_PATH . "/FollowuserModel.php");
require (CLASS_PATH . "/Post.php");
require (CLASSLOGIC_PATH . "/PostModel.php");
require (CLASS_PATH . "/Productimage.php");
require (CLASSLOGIC_PATH . "/ProductimageModel.php");
require (CLASS_PATH . "/UserGroup.php");
require (CLASSLOGIC_PATH . "/UserGroupModel.php");
//require (CLASS_PATH . "/Info.php");
//require (CLASS_PATH . "/Contact.php");
//require (CLASS_PATH . "/Subproduct.php");
//require (CLASS_PATH . "/Setting.php");
//require (CLASS_PATH . "/Category.php");
//require (CLASS_PATH . "/Comment.php");
//require (CLASS_PATH . "/Response.php");
//require (CLASS_PATH . "/User.php");
//require (CLASS_PATH . "/UserGroup.php");
//require (CLASS_PATH . "/Tool.php");
?>
