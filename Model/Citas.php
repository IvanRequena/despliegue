<?php

class Citas {
    private $matricula;
    private $idItv;
    private $fecha;
    private $hora;
    private $ficha;
    
    public function __construct($matricula, $idItv, $fecha, $hora, $ficha) {
        $this->matricula = $matricula;
        $this->idItv = $idItv;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->ficha = $ficha;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name=$value;
    }
}