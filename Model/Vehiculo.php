<?php

class Vehiculo {
    private $matricula;
    private $marca;
    private $modelo;
    private $color;
    private $plazas;
    private $fechaUltimaRevision;
    
    public function __construct($matricula, $marca, $modelo, $color, $plazas, $fecha) {
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->color = $color;
        $this->plazas = $plazas;
        $this->fechaUltimaRevision = $fecha;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name=$value;
    }
    
}