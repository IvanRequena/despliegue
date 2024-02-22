<?php
class Conexion extends PDO {
    private $host="mysql:host=localhost;dbname=itv;charset=utf8mb4";
    private $usu="dwes";
    private $pass="abc123.";
    
    public function __construct() {
        parent::__construct($this->host, $this->usu, $this->pass);
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name=$value;
    }
}
