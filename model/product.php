<?php

class Model_Product extends Model_baseModel {

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
                $_SESSION['errors']['name'] = "You must provide all fields";
            }
        }
        if (!is_numeric($attributes['price'])) {
            $_SESSION['errors']['price_number'] = "Product price must be a number";
        }
        if ($attributes['price'] < 0) {
            $_SESSION['errors']['price_minus'] = "Product price must be a number";
        }

        if (!is_numeric($attributes['qty'])) {
            $_SESSION['errors']['qty_number'] = "Product quantity must be a number";
        }

        if ($attributes['qty'] < 0) {
            $_SESSION['errors']['qty_minus'] = "Product quantity must be a number";
        }

        if (!is_numeric($attributes['barcode'])) {
            $_SESSION['errors']['barcode_number'] = "Product barcode must be a number.";
        }

        if (empty($attributes['category_id'])) {
            $_SESSION['errors']['category'] = "Choose at least one product category.";
        }

        if (!empty($attributes['id'])) {
            $sql = "SELECT barcode FROM product WHERE id != {$attributes['id']}";
        } else {
            $sql = "SELECT barcode FROM product";
        }


        $result = $this->query($sql);
        while ($barcode = $this->fetch($result)) {
            if ($barcode[0] == $attributes['barcode']) {
                $_SESSION['errors']['barcode_exists'] = "Product with same barcode already exists";
            }
        }
        if (empty($_SESSION['errors'])) {
            return true;
        } else {
            return false;
        }
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
