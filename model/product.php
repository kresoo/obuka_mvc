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

    public function verifyProd($attributes) {
        foreach ($attributes as $key => $value) {
            if (empty($value)) {
                return false;
            }
        }
        if (!is_numeric($attributes['price'])) {
            return false;
        }
        if ($_POST['price'] < 0) {
            return false;
        }

        if (!is_numeric($attributes['qty'])) {
            return false;
        }

        if ($_POST['qty'] < 0) {
            return false;
        }
        if(!empty($attributes['id'])){
            $sql = "SELECT barcode FROM product WHERE id != {$attributes['id']}";
        } else {
            $sql = "SELECT barcode FROM product";
        }
        $result = $this->query($sql);
        while ($barcode = $this->fetch($result)) {
            if ($barcode[0] == $attributes['barcode']) {
                return false;
            }
        }

        return true;
    }

    public function attachAttributes($attributes) {
        foreach ($attributes as $key => $value) {
            if ($key == "product_change" || $key == "category_id" || $key == "create_product") {
                continue;
            }
            $this->$key = $value;
        }
        $this->category_id = implode(",", $attributes['category_id']);
        return true;
    }

}

?>
