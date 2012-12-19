<?php 

/*
 *
 */
require APPLICATION_PATH . '/controllers/admin/basic/AdminControllerAction.php';
session_start();
ini_set ('magic_quotes_gpc', 0);
$adminControllerAction= new AdminControllerAction();
$admin= isset($_GET['admin']) ? $_GET['admin'] : "";
$username= isset($_SESSION['username']) ? $_SESSION['username'] : "";
$manager= isset($_GET['manager']) ? $_GET['manager'] : "";
if ($admin!= "login" && $admin!= "logout" && !$username)
{
    $adminControllerAction->login();
    exit;
}
switch ($admin)
{
    case "login":
        $adminControllerAction->login();
        break;
    case "logout":
        $adminControllerAction->logout();
        break;
    case "changeSetting":
        $adminControllerAction->changeSetting();
        break;
    default :
        switch ($manager)
        {
            case "product": 
                require 'ProductController.php';
                break;
            case "category":
                require 'CategoryController.php';
                break;
            case "gallery":
                $adminControllerAction->gallery();
                break;
            case "info":
                require 'InfoController.php';
                break;
            case "contact":
                require 'ContactController.php';
                break;
            case "catarticle":
                require 'CatarticleController.php';
                break;
            case "manufacture":
                require 'ManufactureController.php';
                break;
            case "user":
                require 'UserController.php';
                break;
            case "usergroup":
                require 'UsergroupController.php';
                break;
            case "image":
                require 'ImageController.php';
                break;
            case "image":
                require 'ImageController.php';
            default :
                require 'ProductController.php';
                break;
        }
        break;
}    
?>
