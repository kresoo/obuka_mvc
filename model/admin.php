<?php

class Model_Admin extends Model_baseModel {

    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $password;
    public $email;
    public $errorArray = array();
    public static $table_name = "admin";
    public static $table_fields = array("id", "firstname", "lastname", "username", "password", "email");

    public function __toString() {
        return $this->firstname . " " . $this->lastname;
    }

    public  function authenticate($username, $password) {

        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " WHERE username = '" . $username . "' AND password = '" . md5($password) . "' LIMIT 1";
        $result = $this->findBySql($sql);
        return (!empty($result)) ? array_shift($result) : false;
    }
}

