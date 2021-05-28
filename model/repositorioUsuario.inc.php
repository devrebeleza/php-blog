<?php

include_once 'usuario.inc.php';

class RepositorioUsuario {

    public static function obtener_todos ($conexion){
        
        $usuarios = array();

        if(isset($conexion)){
            try {
                include_once 'usuario.inc.php';

                $sql = "SELECT * FROM usuarios";

                $sentencia = $conexion -> prepare($sql); // prepare elimina caracteres especiales 
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();

                if (count($resultado)) {
                    foreach  ($resultado as $fila) {
                        $usuarios[] = new Usuario(
                            $fila['id_usuario'], $fila['nombre'], $fila['email'], $fila['password'],$fila['fecha_registro'],$fila['activo']
                        );
                    }
                } else {
                    print 'No se encontraron Usuarios';
                }

            } catch (PDOException $ex) {
                print "Error al obtener los usuarios: " . $ex -> getMessage() . "<br>";
            }
        }
        return $usuarios;
    }

    public static function obtener_numero_usuarios ($conexion){
        
        $total_usuarios = null;

        if(isset($conexion)){
            try {
                 

                $sql = "SELECT count(1) as total FROM usuarios";

                $sentencia = $conexion -> prepare($sql); // prepare elimina caracteres especiales 
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();

                $total_usuarios = $resultado['total'];                

            } catch (PDOException $ex) {
                print "Error al contar los usuarios: " . $ex -> getMessage() . "<br>";
            }
        }
        return $total_usuarios;
    }

    public static function insertar_usuario($conexion, $usuario){
        $usuario_insertado = false;

        if(isset($conexion)){
            try {
                $sql = "INSERT INTO usuarios (nombre, email, password, fecha_registro, activo) Values (:nombre, :email,:password, now(),0)";
                $sentencia = $conexion -> prepare($sql);

                $nombre = $usuario->getNombre();
                $email = $usuario->getEmail();
                $pass = $usuario->getPassword();

                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia -> bindParam(':password', $pass, PDO::PARAM_STR);

                $usuario_insertado = $sentencia->execute();

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $usuario_insertado;
    }

    public static function nombre_existe($conexion, $nombre){
        $nombre_existe = true;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE nombre = :nombre";
                $sentencia = $conexion->prepare($sql);
               
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);                
                $sentencia -> execute();
                $resultado = $sentencia->fetchAll();

                if (!count($resultado)) {
                    $nombre_existe = false;
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        } 
        return $nombre_existe;
    }

    public static function email_existe($conexion, $email){
        $email_existe = false;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                $sentencia = $conexion->prepare($sql);
               
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia -> execute();                
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $email_existe = true;
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        } 
        return $email_existe;
    }

    public static function obtener_usuario_por_email($conexion, $email){
        $usuario = "";

        if (isset($conexion)) {
            try {
                include_once 'usuario.inc.php';
                
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                $sentencia = $conexion-> prepare($sql);

                $sentencia -> bindParam(':email',$email, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia->fetch();

                if(!empty($resultado)){
                    $usuario = new Usuario($resultado['id_usuario'],
                                           $resultado['nombre'],
                                           $resultado['email'],
                                           $resultado['password'], 
                                           $resultado['fecha_registro'], 
                                           $resultado['activo']);
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $usuario;
    }
    
    public static function obtener_usuario_por_id($conexion, $id){
        $usuario = "";

        if (isset($conexion)) {
            try {
                include_once 'usuario.inc.php';
                
                $sql = "SELECT * FROM usuarios WHERE id_usuario = :id";
                $sentencia = $conexion-> prepare($sql);

                $sentencia -> bindParam(':id',$id, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia->fetch();

                if(!empty($resultado)){
                    $usuario = new Usuario($resultado['id_usuario'],
                                           $resultado['nombre'],
                                           $resultado['email'],
                                           $resultado['password'], 
                                           $resultado['fecha_registro'], 
                                           $resultado['activo']);
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $usuario;
    }
    
    public static function actualizar_password($conexion, $id_usuario, $nueva_clave){
        $actualizacion_correcta = false;

        if (isset($conexion)) {
            try {
                $sql = "UPDATE usuarios SET password = :nueva_clave WHERE id_usuario = :id";
                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':nueva_clave',$nueva_clave, PDO::PARAM_STR);
                $sentencia -> bindParam(':id',$id_usuario, PDO::PARAM_STR);

                $sentencia -> execute();
                $resultado = $sentencia -> rowCount(); // cuantas filas de la tabla se actualizaron
                if ($resultado) {
                    $actualizacion_correcta = true;
                }

            } catch (PDOException $ex) {
                print "Error: ". $ex ->getMessage();
            }
        }
        return $actualizacion_correcta;
    }

}