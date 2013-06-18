<?php

class Model_Product extends baseModel {

    public $id;
    public $name;
    public $description;
    public $price;
    public $barcode;
    public $qty;
    public $category_id;
    public static $table_name = "product";
    public static $table_fields = array("id", "name", "description", "price", "barcode", "qty", "category_id");

    public static function findProductsByCatId($category_id) {
        $sql = "SELECT * FROM " . static::$table_name . " WHERE category_id = " . $category_id;
        return static::findBySql($sql);
    }

    public static function findRandomProducts($numberOfProducts) {
        $sql = "SELECT * FROM " . static::$table_name . " ORDER BY RAND() LIMIT " . $numberOfProducts;
        return static::findBySql($sql);
    }

    public function serializeProducts($products) {
        $serializedProducts = array();
        foreach ($products as $product) {
            $sProduct = serialize($product);
            $serializedProducts[] = $sProduct;
        }
        return $serializedProducts;
    }

    public function changeAttributeValue($set) {
        foreach ($set as $id => $qty) {
            if ($this->id = $id) {
                $this->qty -= 1;
            }
        }
    }
 
    
}

?>
