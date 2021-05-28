<?php

class Conexion{

    private static $conexion;  // al ser una variable estática se debe acceder con "::"

    public static function abrir_conexion(){
        //if (!isset(self::conexion)){
        if (self::$conexion== null){
            try {
                include_once 'config.inc.php';

                //mysqli -> conexión sólo para mysql
                //pdo -> se puede conectar a varias bases de datos
                self::$conexion = new PDO('mysql:host='.NOMBRE_SERVIDOR.'; dbname='.NOMBRE_DB,NOMBRE_USUARIO, PASSWORD);
                
                //si pasa un error, entonces pdo largará una excepción y nos la pasará 
                self::$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                self::$conexion -> exec("SET CHARACTER SET utf8");

            } catch (PDOException $ex) {
                print "Error: " . $ex -> getMessage() . "<br>";
                die();
            }
        }
    }

    public static function cerrar_conexion(){
        //if (isset(self::conexion)){
        if (!(self::$conexion== null)){
            self::$conexion = null;
        }
    }

    public static function obtener_conexion(){
        return self::$conexion;
    }
}