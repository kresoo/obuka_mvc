<?php

class Controller_Admin extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    public function index(){

            $this->_render();
 
    }
    
    public function allCat(){
        $category = new Model_Category;
        $allCategories = $category->findAll();
        $this->_render($allCategories);
    }

    public function allProd(){
        $products = new Model_Product();
        $allProducts = $products->findAll();
        $this->_render($allProducts);
    }

    public function createCat(){
        
        $this->_render();
    }
   public function changeCatName(){
        if(!empty($_GET['cid'])){
            $cat = new Model_Category();
            $category = $cat->findById($_GET['cid']);
            $this->_render(array ("category" => $category));
        } 
    }
    
    public function changeProdProp(){
        if(!empty($_GET['pid'])){
            $prod = new Model_Product();
            $product = $prod->findById($_GET['pid']);
            $this->_render(array ("product" => $product));
        }
        if(!empty($_POST['category_change'])){
            
        }
    }


    public function createProd(){
        $this->_render();
    }
    
    public function viewAllOrders(){
        $order = new Model_Order();
        $allOrders = $order->findAll();
        foreach ($allOrders as $order){
            $order->items = unserialize($order->items);
        }
       
        $this->_render(array('allOrders' => $allOrders));
    }

    public function searchOrders(){
        $this->_render();
    }


    public function logout(){
        $this->logoutUser();
        header("Location: /login/index");
        exit;
    }

    public function editCat(){
        if(!empty($_GET['cid'])){
            $category = new Model_Category();
            $category->verifyCat();
        } else {
            $this->_render(array ("error" => "Category name cant be empty"));
        }
    }
}
?>
