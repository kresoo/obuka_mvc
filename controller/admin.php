<?php

class Controller_Admin extends Controller_BaseController {

    public function __construct($urlParts) {
        parent::__construct($urlParts);
    }

    public function index() {
        if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);
            $this->_render(array("admin" => $admin, "admin_html" => "/view/admin_html/admin_html.html"));
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
            $this->_render(array("admin" => $admin, "allCategories" => $allCategories, "admin_html" => "/view/admin_html/admin_html.html"));
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
            $this->_render(array("admin" => $admin, "allProducts" => $allProducts, "admin_html" => "/view/admin_html/admin_html.html"));
        } else {
            header("Location: /login/index");
        }
    }

    public function createCat() {
        if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);
            
            if (empty($_POST['create_category'])) {
                $this->_render(array("admin" => $admin, "admin_html" => "/view/admin_html/admin_html.html"));
            } else {
                $catName = $_POST['name'];
                $category = new Model_Category();
                $catVerify = $category->verifyCat($catName);
                if ($catVerify) {
                    $category->name = $catName;
                    $category->insert();
                    header("Location: /admin/allCat");
                    exit;
                } else {
                    header("Location: /admin/createCat");
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
            
            if (empty($_POST['category_change'])) {
                $cat = new Model_Category();
                $category = $cat->findById($this->params['id']);
                $this->_render(array("admin" => $admin,"category" => $category, "admin_html" => "/view/admin_html/admin_html.html"));
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
                        header("Location: /admin/allCat");
                        exit;
                    } elseif(!$catVerify) {
                        header("Location: /admin/changeCatName/id/{$catId}");
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
            
            if (empty($_POST['product_change'])) {
                $prod = new Model_Product();
                $product = $prod->findById($this->params['id']);
                $this->_render(array("admin" => $admin,"product" => $product, "admin_html" => "/view/admin_html/admin_html.html"));
            } else {
                if (!empty($_POST['product_change'])) {
                    $product = new Model_Product();
                    $prodVerify = $product->verifyProd($_POST);
                    if ($prodVerify) {
                        if ($product->attachAttributes($_POST)) {
                            $product->update();
                            header("Location: /admin/allProd");
                            exit;
                        }
                    } else {
                        header("Location: /admin/changeProdProp/id/{$_POST['id']}");
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
                $this->_render(array("admin" => $admin, "admin_html" => "/view/admin_html/admin_html.html"));
            } else {
                $product = new Model_Product();
                $productVerify = $product->verifyProd($_POST);
                if($productVerify){
                    if($product->attachAttributes($_POST)){
                        $product->insert();
                        header("Location: /admin/allProd");
                        exit;
                    }
                } else {
                    header("Location: /admin/createProd");
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
                $order->customer_info = unserialize($order->customer_info);
            }

            $this->_render(array("admin" => $admin,'allOrders' => $allOrders, "admin_html" => "/view/admin_html/admin_html.html"));
        } else {
            header("Location: /login/index");
        }
    }

    public function searchOrders() {
        if ($this->logged_in) {
            $userTemp = new Model_Admin();
            $admin = $userTemp->findById($this->admin_id);

            if(empty($_GET['search'])){
                $this->_render(array("admin" => $admin, "admin_html" => "/view/admin_html/admin_html.html"));
            } else {
                $order = new Model_Order();
                $result = $order->search($_GET);
                $this->_render(array ("admin" => $admin,"result" => $result, "admin_html" => "/view/admin_html/admin_html.html"));
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
