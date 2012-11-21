<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductControllerAction
 *
 * @author Quang Tuan
 */
require APPLICATION_PATH . '/models/logic/ProductModel.php';
require APPLICATION_PATH . '/models/logic/SubproductModel.php';
require APPLICATION_PATH . '/models/logic/CommentModel.php';
require APPLICATION_PATH . '/models/logic/ResponseModel.php';
require APPLICATION_PATH . '/models/logic/ImageProductModel.php';
require APPLICATION_PATH . '/models/logic/CategoryModel.php';

class ProductControllerAction {
    /*
     * 
     */

    public function listProduct() {
        $results = array();
        $results['titlePage'] = "List Product";
        $data = CategoryModel::getAllCategory();
        $results['categories'] = $data['results'];
        $category_id = 0;
        if (isset($_GET['category_id']))
            $category_id = $_GET['category_id'];
        if ($category_id == 0) {
            $data = ProductModel::getAllProducts();
        } else {
            $data = ProductModel::getListByCategoryId($category_id);
        }
        $results['products'] = $data['results'];
        require APPLICATION_PATH . '/views/admin/listProduct.php';
    }

    public function listComment() {
        $results = array();
        $results['titlePage'] = "List Comment";
        $product_id = $_GET['product_id'];
        $data = CommentModel::getByProductId($product_id);
        $results['comments'] = $data['results'];
        require APPLICATION_PATH . '/views/admin/listComment.php';
    }

    public function responseComment() {
        if (isset($_POST['submit'])) {
            $response = new Response();
            $response->setResponse_content($_POST['response_content']);
            $response->setResponse_publicationDate(mktime());
            $response->setComment_id($_POST['comment_id']);
            $product_id = $_POST['product_id'];
            ResponseModel::insert($response);
            $url = "admincp.php?manager=product&action=listComment&product_id=" . $product_id;
            header("Location:$url");
        } else {
            $comment = CommentModel::getById($_GET['comment_id']);
            $product_id = $_GET['product_id'];
            require APPLICATION_PATH . '/views/admin/responseComment.php';
        }
    }

    /*
     * 
     */

    public function listProductAjax() {

        $results = array();
        $results['titlePage'] = "List Product";
        $data = CategoryModel::getAllCategory();
        $results['categories'] = $data['results'];

        $category_id = 0;
        if (isset($_GET['category_id']))
            $category_id = $_GET['category_id'];
        if ($category_id == 0) {
            $data = ProductModel::getAllProducts();
        } else {
            $data = ProductModel::getListByCategoryId($category_id);
        }
        $results['products'] = $data['results'];
        require APPLICATION_PATH . '/views/admin/listProductAjax.php';
    }

    /*
     * 
     */

    public function newProduct() {

        $results = array();
        $results['actionForm'] = "newProduct";
        $results['product_titlePage'] = "New Product";
        $results['product_titleForm'] = "Tạo sản phẩm mới";
        $data = CategoryModel::getAllCategory();
        $results['categories'] = $data['results'];

        if (isset($_POST['submit'])) {
            if (get_magic_quotes_gpc()) {
                Tool::stripslashes_array($_POST);
            }
            $product = new Product($_POST);
            $product_nameX = Tool::changeTitle($_POST['product_name']);
            $product->setProduct_nameX($product_nameX);
            $category_nameX = CategoryModel::getCategoryNameXById($_POST['category_id']);
            $link = "/$category_nameX/$product_nameX.html";
            $product->setProduct_link($link);
            $publicationDate = time();
            $product->setProduct_publicationDate($publicationDate);
            $product_id = ProductModel::getProductIdMax() + 1;
            $product->setProduct_id($product_id);
            if ($_POST['avatar']) {
                $avatar = $_POST['avatar'];
                $product->setProduct_avatar($avatar);
            }
            for ($i = 0; $i < 200; $i++) {
                if ($_POST['subproduct_image'][$i] != "" && $_POST['subproduct_name'][$i] != "") {
                    $imageName = substr($_POST['subproduct_image'][$i], strripos($_POST['subproduct_image'][$i], "/") + 1);
                    $thumbSourceName = str_replace(" ", "", $imageName);
                    $thumbSourceName = str_replace("%", "", $thumbSourceName);
                    $thumbSource = "../public/uploads/thumb/$thumbSourceName";
                    Tool::createThumbImage($_POST['subproduct_image'][$i], $thumbSource, null, 56, 56);
                    $thumb = ROOT_PATH . "public/uploads/thumb/$thumbSourceName";
                    $subproduct = new Subproduct();
                    $subproduct->setProduct_id($product_id);
                    $subproduct->setSubproduct_image($_POST['subproduct_image'][$i]);
                    $subproduct->setSubproduct_thumb($thumb);
                    $subproduct->setSubproduct_name($_POST['subproduct_name'][$i]);
                    $subproduct->setSubproduct_order($i + 1);
                    $subproduct->setSubproduct_description($_POST['subproduct_description'][$i]);
                    $subproduct->setSubproduct_price($_POST['subproduct_price'][$i]);
                    while (($masp = Tool::rand_string(6)) && SubproductModel::checkMasp($masp)) {
                        
                    };
                    $subproduct->setSubproduct_masp($masp);
                    SubproductModel::insert($subproduct);
                }
            }
            ProductModel::insert($product);
            header("Location:admincp.php?manager=product&addStatus=1");
        } else if (isset($_POST['preview'])) {
            if (get_magic_quotes_gpc()) {
                Tool::stripslashes_array($_POST);
            }
            $results['product'] = new Product($_POST);
            $product_nameX = Tool::changeTitle($_POST['product_name']);
            $results['product']->setProduct_nameX($product_nameX);
            $category_nameX = CategoryModel::getCategoryNameXById($_POST['category_id']);
            $link = "/$category_nameX/$product_nameX.html";
            $results['product']->setProduct_link($link);
            $publicationDate = time();
            $results['product']->setProduct_publicationDate($publicationDate);
            if ($_POST['avatar']) {
                $avatar = $_POST['avatar'];
                $results['product']->setProduct_avatar($avatar);
            }
            $product_content = $results['product']->getProduct_content();

            $subproduct_patterm = "/\[(\d+)\]/";
            while (preg_match($subproduct_patterm, $product_content, $matches)) {
                $subproduct_order = $matches[1];
//                $tmp_subproduct = SubproductModel::getByProductIdOrder($product_id, $subproduct_order);
                $i = $matches[1] - 1;
                if ($_POST['subproduct_image'][$i] != "" && $_POST['subproduct_name'][$i] != "") {
                    $imageName = substr($_POST['subproduct_image'][$i], strripos($_POST['subproduct_image'][$i], "/") + 1);
                    $thumbSourceName = str_replace(" ", "", $imageName);
                    $thumbSourceName = str_replace("%", "", $thumbSourceName);
                    $thumbSource = "../public/uploads/thumb/$thumbSourceName";
                    Tool::createThumbImage($_POST['subproduct_image'][$i], $thumbSource, null, 56, 56);
                    $thumb = ROOT_PATH . "public/uploads/thumb/$thumbSourceName";
                    $tmp_subproduct = new Subproduct();
                    $tmp_subproduct->setProduct_id($product_id);
                    $tmp_subproduct->setSubproduct_image($_POST['subproduct_image'][$i]);
                    $tmp_subproduct->setSubproduct_thumb($thumb);
                    $tmp_subproduct->setSubproduct_name($_POST['subproduct_name'][$i]);
                    $tmp_subproduct->setSubproduct_order($i + 1);
                    $tmp_subproduct->setSubproduct_description($_POST['subproduct_description'][$i]);
                    $tmp_subproduct->setSubproduct_price($_POST['subproduct_price'][$i]);
                    while (($masp = Tool::rand_string(6)) && SubproductModel::checkMasp($masp)) {
                        
                    };
                    $tmp_subproduct->setSubproduct_masp($masp);
                }
                if ($tmp_subproduct == null) {
                    $product_content = str_replace($matches[0], "Ảnh số " . $subproduct_order, $product_content);
                    continue;
                }
                $image = $tmp_subproduct->getSubproduct_image();
                $name = $tmp_subproduct->getSubproduct_name();
                $price = $tmp_subproduct->getSubproduct_price();
                $title = "Ảnh số " . $subproduct_order . " : " . $name . " - Giá: " . $price;
                $id = "product_" . $subproduct_order;
                $subproduct_content = '<img class="openPopup" title="' . $title . '" id="' . $id . '" width="185px" style="margin: 4px;" src="' . $image . '" alt="' . $title . '" />';
                $product_content = str_replace($matches[0], $subproduct_content, $product_content);
            }
            $category_id = $results['product']->getCategory_id();
            $results['category'] = CategoryModel::getById($category_id);
            if ($results['category']->getCategory_parent() != 0)
                $results['parent'] = CategoryModel::getById($results['category']->getCategory_parent());
            $results['subproducts'] = array();
            require APPLICATION_PATH . '/views/defaults/showproduct.php';
        } else if (isset($_POST['cancel'])) {
            header("Location:admincp.php?manager=product");
        } else {
            $results['product'] = new Product();
            $results['subproducts'] = array();
            require APPLICATION_PATH . '/views/admin/editProduct.php';
        }
    }

    /*
     * 
     */

    public function test() {
        if (isset($_POST['submit'])) {

            if (get_magic_quotes_gpc()) {
                echo "get_magic_quotes_gpc is on";
                print_r(stripslashes($_POST['product_name']));
            } else {
                echo "get_magic_quotes_gpc is off";
                print_r($_POST['product_name']);
            }
        }
        else
            require APPLICATION_PATH . '/views/admin/test.php';
    }

    /*
     * 
     */

    public function editProduct() {
        $results = array();
        $results['actionForm'] = "editProduct";
        $results['product_namePage'] = "Edit Product";
        $results['product_nameForm'] = "Chỉnh sửa sản phẩm";
        $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : "";
        if ($product_id == "")
            header("Location:admincp.php?manager=product");


        if (isset($_POST['submit'])) {
            if (get_magic_quotes_gpc()) {
                Tool::stripslashes_array($_POST);
            }
            $product = new Product($_POST);
            $product_nameX = Tool::changeTitle($_POST['product_name']);
            $product->setProduct_nameX($product_nameX);
            $category_nameX = CategoryModel::getCategoryNameXById($_POST['category_id']);
            $link = "/$category_nameX/$product_nameX.html";
            $product->setProduct_link($link);
            $publicationDate = time();
            $product->setProduct_publicationDate($publicationDate);
            $content = $_POST['product_content'];
            $content = str_replace("../public/", ROOT_PATH . "public/", $content);
            $product->setProduct_content($content);
            if ($_POST['avatar']) {
                $avatar = $_POST['avatar'];
                $product->setProduct_avatar($avatar);
            }
            SubproductModel::deleteByProductId($product_id);
            for ($i = 0; $i < 200; $i++) {
                if ($_POST['subproduct_image'][$i] != "" && $_POST['subproduct_name'][$i] != "") {
                    $imageName = substr($_POST['subproduct_image'][$i], strripos($_POST['subproduct_image'][$i], "/") + 1);
                    $thumbSourceName = str_replace(" ", "", $imageName);
                    $thumbSourceName = str_replace("%", "", $thumbSourceName);
                    $thumbSource = "../public/uploads/thumb/$thumbSourceName";
                    Tool::createThumbImage($_POST['subproduct_image'][$i], $thumbSource, null, 56, 56);
                    $thumb = ROOT_PATH . "public/uploads/thumb/$thumbSourceName";
                    $subproduct = new Subproduct();
                    $subproduct->setProduct_id($product_id);
                    $subproduct->setSubproduct_image($_POST['subproduct_image'][$i]);
                    $subproduct->setSubproduct_thumb($thumb);
                    $subproduct->setSubproduct_name($_POST['subproduct_name'][$i]);
                    $subproduct->setSubproduct_order($i + 1);
                    $subproduct->setSubproduct_description($_POST['subproduct_description'][$i]);
                    $subproduct->setSubproduct_price($_POST['subproduct_price'][$i]);
                    while (($masp = Tool::rand_string(6)) && SubproductModel::checkMasp($masp)) {
                        
                    };
                    $subproduct->setSubproduct_masp($masp);
                    SubproductModel::insert($subproduct);
                }
            }
            ProductModel::update($product_id, $product);
            header("Location:admincp.php?manager=product&editStatus=1");
        } else if (isset($_POST['preview'])) {
            if (get_magic_quotes_gpc()) {
                Tool::stripslashes_array($_POST);
            }
            $results['product'] = new Product($_POST);
            $product_nameX = Tool::changeTitle($_POST['product_name']);
            $results['product']->setProduct_nameX($product_nameX);
            $category_nameX = CategoryModel::getCategoryNameXById($_POST['category_id']);
            $link = "/$category_nameX/$product_nameX.html";
            $results['product']->setProduct_link($link);
            $publicationDate = time();
            $results['product']->setProduct_publicationDate($publicationDate);
            if ($_POST['avatar']) {
                $avatar = $_POST['avatar'];
                $results['product']->setProduct_avatar($avatar);
            }
            $product_content = $results['product']->getProduct_content();

            $subproduct_patterm = "/\[(\d+)\]/";
            while (preg_match($subproduct_patterm, $product_content, $matches)) {
                $subproduct_order = $matches[1];
//                $tmp_subproduct = SubproductModel::getByProductIdOrder($product_id, $subproduct_order);
                $i = $matches[1] - 1;
                if ($_POST['subproduct_image'][$i] != "" && $_POST['subproduct_name'][$i] != "") {
                    $imageName = substr($_POST['subproduct_image'][$i], strripos($_POST['subproduct_image'][$i], "/") + 1);
                    $thumbSourceName = str_replace(" ", "", $imageName);
                    $thumbSourceName = str_replace("%", "", $thumbSourceName);
                    $thumbSource = "../public/uploads/thumb/$thumbSourceName";
                    Tool::createThumbImage($_POST['subproduct_image'][$i], $thumbSource, null, 56, 56);
                    $thumb = ROOT_PATH . "public/uploads/thumb/$thumbSourceName";
                    $tmp_subproduct = new Subproduct();
                    $tmp_subproduct->setProduct_id($product_id);
                    $tmp_subproduct->setSubproduct_image($_POST['subproduct_image'][$i]);
                    $tmp_subproduct->setSubproduct_thumb($thumb);
                    $tmp_subproduct->setSubproduct_name($_POST['subproduct_name'][$i]);
                    $tmp_subproduct->setSubproduct_order($i + 1);
                    $tmp_subproduct->setSubproduct_description($_POST['subproduct_description'][$i]);
                    $tmp_subproduct->setSubproduct_price($_POST['subproduct_price'][$i]);
                    while (($masp = Tool::rand_string(6)) && SubproductModel::checkMasp($masp)) {
                        
                    };
                    $tmp_subproduct->setSubproduct_masp($masp);
                }
                if ($tmp_subproduct == null) {
                    $product_content = str_replace($matches[0], "Ảnh số " . $subproduct_order, $product_content);
                    continue;
                }
                $image = $tmp_subproduct->getSubproduct_image();
                $name = $tmp_subproduct->getSubproduct_name();
                $price = $tmp_subproduct->getSubproduct_price();
                $title = "Ảnh số " . $subproduct_order . " : " . $name . " - Giá: " . $price;
                $id = "product_" . $subproduct_order;
                $subproduct_content = '<img class="openPopup" title="' . $title . '" id="' . $id . '" width="185px" style="margin: 4px;" src="' . $image . '" alt="' . $title . '" />';
                $product_content = str_replace($matches[0], $subproduct_content, $product_content);
            }
            $category_id = $results['product']->getCategory_id();
            $results['category'] = CategoryModel::getById($category_id);
            if ($results['category']->getCategory_parent() != 0)
                $results['parent'] = CategoryModel::getById($results['category']->getCategory_parent());
            $results['subproducts'] = array();
            require APPLICATION_PATH . '/views/defaults/showproduct.php';
        } else if (isset($_POST['cancel'])) {
            header("Location:admincp.php?manager=product&action=listProduct");
        } else {
            $results['product'] = new Product();
            $results['product'] = ProductModel::getById($product_id);
            $data = CategoryModel::getAllCategory();
            $results['categories'] = $data['results'];
            $data = SubproductModel::getByproductId($product_id);
            $results['subproducts'] = $data['results'];

            require APPLICATION_PATH . '/views/admin/editProduct.php';
        }
    }

    /*
     * 
     */

    public function deleteProduct() {
        if (isset($_GET['product_id'])) {
            ProductModel::delete($_GET['product_id']);
            SubproductModel::deleteByProductId($_GET['product_id']);
            CommentModel::deleteByProductId($_GET['product_id']);
            header("Location:admincp.php?manager=product&deleteStatus=1");
        }
        else
            header("Location:admincp.php?manager=product&action=listProduct");
    }

    public function deleteComment() {
        if (isset($_GET['comment_id'])) {
            CommentModel::delete($_GET['comment_id']);
            ResponseModel::deleteByCommentId($_GET['comment_id']);
            $product_id = $_GET['product_id'];
            $url = "admincp.php?manager=product&action=listComment&product_id=" . $product_id . "&deleteStatus=1";
            header("Location:$url");
        }
        else
            header("Location:admincp.php?manager=product");
    }

    public function deleteListComment() {
        if (isset($_GET['listComment'])) {
            $list = array();
            $list = explode(",", $_GET['listComment']);
            for ($index = 0; $index < count($list); $index++) {
                CommentModel::delete($list[$index]);
                ResponseModel::deleteByCommentId($list[$index]);
            }
            $product_id = $_GET['product_id'];
            $url = "admincp.php?manager=product&action=listComment&product_id=" . $product_id . "&deleteStatus=1";
            header("Location:$url");
        }
        else
            header("Location:admincp.php?manager=product");
    }

    /*
     * 
     */

    public function deleteListProduct() {
        if (isset($_GET['listProduct'])) {
            $list = array();
            $list = explode(",", $_GET['listProduct']);
            for ($index = 0; $index < count($list); $index++) {
                ProductModel::delete($list[$index]);
                SubproductModel::deleteByProductId($list[$index]);
                CommentModel::deleteByProductId($list[$index]);
            }
            header("Location:admincp.php?manager=product&deleteStatus=1");
        }
        else
            header("Location:admincp.php?manager=product&action=listProduct");
    }

    /*
     * 
     */

    public function checkProductNameAjax() {
        if (isset($_GET['product_name'])) {
            $product_nameX = Tool::changeTitle($_GET['product_name']);
            $results = ProductModel::checkNameX($product_nameX, $_GET['product_id']);
            if ($results != 0)
                echo "1";
            else
                echo "0";
        }
        else
            header("Location:admincp.php?manager=product");
    }

    public function previewProduct() {
        if (isset($_POST['preview'])) {
            
        }
    }

}

?>
