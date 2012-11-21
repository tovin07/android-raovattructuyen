<?php

/*
 * @author QuangTuan
 */
require APPLICATION_PATH . '/models/logic/ProductModel.php';
require APPLICATION_PATH . '/models/logic/CommentModel.php';
require APPLICATION_PATH . '/models/logic/ResponseModel.php';
require APPLICATION_PATH . '/models/logic/SubproductModel.php';
require APPLICATION_PATH . '/models/logic/ManufactureModel.php';
require APPLICATION_PATH . '/models/logic/CategoryModel.php';
require APPLICATION_PATH . '/models/logic/SettingModel.php';
require APPLICATION_PATH . '/models/logic/ContactModel.php';
require APPLICATION_PATH . '/models/logic/InfoModel.php';

class IndexControllerAction {

    public function init() {
        
    }

    /*
     * 
     */

    public function homepage() {
        $results = array();
        $data = ProductModel::getTopLatest(16);
        $results['products'] = $data['results'];
        $results['setting'] = SettingModel::getSetting();
        require APPLICATION_PATH . '/views/defaults/homepage.php';
    }

    public function showProduct() {
        if (!isset($_GET['nameX']))
            header("location: /");
        $product_nameX = $_GET['nameX'];
        $results = array();
        $results['product'] = new Product();
        $results['product'] = ProductModel::getByProduct_nameX($product_nameX);
        $product_id = $results['product']->getProduct_id();
        if ($results['product'] == null)
            header("location: /");
        $results['canonical'] = 0;

        $visitCount = $results['product']->getProduct_visitCount();
        $results['product']->setProduct_visitCount($visitCount + 1);
        $product_id = $results['product']->getProduct_id();
        ProductModel::update($product_id, $results['product']);
        if ($results['product']->getProduct_titleDisplay() != "")
            $results['titlePage'] = $results['product']->getProduct_titleDisplay();
        else
            $results['titlePage'] = $results['product']->getProduct_name() . " | " . NAME_WEBSITE;
        $results['tagDescription'] = $results['product']->getProduct_tagDescription();
        $results['tagKeywords'] = $results['product']->getProduct_tagKeywords();

        $avatar = $results['product']->getProduct_avatar() != "" ? $results['product']->getProduct_avatar() : ROOT_PATH . "public/images/not_photo.jpg";
        $results['rate'] = $results['product']->getProduct_rate();
        $results['ratespan'] = "";
        switch ($results['rate']) {
            case "0" :
                $results['ratespan'] = "zero";
                break;
            case "0.5" :
                $results['ratespan'] = "zero_";
                break;
            case "1" :
                $results['ratespan'] = "one";
                break;
            case "1.5" :
                $results['ratespan'] = "one_";
                break;
            case "2" :
                $results['ratespan'] = "two";
                break;
            case "2.5" :
                $results['ratespan'] = "two_";
                break;
            case "3" :
                $results['ratespan'] = "three";
                break;
            case "3.5" :
                $results['ratespan'] = "three_";
                break;
            case "4" :
                $results['ratespan'] = "four";
                break;
            case "4.5" :
                $results['ratespan'] = "four_";
                break;
            case "5" :
                $results['ratespan'] = "five";
                break;
        }
        $data = SubproductModel::getByproductId($product_id);
        $results['subproducts'] = $data['results'];

        $product_content = $results['product']->getProduct_content();

        $subproduct_patterm = "/\[(\d+)\]/";
        while (preg_match($subproduct_patterm, $product_content, $matches)) {
            $subproduct_order = $matches[1];
            $tmp_subproduct = SubproductModel::getByProductIdOrder($product_id, $subproduct_order);
            if ($tmp_subproduct == null){
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

        $data = CategoryModel::getAllCategory(8);
        $results['categories'] = $data['results'];
        $data = CommentModel::getByProductId($product_id);
        $results['commentProducts'] = $data['results'];
        $results['setting'] = SettingModel::getSetting();
        require APPLICATION_PATH . '/views/defaults/showproduct.php';
    }

    public function showArticle() {
        if (!isset($_GET['titleX']))
            header("location: /");
        $article_titleX = $_GET['titleX'];
        $results = array();
        $results['article'] = new Article();
        $results['article'] = ArticleModel::getByArticle_titleX($article_titleX);
        $article_id = $results['article']->getArticle_id();
        if ($results['article'] == null)
            header("location: /");

        $data = CategoryModel::getAllCategory();
        $results['categories'] = $data['results'];
        $results['canonical'] = 0;

        $visitCount = $results['article']->getArticle_visitCount();
        $results['article']->setArticle_visitCount($visitCount + 1);
        ArticleModel::update($results['article']->getArticle_id(), $results['article']);
        if ($results['article']->getArticle_titleDisplay() != "")
            $results['titlePage'] = $results['article']->getArticle_titleDisplay();
        else
            $results['titlePage'] = $results['article']->getArticle_title() . " | " . NAME_WEBSITE;
        $results['tagDescription'] = $results['article']->getArticle_description();
        $results['tagKeywords'] = $results['article']->getArticle_tagKeywords();

        $avatar = $results['article']->getArticle_avatar() != "" ? $results['article']->getArticle_avatar() : ROOT_PATH . "public/images/not_photo.jpg";

        $catarticle_id = $results['article']->getCatarticle_id();
        $results['catarticle'] = CatarticleModel::getById($catarticle_id);
        $results['parent'] = CategoryModel::getById($results['catarticle']->getCatarticle_parent());
        $data = ArticleModel::getTopLatest(5);
        $results['latest-news'] = $data['results'];
        $data = ArticleModel::getListByCatarticle_id($catarticle_id, 15);
        $results['relative_news'] = $data['results'];
        $data = CatarticleModel::getAllCatarticle();
        $results['catarticles'] = $data['results'];
        require APPLICATION_PATH . '/views/defaults/showArticle.php';
    }

    public function showCatarticle() {
        if (!isset($_GET['catarticle_nameX']))
            header("location: /");
        $catarticle_nameX = $_GET['catarticle_nameX'];
        $results = array();
        $results['catarticle_nameX'] = $catarticle_nameX;
        $results['catarticle'] = new Catarticle();
        $results['catarticle'] = CatarticleModel::getByCatarticleNameX($catarticle_nameX);
        if ($results['catarticle'] == null)
            header("location: /");

        $data = CategoryModel::getAllCategory();
        $results['categories'] = $data['results'];
        $catarticle_id = $results['catarticle']->getCatarticle_id();
        $results['titlePage'] = $results['catarticle']->getCatarticle_name() . " | " . NAME_WEBSITE;


        $page = 1;
        if (isset($_GET['page']))
            $page = $_GET['page'];
        $NUMER_ARTICLE_PERPAGE = 6;
        $data = ArticleModel::getListByCatarticle_idPage($catarticle_id, $page, $NUMER_ARTICLE_PERPAGE);
        if ($page == 0)
            $data = ArticleModel::getListByCatarticleId($catarticle_id);
        $results['articles'] = $data['results'];
        $totalRows = $data['totalRows'];

        if ($totalRows % $NUMER_ARTICLE_PERPAGE == 0)
            $results['numPage'] = (int) ($totalRows / $NUMER_ARTICLE_PERPAGE);
        else
            $results['numPage'] = (int) ($totalRows / $NUMER_ARTICLE_PERPAGE) + 1;

        $results['parent'] = CatarticleModel::getById($results['catarticle']->getCatarticle_parent());
        $data = CatarticleModel::getAllCatarticle();
        $results['catarticles'] = $data['results'];
        $data = ArticleModel::getTopLatest(5);
        $results['latest-news'] = $data['results'];
        $data = MenuModel::getAllMenusView(8);
        $results['menus'] = $data['results'];
        $data = TopmenuModel::getAllTopmenusView(5);
        $results['topmenus'] = $data['results'];
        require APPLICATION_PATH . '/views/defaults/showCatarticle.php';
    }

    public function showCategory() {
        if (!isset($_GET['category_nameX']))
            header("location: /");
        $category_nameX = $_GET['category_nameX'];
        $results = array();
        $results['category_nameX'] = $category_nameX;
        $results['category'] = new Category();
        $results['category'] = CategoryModel::getByCategoryNameX($category_nameX);
        if ($results['category'] == null)
            header("location: /");
        $category_id = $results['category']->getCategory_id();
        $results['titlePage'] = $results['category']->getCategory_name() . " | " . NAME_WEBSITE;


        $page = 1;
        if (isset($_GET['page']))
            $page = $_GET['page'];
        $NUMER_ARTICLE_PERPAGE = 16;
        if (isset($_GET['min']) && isset($_GET['max'])) {
            $data = ProductModel::getListByPrice($category_id, $_GET['min'], $_GET['max']);
        } else if (isset($_GET['manufacture_nameX'])) {
            $manufacture_id = ManufactureModel::getByManufactureNameX($_GET['manufacture_nameX'])->getManufacture_id();
            $data = ProductModel::getListByNSX($category_id, $manufacture_id);
        } else {
            $data = ProductModel::getListByCategoryIdPage($category_id, $page, $NUMER_ARTICLE_PERPAGE);
            if ($page == 0)
                $data = ProductModel::getListByCategoryId($category_id);
        }
        $results['products'] = $data['results'];
        $totalRows = $data['totalRows'];

        if ($totalRows % $NUMER_ARTICLE_PERPAGE == 0)
            $results['numPage'] = (int) ($totalRows / $NUMER_ARTICLE_PERPAGE);
        else
            $results['numPage'] = (int) ($totalRows / $NUMER_ARTICLE_PERPAGE) + 1;

        if ($results['category']->getCategory_parent() != 0)
            $results['parent'] = CategoryModel::getById($results['category']->getCategory_parent());
        $results['setting'] = SettingModel::getSetting();
        require APPLICATION_PATH . '/views/defaults/showCategory.php';
    }

    public function showcatsajax() {
        if (isset($_GET['value'])) {
            $results = array();
            $value = $_GET['value'];
            $category_id = $_GET['category_id'];
            $data = ProductModel::searchByNameInCategoryId($category_id, $value);
            $results['products'] = $data['results'];
            require APPLICATION_PATH . '/views/defaults/showcatsajax.php';
        }
    }

    public function postCommentAjax() {
        if (isset($_GET['product_id']) && isset($_GET['subproduct_order'])) {
            $product_id = $_GET['product_id'];
            $subproduct_order = $_GET['subproduct_order'];
            $content = $_GET['content'];
            $comment_tel = $_GET['comment_tel'];
            $pubDate = mktime();
            $comment = new Comment();
            $comment->setComment_content($content);
            $comment->setComment_publicationDate($pubDate);
            $comment->setProduct_id($product_id);
            $comment->setSubproduct_order($subproduct_order);
            $comment->setComment_tel($comment_tel);
            CommentModel::insert($comment);
            $subproduct = SubproductModel::getByProductIdOrder($product_id, $subproduct_order);
            require APPLICATION_PATH . '/views/defaults/postCommentAjax.php';
        }
    }

    public function postCommentProductAjax() {
        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $comment_tel = $_GET['comment_tel'];
            $content = $_GET['content'];
            $pubDate = mktime();
            $comment = new Comment();
            $comment->setComment_content($content);
            $comment->setComment_publicationDate($pubDate);
            $comment->setProduct_id($product_id);
            $comment->setSubproduct_order("");
            $comment->setComment_tel($comment_tel);
            CommentModel::insert($comment);
            require APPLICATION_PATH . '/views/defaults/postCommentProductAjax.php';
        }
    }

    public function loadCommentAjax() {
        if (isset($_GET['product_id']) && isset($_GET['subproduct_order'])) {
            $results = array();
            $product_id = $_GET['product_id'];
            $subproduct_order = $_GET['subproduct_order'];
            $data = CommentModel::getByProductId_SubproductOrder($product_id, $subproduct_order);
            $results['comments'] = $data['results'];
            $subproduct = SubproductModel::getByProductIdOrder($product_id, $subproduct_order);
            $subproduct_thumb = $subproduct->getSubproduct_thumb();
            $subproduct_name = $subproduct->getSubproduct_name();
            $subproduct_price = $subproduct->getSubproduct_price();
            require APPLICATION_PATH . '/views/defaults/loadCommentAjax.php';
        }
    }

    public function lienhe() {
        $results= array();
        $results['contact']= ContactModel::getContact();
        require APPLICATION_PATH . '/views/defaults/contact.php';
    }
    public function gioithieu() {
        $results= array();
        $results['info']= InfoModel::getInfo();
        require APPLICATION_PATH . '/views/defaults/info.php';
    }

    public function showCart() {
        $results = array();
        $results['titlePage'] = "Giỏ hàng";

        $data = ProductModel::getTopView(5);
        $results['hot-product'] = $data['results'];
        $data = MenuModel::getAllMenusView(8);
        $results['menus'] = $data['results'];
        $data = TopmenuModel::getAllTopmenusView(5);
        $results['topmenus'] = $data['results'];
        require 'application/views/defaults/showCart.php';
    }

    public function updateCart() {
        $results = array();
        $results['titlePage'] = "Giỏ hàng";

        $data = ProductModel::getTopView(5);
        $results['hot-product'] = $data['results'];
        $data = MenuModel::getAllMenusView(8);
        $results['menus'] = $data['results'];
        $data = TopmenuModel::getAllTopmenusView(5);
        $results['topmenus'] = $data['results'];

        $count = count($_SESSION['cart']);

        if (isset($_POST['update'])) {
            for ($i = 0; $i < $count; $i++) {
                $amount = "amount_";
                $_SESSION['cart'][$i]['qlt'] = $_POST[$amount . $i];
            }

            for ($i = 0; $i < $count; $i++) {
                $id = $_SESSION['cart'][$i]['product_id'];
                if (isset($_POST['checkDelete'])) {
                    foreach ($_POST['checkDelete'] as $value) {
                        if ($id == $value) {
                            array_splice($_SESSION['cart'], $i, 1);
                            $i--;
                            $count--;
                            break;
                        }
                    }
                }
            }
        }
        if (isset($_POST['delete'])) {
            $_SESSION['cart'] = array();
        }

        require 'application/views/defaults/showCart.php';
    }

    public function sitemaps() {
        require APPLICATION_PATH . '/views/defaults/sitemaps.php';
    }

    public function validate() {
        require 'google9bb928df49b4de6c.html';
    }

    /*
     * 
     */

    public function insertRss() {
        require_once('../simplepie/php/autoloader.php');

        // We'll process this feed with all of the default options.
        $feed = new SimplePie();

        // Set which feed to process.
        $feed->set_feed_url('http://www.Bongda.com.vn/Rss/');

        $feed->set_cache_location('../simplepie/cache');

        // Run SimplePie.
        $feed->init();

        // This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
        $feed->handle_content_type();

        // Let's begin our XHTML webpage code.  The DOCTYPE is supposed to be the very first thing, so we'll keep it on the same line as the closing-PHP tag.

        foreach ($feed->get_items() as $item) {
            $article = new Product();
            $article->setTitle($item->get_title());
            $article->setTitleX(Tool::changeTitle($item->get_title()));
            $article->setDescription($item->get_description());
            ProductModel::insert($article);
        }

        require APPLICATION_PATH . '/views/defaults/homepage.php';
    }

    public function tintuc() {
        require 'application/views/defaults/tintuc.php';
    }

    public function baiviet() {
        require 'application/views/defaults/showProduct.php';
    }

    public function chude() {
        require 'application/views/defaults/showCats.php';
    }

}

?>
