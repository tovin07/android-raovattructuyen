<?php

/*
 * @author QuangTuan
 */
ini_set("display_errors", true); 
ini_set ('magic_quotes_gpc', 0);
date_default_timezone_set("Asia/Ho_Chi_Minh");
define("DB_DSN", "mysql:host=localhost;dbname=db_nhatki");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("ROOT_PATH", "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER["SCRIPT_NAME"]) . "/"); 
//define("ROOT_PATH", "http://kazzo.vn/"); 
define("NAME_WEBSITE", "Kazzo Shop");
define("NUMBER_ARTICLE_PER_PAGE", 10);
define("CLASS_PATH", APPLICATION_PATH . "/models/basic");
require (CLASS_PATH . "/Model.php");
require (CLASS_PATH . "/User.php");
//require (CLASS_PATH . "/Info.php");
//require (CLASS_PATH . "/Contact.php");
//require (CLASS_PATH . "/Subproduct.php");
//require (CLASS_PATH . "/Setting.php");
//require (CLASS_PATH . "/Category.php");
//require (CLASS_PATH . "/Comment.php");
//require (CLASS_PATH . "/Response.php");
//require (CLASS_PATH . "/User.php");
//require (CLASS_PATH . "/UserGroup.php");
require (CLASS_PATH . "/Tool.php");
?>
