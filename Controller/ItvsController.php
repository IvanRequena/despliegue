<?php
require_once '../Model/Itvs.php';
require_once 'Conexion.php';

class ItvsController {
    
    public static function buscarItv($id) {
        try {
            $conex=new Conexion();
            $result = $conex->query("select * from itvs where id='$id'");
            if ($result->rowCount()) {
                $reg = $result->fetchObject();
                $i = new Itvs($reg->id,$reg->provincia,$reg->localidad, $reg->direccion, $reg->telefono); 
            }
            else {
                $i = $result->rowCount();
            }
        } catch (PDOException $ex) {
            $i = false;
            echo $ex->getMessage();
        }
        return $i;
    }
    
    public static function recuperarTodas() {
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from itvs");
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
    
    public static function recuperarTodasDe($prov) {
        try {
            $conex = new Conexion();
            $result = $conex->query("select * from itvs where provincia='$prov'");
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
    
}