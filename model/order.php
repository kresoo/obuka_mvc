<?php

class Model_Order extends baseModel {

    public $id;
    public $total_price;
    public $items;
    public $customer_info;
    public $shipping_info;
    public $payment_info;
    public $user_id;
    public static $table_name = "orders";
    public static $table_fields = array("id", "total_price", "items", "customer_info", "shipping_info", "payment_info", "user_id");

    

    public static function findOrdersByUserId($user_id) {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE user_id = " . $user_id;
        return static::findBySql($sql);
    }

    
    public function search($searchData) {
        if ($searchData['search_by'] == "total_price") {
            if (empty($searchData['price_from']) || empty($searchData['price_to'])) {
                return false;
            }
            if (!is_numeric($searchData['price_from']) || !is_numeric($searchData['price_to'])) {
                return false;
            }
            if ($searchData['price_from'] < 0 || $searchData['price_to'] < 0) {
                return false;
            }
            $sql = "SELECT * FROM orders WHERE " . $searchData['search_by'] . " BETWEEN " . $searchData['price_from'] . " AND " . $searchData['price_to'];
            $result = $this->findBySql($sql);
            //$result = serialize($resultTemp);
            if (!$result) {
                return false;
            } elseif ($result) {
                foreach ($result as $order){
                    $order->items = unserialize($order->items);
                    $order->customer_info = unserialize($order->customer_info);
                }
                return $result;
            }
        
        } elseif ($searchData['search_by'] == "customer_name") {
            if (empty($searchData['search_field'])) {
               return false;
            }
            $allOrders = $this->findAll();
            $orders = array();
            foreach ($allOrders as $order) {
                $order->customer_info = unserialize($order->customer_info);
                $order->items = unserialize($order->items);
            }
            foreach ($allOrders as $order) {
                if (strlen(stristr($order->customer_info[0], $searchData['search_field']))) {
                    $orders[] = $order;
                }
            }

            if (empty($orders)) {
               return false;
            } else {
                return $orders;
            }
        } elseif ($searchData['search_by'] == "customer_email") {
            if (empty($searchData['search_field'])) {
                return false;
            }
            $allOrders = $this->findAll();
            $orders = array();
            foreach ($allOrders as $order) {
                $order->customer_info = unserialize($order->customer_info);
                $order->items = unserialize($order->items);
            }
            foreach ($allOrders as $order) {
                if (strlen(stristr($order->customer_info[1], $searchData['search_field']))) {
                    $orders[] = $order;
                }
            }

            if (empty($orders)) {
                return false;
            } else {
               return $orders;
            }
        } else {
            if (empty($searchData['search_field'])) {
                return false;
            }

            $sql = "SELECT * FROM orders WHERE " . $searchData['search_by'] . " = '" . $searchData['search_field'] . "'";

            $result = $this->findBySql($sql);
            if (!$result) {
                return false;
            } elseif ($result) {
                foreach ($result as $order){
                    $order->customer_info = unserialize($order->customer_info);
                    $order->items = unserialize($order->items);
                }
                   return $result;
            }
        }
    }
    
    } //end of class
    
 
