<?php
require_once '../Model/Vehiculo.php';
require_once 'Conexion.php';

class VehiculoController {
    
        public static function recuperarTodasDe($mat) {
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from vehiculo where matricula='$mat'");
            if ($result->rowCount()) {
                while ($reg = $result->fetchObject()) {
                    $i = new Itvs($reg->id,$reg->provincia,$reg->localidad, $reg->direccion, $reg->telefono);
                    $itvs[] = $i;
                }
            }
            else {
                $itvs = $result->rowCount();
            }
        } catch (PDOException $ex) {
            $itvs = false;
            echo $ex->getMessage();
        }
        return $itvs;
    }
    
    
    public static function buscarVehiculo($mat) {
        try {
            $conex=new Conexion();
            $result = $conex->query("select * from vehiculo where matricula='$mat'");
            if ($result->rowCount()) {
                $reg = $result->fetchObject();
                $v = new Vehiculo($reg->matricula,$reg->marca,$reg->modelo, $reg->color, $reg->plazas, $reg->fecha_ultima_revision); 
            }
            else {
                $v = $result->rowCount();
            }
        } catch (PDOException $ex) {
            $v = false;
            echo $ex->getMessage();
        }
        return $v;
    }
    
}