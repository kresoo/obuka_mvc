<?php

class Model_Category extends baseModel {

    public $id;
    public $name;
    
    public static $table_name = "category";
    public static $table_fields = array("id", "name");

    public function verifyCat($name)
    {
        if(empty($name)){
            return false;
        }
        $sql = "SELECT name FROM " . static::$table_name . " WHERE name = " . $name;
        $result = $this->query($sql);
        if($result){
            return false;
        } else {
            return true;
        }
    }
}

