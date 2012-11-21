<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductControllerAction
 *
 * @author misugi_jun91
 */
class ProductControllerAction {

    /**
     * checkproductname=1; co the dang ki
     * register=1; dang ki hoan tat
     */
    public function newProduct() {
        $respone = array();
        if (count($_POST)) {
            $product = new Product($_POST);
            $product_id = ProductModel::getProductIdMax() + 1;
            $product->setProduct_id($product_id);
            if (isset($_FILES['file']['name'])) {
                $avatar_name = $_FILES['file']['name'];
                $tmp_name = $_FILES['file']['tmp_name'];
                move_uploaded_file($tmp_name, "./public/uploads/$avatar_name");
                $avatar= "public/uploads/$avatar_name";
                $product->setProduct_avatar($avatar);
//                echo "aaa" . $_FILES['file']['name'];
            } else {
                $product->setProduct_avatar("public/images/noavatar.jpg");
            }
            
//            $image_count = count($_FILES['imageproduct']['name']);
//            if ($image_count > 0) {
//                for ($i = 0; $i < $image_count; $i++) {
//                    if ($_FILES['imageproduct']['name'][$i] != "") {
//                        $image_name = $_FILES['imageproduct']['name'][$i];
//                        $tmpimage_name = $_FILES['imageproduct']['tmp_name'][$i];
//                        $linkimage = ROOT_PATH . "public/uploads/$image_name";
//                        move_uploaded_file($tmpimage_name, $linkimage);
//
//                        $productimage = new Productimage();
//                        $productimage->setProduct_id($product_id);
//                        $productimage->setProductimage_link($linkimage);
//                        $thumbSourceName = str_replace(" ", "", $image_name);
//                        $thumbSourceName = str_replace("%", "", $image_name);
//                        $thumbSource = "../public/uploads/thumb/$thumbSourceName";
//                        Tool::createThumbImage($linkimage, $thumbSource, null, 100, 100);
//                        $thumb = ROOT_PATH . "public/uploads/thumb/$thumbSourceName";
//                        $productimage->setProductimage_thumb($thumb);
//                        ProductimageModel::insert($productimage);
//                    }
//                }
//            }

            $user_id = $_POST['user_id'];
            $pubDate = time();
            $product->setPost_publicationDate($pubDate);
            $result = ProductModel::insert($product);
           
            if ($result == 0) {
                $respone['result'] = 0;
                echo json_encode($respone);
                return;
            }
           
            
            
            $notification = new Notification();
            $notification->setPost_id($product_id);
            $notification->setUser_id($user_id);
            $result = NotificationModel::insert($notification);
            if ($result == 0) {
                $respone['result'] = 0;
                echo json_encode($respone);
                return;
            }
            $respone['result'] = 1;
            echo json_encode($respone);
        }
        echo json_encode($respone);
    }

    public function editProduct() {
        $respone = array();
        if (isset($_POST['submit'])) {
            $product_id = $_POST['product_id'];
            $product = new Product($_POST);
            $result = ProductModel::update($product_id, $product);
            $respone['result'] = $result;
            echo json_encode($respone);
        } else {
            if (isset($_POST['product_id'])) {
                $product_id = $_POST['product_id'];
                $product = ProductModel::getById($product_id);
                $respone['product'] = $product;
                echo json_encode($respone);
            }
        }
    }
    
    public function getFeed(){
        $respone =array();
        $maxid=  ProductModel::getProductIdMax();
        $respone['maxid']=$maxid;
        $result=  ProductModel::getAllProduct();
        $respone['product']=array();
        $respopne['user_name']=array();
        foreach ($result['results'] as $key){
            $uid =$key['user_id'];
            $user=  UserModel::getById($uid); 
            $respone['user_name'][]=$user['user_username'];
            $respone['product'][]=$key;
        }
       
        echo (json_encode($respone));
    }
    
    public function getPage(){
        $respone =array();
        $uid=$_GET['user_id'];
        $result=  ProductModel::getAllProductById($uid);
        $respone['product']=array();
        foreach ($result['results'] as $key){
            $respone['product'][]=$key;
        }
        echo (json_encode($respone));
        
    }
    
    public function loadMorePage(){
        $respone =array();
        $_page=$_GET['page'];
        $user_id=$_GET['user_id'];
        $data=ProductModel::getAllProductById($user_id,$page, 10);
        $respone['products']= $data['results'];
        $totalPage= $data['totalRows']/10;
        if ($_page >= $totalPage)
            $_page= 0;
        $respone['page']= $_page;
        echo (json_encode($respone));
    }
    
    public function loadMoreFeed(){
        $respone =array();
        $_page=$_GET['page'];
        $data=ProductModel::getAllProduct($_page, 10);
        $respone['products']= $data['results'];
        $totalPage= $data['totalRows']/10;
        if ($_page >= $totalPage)
            $_page= 0;
        $respone['page']= $_page;
        echo (json_encode($respone));
    }

}

?>
