<?php

require_once 'require.php';

//process category changes
if (!empty($_POST['category_change'])) {
    if (empty($_POST['category_name'])) {
        $session->message("Category name can not be empty.");
        redirect("../admin_main.php?cid={$_POST['category_id']}");
    } else {
        $sql = "SELECT * FROM category WHERE name = '" . $_POST['category_name'] . "'";
        $category = Category::findBySql($sql);
        if ($category) {
            $session->message("Category name is the same as before.");
            redirect("../admin_main.php?cid={$_POST['category_id']}");
        } else {
            $sql = "UPDATE category SET name = '" . $_POST['category_name'] . "' WHERE id=" . $_POST['category_id'];
            global $database;
            $database->query($sql);
            redirect("../admin_main.php?allCat");
        }
    }
}

//process product changes
if (!empty($_POST['product_change'])) {
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $session->message("You must provide all product attributes.");
            redirect("../admin_main.php?pid={$_POST['id']}");
        }
    }
    if (!is_numeric($_POST['price'])) {
        $session->message("Product price must be a number.");
        redirect("../admin_main.php?pid={$_POST['id']}");
    }
    if ($_POST['price'] < 0) {
        $session->message("Price cant be negative.");
        redirect("../admin_main.php?pid={$_POST['id']}");
    }

    if (!is_numeric($_POST['qty'])) {
        $session->message("Product quantity must be a number.");
        redirect("../admin_main.php?pid={$_POST['id']}");
    }

    if ($_POST['qty'] < 0) {
        $session->message("Product quantity cant be negative.");
        redirect("../admin_main.php?pid={$_POST['id']}");
    }
    $sql = "SELECT barcode FROM product WHERE id != {$_POST['id']}";
    global $database;
    $result = $database->query($sql);
    while ($barcode = $database->fetch($result)) {
        if ($barcode[0] == $_POST['barcode']) {
            $session->message("Product with entered barcode already exsists.");
            redirect("Location: ../admin_main.php?pid={$_POST['id']}");
        }
    }
    $productUpdate = new Product();
    foreach ($_POST as $key => $value) {
        if ($key == "product_change" || $key == "category_id") {
            continue;
        }
        $productUpdate->$key = $value;
    }
    $productUpdate->category_id = implode(",", $_POST['category_id']);
    if ($productUpdate->update()) {
        redirect("../admin_main.php?allProd");
    }
}

//create category
if (!empty($_POST['create_category'])) {
    if (empty($_POST['name'])) {
        $session->message("Category name cant be empty.");
        redirect("../admin_main.php?createCat");
    }
    $sql = "SELECT name FROM category WHERE name = " . $_POST['name'];
    global $database;
    $result = $database->query($sql);
    if (!$result) {
        $session->message("Category name already exists.");
        redirect("../admin_main.php?createCat");
    }
    $category = new Category();
    $category->name = $_POST['name'];
    if ($category->insert()) {
        redirect("../admin_main.php?allCat");
    }
}

//create product
if (!empty($_POST['create_product'])) {
    //print_r($_POST);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $session->message("Enter all fields.");
            redirect("../admin_main.php?createProd");
        }
    }
    if (!is_numeric($_POST['price'])) {
        $session->message("Product price must be a number.");
        redirect("../admin_main.php?createProd");
    }
    if ($_POST['price'] < 0) {
        $session->message("Price cant be negative.");
        redirect("../admin_main.php?createProd");
    }

    if (!is_numeric($_POST['qty'])) {
        $session->message("Product quantity must be a number.");
        redirect("../admin_main.php?createProd");
    }

    if ($_POST['qty'] < 0) {
        $session->message("Product quantity cant be negative.");
        redirect("../admin_main.php?createProd");
    }
    if (!isset($_POST['category_id'])) {
        $session->message("Choose at least one product category.");
        ;
        redirect("../admin_main.php?createProd");
    }
    $sql = "SELECT barcode FROM product";
    global $database;
    $result = $database->query($sql);
    while ($barcode = $database->fetch($result)) {
        if ($barcode[0] == $_POST['barcode']) {
            $session->message("Product with entered barcode already exsists.");
            redirect("../admin_main.php?createProd");
        }
    }

    $product = new Product();
    foreach ($_POST as $key => $value) {
        if ($key == "create_product" || $key == "category_id") {
            continue;
        }
        $product->$key = $value;
    }
    $categories = implode(",", $_POST['category_id']);
    $product->category_id = $categories;
    if ($product->insert()) {
        redirect("../admin_main.php?allProd");
    }
}

//handle search
if (!empty($_GET['search'])) {
    if ($_GET['search_by'] == "total_price") {
        if (empty($_GET['price_from']) || empty($_GET['price_to'])) {
            $session->message("Enter price range.");
            redirect("../admin_main.php?searchOrders");
        }
        if (!is_numeric($_GET['price_from']) || !is_numeric($_GET['price_to'])) {
            $session->message("Enter only numbers.");
            redirect("../admin_main.php?searchOrders");
        }
        if ($_GET['price_from'] < 0 || $_GET['price_to'] < 0) {
            $session->message("Enter only positive numbers.");
            redirect("../admin_main.php?searchOrders");
        }
        $sql = "SELECT * FROM orders WHERE " . $_GET['search_by'] . " BETWEEN " . $_GET['price_from'] . " AND " . $_GET['price_to'];
        $resultTemp = Order::findBySql($sql);
        $result = serialize($resultTemp);
        if (!$resultTemp) {
            $session->message("No orders found.");
            redirect("../admin_main.php?searchOrders");
        } elseif ($resultTemp) {
            $_SESSION['search_result'] = $result;
            redirect("../admin_main.php?searchOrders");
        }
    } elseif($_GET['search_by'] == "customer_name"){
        if(empty($_GET['search_field'])){
                $session->message("Enter search string.");
                redirect("../admin_main.php?searchOrders");
        }
        $allOrders = Order::findAll();
        $orders = array();
        foreach ($allOrders as $order) {
            $order->customer_info = unserialize($order->customer_info);
        }
        foreach ($allOrders as $order) {
            if (strlen(stristr($order->customer_info[0], $_GET['search_field']))) {
                $orders[] = $order;
            }
        }
        
//        echo "<pre>";
//        print_r($orders);
        if (empty($orders)) {
            $session->message("No orders found.");
            redirect("../admin_main.php?searchOrders");
        } else{
            $_SESSION['search_result'] = serialize($orders);
            redirect("../admin_main.php?searchOrders");
        }
    }  elseif($_GET['search_by'] == "customer_email"){
        if(empty($_GET['search_field'])){
                $session->message("Enter search string.");
                redirect("../admin_main.php?searchOrders");
        }
        $allOrders = Order::findAll();
        $orders = array();
        foreach ($allOrders as $order) {
            $order->customer_info = unserialize($order->customer_info);
        }
        foreach ($allOrders as $order) {
            if (strlen(stristr($order->customer_info[1], $_GET['search_field']))) {
                $orders[] = $order;
            }
        }
        
//        echo "<pre>";
//        print_r($orders);
        if (empty($orders)) {
            $session->message("No orders found.");
            redirect("../admin_main.php?searchOrders");
        } else{
            $_SESSION['search_result'] = serialize($orders);
            redirect("../admin_main.php?searchOrders");
        }
    } else {
        if(empty($_GET['search_field'])){
                $session->message("Enter search string.");
                redirect("../admin_main.php?searchOrders");
            }
        
        $sql = "SELECT * FROM orders WHERE " . $_GET['search_by'] . " = '" . $_GET['search_field'] . "'";

        $resultTemp = Order::findBySql($sql);
        $result = serialize($resultTemp);
        if (!$resultTemp) {
            $session->message("No orders found.");
            redirect("../admin_main.php?searchOrders");
        } elseif ($resultTemp) {
            $_SESSION['search_result'] = $result;
            redirect("../admin_main.php?searchOrders");
        }
    }
}
?>
