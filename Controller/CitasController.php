<?php
require_once '../Model/Citas.php';
require_once 'Conexion.php';

class CitasController {
    
    public static function borrarCita($mat) {
        try {
            $conex = new Conexion();
            $conex->exec("delete from citas where matricula ='$mat'");
            $reg = 1;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $reg=false;
        }
        return $reg;
    }
    
    public static function insertarCita($c) {
        try {
            $conex = new Conexion();
            $conex->exec("insert into citas values ('$c->matricula', $c->idItv, $c->fecha, '$c->hora', '$c->ficha')");
            $reg = 1;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $reg=false;
        }
        return $reg;
    }
    
    public static function buscarCita($mat) {
        try {
            $conex=new Conexion();
            $result = $conex->query("select * from citas where matricula='$mat'");
            if ($result->rowCount()) {
                $reg = $result->fetchObject();
                $c = new Citas($reg->matricula,$reg->id_itv,$reg->fecha, $reg->hora, $reg->ficha); 
            }
            else {
                $c = $result->rowCount();
            }
        } catch (PDOException $ex) {
            $c = false;
            echo $ex->getMessage();
        }
        return $c;
    }
    
        public static function buscarCitaId($id) {
        try {
            $conex=new Conexion();
            $result = $conex->query("select * from citas where id_itv='$id'");
            if ($result->rowCount()) {
                $reg = $result->fetchObject();
                $c = new Citas($reg->matricula,$reg->id_itv,$reg->fecha, $reg->hora, $reg->ficha); 
            }
            else {
                $c = $result->rowCount();
            }
        } catch (PDOException $ex) {
            $c = false;
            echo $ex->getMessage();
        }
        return $c;
    }
    
        public static function recuperarTodasId($id) {
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from citas where id_itv='$id'");
            if ($result->rowCount()) {
                while ($reg = $result->fetchObject()) {
                    $c = new Citas($reg->matricula,$reg->id_itv,$reg->fecha, $reg->hora, $reg->ficha); 
                    $citas[] = $c;
                }
            }
            else {
                $citas = $result->rowCount();
            }
        } catch (PDOException $ex) {
            $citas = false;
            echo $ex->getMessage();
        }
        return $citas;
    }
    
}