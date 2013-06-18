<?php

class Model_Category extends baseModel {

    public $id;
    public $name;
    public static $table_name = "category";
    public static $table_fields = array("id", "name");

    public function verifyCat(){
        
    }
}

