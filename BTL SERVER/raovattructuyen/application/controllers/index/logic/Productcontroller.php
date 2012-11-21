<?php



require APPLICATION_PATH . '/controllers/index/basic/ProductControllerAction.php';
$productControllerAction = new ProductControllerAction();
$action = isset($_GET['a']) ? $_GET['a'] : ""; //action
switch ($action) {
    case "newProduct":
        $productControllerAction->newProduct();
        break;
    case "editProduct":
        $productControllerAction->editProduct();
        break;
    case "checkProduct_name":
        $productControllerAction->checkProduct_name();
        break;
    case "getfeed":
        $productControllerAction->getFeed();
        break;
    case "getpage":
        $productControllerAction->getPage();
        break;
    case "loadMoreFeed":
        $productControllerAction->loadMoreFeed();
        break;
    case "loadMorePage":
        $productControllerAction->loadMorePage();
        break;
    default :
       
        break;
}
?>
