<?php

/*
 * @author QuangTuan
 */
require APPLICATION_PATH . '/controllers/admin/basic/ProductControllerAction.php';
$productControllerAction= new ProductControllerAction();
$action= isset($_GET['action']) ? $_GET['action'] : "";
switch ($action)
{
    case "previewProduct":
        $productControllerAction->previewProduct();
        break;
    case "listProduct":
        $productControllerAction->listProduct();
        break;
    case "listComment":
        $productControllerAction->listComment();
        break;
    case "deleteComment":
        $productControllerAction->deleteComment();
        break;
    case "deleteListComment":
        $productControllerAction->deleteListComment();
        break;
    case "responseComment":
        $productControllerAction->responseComment();
        break;
    case "listProductAjax":
        $productControllerAction->listProductAjax();
        break;
    case "editProduct":
        $productControllerAction->editProduct();
        break;
    case "newProduct":
        $productControllerAction->newProduct();
        break;
    case "deleteProduct":
        $productControllerAction->deleteProduct();
        break;
    case "deleteListProduct":
        $productControllerAction->deleteListProduct();
        break;
    case "checkProductNameAjax":
        $productControllerAction->checkProductNameAjax();
        break;
    default :
        $productControllerAction->listProduct();
        break;
}
?>
