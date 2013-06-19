<?php

class Model_Category extends baseModel {

    public $id;
    public $name;
   
    public static $table_name = "category";
    public static $table_fields = array("id", "name");

    public function verifyCat($name)
    {
        if(empty($name)){
            $_SESSION['errors']['name'] = "Category name cant be empty.";
            return false;
        }
        $sql = "SELECT name FROM " . static::$table_name . " WHERE name = '" . $name . "'";
        $result = $this->query($sql);
        if($result){
             $_SESSION['errors']['exists'] = "Category with same name already exists.";
            return false;
        } elseif(!$result) {
            return true;
        }
    }
}

