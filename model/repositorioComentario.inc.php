<?php
    include_once __DIR__.'/../app/config.inc.php';
    include_once __DIR__.'/../app/conexion.inc.php';
    include_once 'comentario.inc.php';

    class RepositorioComentario {

        public static function insertar_comentario($conexion, $comentario){
            $comentario_insertado = false;

            if(isset($conexion)){
                try {
                    $sql = "INSERT INTO comentarios (id_autor, id_entrada, titulo, texto, fecha) Values (:id_autor, :id_entrada, :titulo, :texto, NOW())";
                    $sentencia = $conexion -> prepare($sql);
    
                    $id_autor = $comentario->getIdAutor();
                    $id_entrada = $comentario->getIdEntrada();
                    $titulo = $comentario->getTitulo();
                    $texto = $comentario->getTexto();
                    
    
                    $sentencia -> bindParam(':id_autor', $id_autor, PDO::PARAM_STR);
                    $sentencia -> bindParam(':id_entrada', $id_entrada, PDO::PARAM_STR);
                    $sentencia -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
                    $sentencia -> bindParam(':texto', $texto, PDO::PARAM_STR);
    
                    $comentario_insertado = $sentencia->execute();
    
                } catch (PDOException $ex) {
                    print "Error: " . $ex->getMessage();
                }
            }
            return $comentario_insertado;
        }

        public static function obtener_comentarios($conexion, $id_entrada){
            $comentarios = [];
            if (isset($conexion)) {
                try {
                    $sql = "SELECT * FROM comentarios WHERE id_entrada = :id_entrada";
                    $sentencia = $conexion -> prepare($sql);

                    $sentencia -> bindParam(':id_entrada',$id_entrada, PDO::PARAM_STR);
                    $sentencia -> execute();

                    $resultado = $sentencia ->fetchAll();

                    //if (count($resultado)) {
                        foreach ($resultado as $fila) {
                            $comentarios[] = new Comentario($fila['id_comentario'], 
                                                        $fila['id_autor'], 
                                                        $fila['id_entrada'], 
                                                        $fila['titulo'], 
                                                        $fila['texto'], 
                                                        $fila['fecha']);
                        }
                    //}                        
                } catch (PDOException $ex) {
                    print "Error: ".$ex->getMessage();
                }
            }
            return $comentarios;
        }

        public static function contar_comentarios_usuario($conexion, $id_usuario){
            $total_comentarios = 0;
    
            if (isset($conexion)) {
                try {
                    $sql = "SELECT count(*) as total_comentarios FROM comentarios where id_autor = :id" ;
                    $sentencia = $conexion -> prepare($sql);
    
                    $sentencia -> bindParam(':id', $id_usuario, PDO::PARAM_STR);
    
                    $sentencia->execute();
                    $resultado = $sentencia->fetch();
                    
                    if (!empty($resultado)) {
                        $total_comentarios = $resultado['total_comentarios'];
                    }
    
                } catch (PDOException $ex) {
                    print "Error: " . $ex->getMessage();
                }
            }
            return $total_comentarios;
        }
    }


