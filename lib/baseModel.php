<?php

class baseModel {

    protected $db;

    public function __construct() {
        $this->open_connection();
    }

    private function open_connection() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=obuka", 'root', '');
            $this->db->exec('set names utf8');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query($sql) {
        $result = $this->db->query($sql);
        return $result;
    }

    public function fetch($result_set) {
        $result = $result_set->fetch();
        return $result;
    }

    public function num_rows($result_set) {
        $result = $result_set->rowCount();
        return $result;
    }
    
    public function findById($id = 0) {
        $result = $this->findBySql("SELECT * FROM " . static::$table_name . " WHERE id={$id} LIMIT 1");
        return (!empty($result)) ? array_shift($result) : false;
    }

    public  function findAll() {
        return $this->findBySql("SELECT * FROM " . static::$table_name);
    }

    public  function findBySql($sql) {
        $object_array = array();
        $result_set = $this->db->query($sql);
        while ($row = $this->fetch($result_set)) {
            $object_array[] = $this->instantiate($row);
        }
        return $object_array;
    }

    private  function instantiate($record) {
        $class = get_called_class();
        $object = new $class;
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    protected function has_attribute($attribute) {
        return array_key_exists($attribute, $this->attributes()) ? true : false;
    }

    protected function attributes() {
        $attributes = array();
        foreach (static::$table_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    public function insert() {
        $attributes = $this->db->attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(",", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("','", array_values($attributes));
        $sql .= "')";
        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        $attributes = $this->attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $val) {
            $attribute_pairs[] = "{$key} = '{$val}'";
        }
        $sql = "UPDATE " . static :: $table_name . " SET ";
        $sql .= join(",", $attribute_pairs);
        $sql .= " WHERE id=" . $this->id;
        print_r($sql);
        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}