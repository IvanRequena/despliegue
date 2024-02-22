<?php
require_once '../Model/Usuario.php';
require_once 'Conexion.php';

class UsuarioController {
    
    public static function buscarUsuario($usu) {
        try {
            $conex=new Conexion();
            $result = $conex->query("select * from usuario where user='$usu'");
            if ($result->rowCount()) {
                $reg = $result->fetchObject();
                $u = new Usuario($reg->provincia,$reg->nombre,$reg->telefono, $reg->user, $reg->pass); 
            }
            else {
                $u = $result->rowCount();
            }
        } catch (PDOException $ex) {
            $u = false;
            echo $ex->getMessage();
        }
        return $u;
    }
    
}