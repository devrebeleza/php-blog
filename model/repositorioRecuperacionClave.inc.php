<?php
    include_once 'recuperacionClave.inc.php';

    class RepositorioRecuperacionClave {

        public static function generar_peticion($conexion, $id_usuario, $url_secreta){
            $peticion_generada = false;

            if (isset($conexion)) {
                try {
                    $sql = "INSERT INTO recuperacion_clave (id_usuario, url_secreta, fecha) VALUES (:id_usuario, :url, NOW())";
                    $sentencia = $conexion -> prepare($sql);

                    $sentencia -> bindParam(":id_usuario",$id_usuario,PDO::PARAM_STR);
                    $sentencia -> bindParam(":url",$url_secreta,PDO::PARAM_STR);

                    $peticion_generada = $sentencia -> execute();

                } catch (PDOException $ex) {
                    print "Error: " . $ex->getMessage();
                }
            }
            return $peticion_generada;
        }

        public static function url_secreta_existe($conexion , $url_secreta){
            $url_existe = false;
        
            if (isset($conexion)) {
                try {
                    $sql = "SELECT * FROM recuperacion_clave WHERE url_secreta = :url";
                    $sentencia = $conexion->prepare($sql);
                   
                    $sentencia -> bindParam(':url', $url_secreta, PDO::PARAM_STR);
                    $sentencia -> execute();                
                    $resultado = $sentencia->fetchAll();
    
                    if (count($resultado)) {
                        $url_existe = true;
                    }
    
                } catch (PDOException $ex) {
                    print "Error: " . $ex->getMessage();
                }
            } 
            return $url_existe;
        } 

        public static function obtener_id_usuario_mediante_url_secreta($conexion , $url_secreta){
            $id_usuario = null;
        
            if (isset($conexion)) {
                try {
                    include_once "recuperacionClave.inc.php";

                    $sql = "SELECT * FROM recuperacion_clave WHERE url_secreta = :url";
                    $sentencia = $conexion->prepare($sql);
                   
                    $sentencia -> bindParam(':url', $url_secreta, PDO::PARAM_STR);
                    $sentencia -> execute();                
                    $resultado = $sentencia->fetch();
    
                    if (!empty($resultado)) {
                        $id_usuario = $resultado['id_usuario'];
                    }
    
                } catch (PDOException $ex) {
                    print "Error: " . $ex->getMessage();
                }
            } 
            return $id_usuario;
        } 

        public static function borrar_fila_por_url_secreta($conexion, $url_secreta){
            $url_eliminada = false;
        
            if (isset($conexion)) {
                try {
                    $sql = "DELETE FROM recuperacion_clave WHERE url_secreta = :url";
                    $sentencia = $conexion->prepare($sql);
                   
                    $sentencia -> bindParam(':url', $url_secreta, PDO::PARAM_STR);
                    $sentencia -> execute();                
                                          
                    $url_eliminada = true;
                        
                } catch (PDOException $ex) {
                    print "Error: " . $ex->getMessage();
                }
            } 
            return $url_eliminada;
        } 
    }