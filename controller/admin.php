<?php

class Controller_Admin extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);
            $this->_render(array("admin" => $admin));
        } else {
            header("Location: /login/index");
        }
    }

    public function allCat() {
       if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);
            
            $category = new Model_Category;
            $allCategories = $category->findAll();
            $this->_render(array("admin" => $admin, "allCategories" => $allCategories));
        } else {
            header("Location: /login/index");
        }
    }

    public function allProd() {
       if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);
            
            $products = new Model_Product();
            $allProducts = $products->findAll();
            $this->_render(array("admin" => $admin, "allProducts" => $allProducts));
        } else {
            header("Location: /login/index");
        }
    }

    public function createCat() {
        if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);
            
            if (empty($_POST['create_category'])) {
                $this->_render(array("admin" => $admin));
            } else {
                $catName = $_POST['name'];
                $category = new Model_Category();
                $catVerify = $category->verifyCat($catName);
                if ($catVerify) {
                    $category->name = $catName;
                    $category->insert();
                    header("Location: allCat");
                    exit;
                } else {
                    header("Location: createCat");
                    exit;
                }
            }
        } else{
            header("Location: /login/index");
            exit;
        }
    }

    public function changeCatName() {
        if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);
            
            if (!empty($_GET['cid'])) {
                $cat = new Model_Category();
                $category = $cat->findById($_GET['cid']);
                $this->_render(array("admin" => $admin,"category" => $category));
            } else {
                if (!empty($_POST['category_change'])) {
                    $catName = $_POST['category_name'];
                    $catId = $_POST['category_id'];
                    $category = new Model_Category();
                    $catVerify = $category->verifyCat($catName);
                    if ($catVerify) {
                        $category->name = $catName;
                        $category->id = $catId;
                        $category->update();
                        header("Location: allCat");
                        exit;
                    } elseif(!$catVerify) {
                        header("Location: changeCatName?cid={$catId}");
                        exit;
                    }
                }
            }
        }else {
            header("Location: /login/index");
        }
    }

    public function changeProdProp() {
      if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);
            
            if (!empty($_GET['pid'])) {
                $prod = new Model_Product();
                $product = $prod->findById($_GET['pid']);
                $this->_render(array("admin" => $admin,"product" => $product));
            } else {
                if (!empty($_POST['product_change'])) {
                    $product = new Model_Product();
                    $prodVerify = $product->verifyProd($_POST);
                    if ($prodVerify) {
                        if ($product->attachAttributes($_POST)) {
                            $product->update();
                            header("Location: allProd");
                            exit;
                        }
                    } else {
                        header("Location: changeProdProp?pid={$_POST['id']}");
                    }
                }
            }
      } else {
          header("Location: /login/index");
      }
    }

    public function createProd() {
       if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);
            
            if (empty($_POST['create_product'])) {
                $this->_render(array("admin" => $admin));
            } else {
                $product = new Model_Product();
                $productVerify = $product->verifyProd($_POST);
                if($productVerify){
                    if($product->attachAttributes($_POST)){
                        $product->insert();
                        header("Location: allProd");
                        exit;
                    }
                } else {
                    header("Location: createProd");
                }
            }
       } else {
            header("Location: /login/index");
       }
    }

    public function viewAllOrders() {
        if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);
            
            $order = new Model_Order();
            $allOrders = $order->findAll();
            foreach ($allOrders as $order) {
                $order->items = unserialize($order->items);
            }

            $this->_render(array("admin" => $admin,'allOrders' => $allOrders));
        } else {
            header("Location: /login/index");
        }
    }

    public function searchOrders() {
        if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);

            if(empty($_GET['search'])){
                $this->_render(array("admin" => $admin));
            } else {
                $order = new Model_Order();
                $result = $order->search($_GET);
                $this->_render(array ("admin" => $admin,"result" => $result));
            }
        } else {
            header("Location: /login/index");
        }
    }

    public function logout() {
        $this->logoutUser();
        header("Location: /login/index");
        exit;
    }


}

?>
