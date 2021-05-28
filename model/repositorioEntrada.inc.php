<?php
    include_once __DIR__.'/../app/config.inc.php';
    include_once __DIR__.'/../app/conexion.inc.php';

    include_once 'entrada.inc.php';

class RepositorioEntrada {

    public static function insertar_entrada($conexion, $entrada){
        $entrada_insertada = false;

        if(isset($conexion)){
            try {
                $sql = "INSERT INTO entradas (id_autor, url, titulo, texto, fecha, activa) Values (:id_autor,:url, :titulo, :texto, NOW(),:activa)";
                $sentencia = $conexion -> prepare($sql);

                $id_autor = $entrada->getIdAutor();
                $url = $entrada ->getUrl();
                $titulo = $entrada->getTitulo();
                $texto = $entrada->getTexto();
                $activa = $entrada->esta_activa();
                

                $sentencia -> bindParam(':id_autor', $id_autor, PDO::PARAM_STR);
                $sentencia -> bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia -> bindParam(':texto', $texto, PDO::PARAM_STR);
                $sentencia -> bindParam(':activa', $activa, PDO::PARAM_STR);

                $entrada_insertada = $sentencia->execute();

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $entrada_insertada;
    }
 
    public static function obtener_todas_por_fecha_descendiente($conexion){
        $entradas = [];

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas ORDER BY fecha DESC";
                
                $sentencia = $conexion -> prepare($sql);

                $entrada_insertada = $sentencia->execute();

                $resultado = $sentencia -> fetchAll();

                if (count($resultado)>0) {
                    foreach($resultado as $fila){
                        $entrada = new Entrada($fila['id_entrada'], 
                                                $fila['id_autor'],
                                                $fila['url'],
                                                $fila['titulo'],
                                                $fila['texto'],
                                                $fila['fecha'],
                                                $fila['activa'] );
                        array_push($entradas, $entrada);
                    }
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function obtener_entrada_por_url($conexion, $url){
        $entrada = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas where url LIKE :url ";   
                $sentencia = $conexion -> prepare($sql);             

                $sentencia -> bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia -> fetch();
                if(!empty($resultado)){
                    $entrada = new Entrada($resultado['id_entrada'],
                                           $resultado['id_autor'],
                                           $resultado['url'],
                                           $resultado['titulo'],
                                           $resultado['texto'],
                                           $resultado['fecha'],
                                           $resultado['activa']);                    
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex -> getMessage();
            }
        }
        return $entrada;
    }

    public static function obtener_entrada_por_id($conexion, $id_entrada){
        $entrada = null;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas where id_entrada = :id ";   
                $sentencia = $conexion -> prepare($sql);             

                $sentencia -> bindParam(':id', $id_entrada, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia -> fetch();
                if(!empty($resultado)){
                    $entrada = new Entrada($resultado['id_entrada'],
                                           $resultado['id_autor'],
                                           $resultado['url'],
                                           $resultado['titulo'],
                                           $resultado['texto'],
                                           $resultado['fecha'],
                                           $resultado['activa']);                    
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex -> getMessage();
            }
        }
        return $entrada;
    }

    public static function obtener_entradas_aleatorias($conexion, $limite, $id_entrada){
        $entradas = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas where id_entrada != :id order by rand() LIMIT $limite";
                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':id', $id_entrada, PDO::PARAM_STR);

                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                
                if (count($resultado)>0) {
                    foreach($resultado as $fila){
                            $entradas[] = new Entrada($fila['id_entrada'], 
                                               $fila['id_autor'],
                                               $fila['url'],
                                               $fila['titulo'],
                                               $fila['texto'],
                                               $fila['fecha'],
                                               $fila['activa'] );
                            //array_push($entradas, $entrada);                
                    }
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function contar_entradas_activas_usuario($conexion, $id_usuario){
        $total_entradas = 0;

        if (isset($conexion)) {
            try {
                $sql = "SELECT count(*) as total_entradas FROM entradas where id_autor = :id and activa = 1" ;
                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':id', $id_usuario, PDO::PARAM_STR);

                $sentencia->execute();
                $resultado = $sentencia->fetch();
                
                if (!empty($resultado)) {
                    $total_entradas = $resultado['total_entradas'];
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $total_entradas;
    }

    public static function contar_entradas_inactivas_usuario($conexion, $id_usuario){
        $total_entradas = 0;

        if (isset($conexion)) {
            try {
                $sql = "SELECT count(*) as total_entradas FROM entradas where id_autor = :id and activa = 0" ;
                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':id', $id_usuario, PDO::PARAM_STR);

                $sentencia->execute();
                $resultado = $sentencia->fetch();
                
                if (!empty($resultado)) {
                    $total_entradas = $resultado['total_entradas'];
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $total_entradas;
    }

    public static function obtener_entradas_usuario_fecha_descendente($conexion, $id_usuario){
        $entradas_obtenidas = [];
        if (isset($conexion)) {
            try {
                $sql = "SELECT en.*, COUNT(co.id_comentario) 'cantidad_comentarios'
                        FROM entradas en 
                        LEFT JOIN comentarios co ON co.id_entrada = en.id_entrada
                        where en.id_autor = :id  
                        group by en.id_entrada 
                        order BY en.fecha";
                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':id', $id_usuario, PDO::PARAM_STR);

                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                
                if (count($resultado)>0) {
                    foreach($resultado as $fila){
                            $entrada = new Entrada($fila['id_entrada'], 
                                        $fila['id_autor'],
                                        $fila['url'],
                                        $fila['titulo'],
                                        $fila['texto'],
                                        $fila['fecha'],
                                        $fila['activa'] );

                            $entradas_obtenidas[] = array(
                                                        $entrada ,  
                                                        $fila['cantidad_comentarios']);
                    }
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $entradas_obtenidas;
    }

    public static function titulo_existe($conexion, $titulo){
        $titulo_existe = true;

        if(isset($conexion)){
            try {
                $sql = "SELECT * FROM entradas where titulo = :titulo";
                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':titulo',$titulo, PDO::PARAM_STR);

                $sentencia -> execute();
                $resultado = $sentencia->fetchAll();

                if (!count($resultado)) {
                    $titulo_existe = false;
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $titulo_existe;
    }

    public static function url_existe($conexion, $url){
        $url_existe = true;

        if(isset($conexion)){
            try {
                $sql = "SELECT * FROM entradas where url = :url";
                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':url',$url, PDO::PARAM_STR);

                $sentencia -> execute();
                $resultado = $sentencia->fetchAll();

                if (!count($resultado)) {
                    $url_existe = false;
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $url_existe;
    }

    public static function eliminar_comentarios_y_entradas($conexion, $id_entrada){

        if (isset($conexion)) {
            try {
                $conexion->beginTransaction();

                $sql1 = "DELETE FROM comentarios WHERE id_entrada = :id_entrada";
                $sentencia1 = $conexion ->prepare($sql1);
                $sentencia1 -> bindParam(':id_entrada', $id_entrada, PDO::PARAM_STR);

                $sql2 = "DELETE FROM entradas WHERE id_entrada = :id_entrada";
                $sentencia2 = $conexion ->prepare($sql2);
                $sentencia2 -> bindParam(':id_entrada', $id_entrada, PDO::PARAM_STR);

                $sentencia1 -> execute();
                $sentencia2 -> execute();

                $conexion->commit();
            } catch (PDOException $ex) {
                $conexion->rollback();
                print "Error: " . $ex->getMessage();
            }
        }
        return 'OK';
    }

    public static function actualizar_entrada($conexion, $id, $titulo, $url, $texto, $activa){
        $actualizacion_correcta = false;

        if(isset($conexion)){
            try {
                $sql = "UPDATE entradas SET titulo = :titulo,
                                            url = :url, 
                                            texto = :texto, 
                                            activa = :activa, 
                                            fecha = now()
                                            WHERE id_entrada = :id";
                $sentencia = $conexion->prepare($sql);
                $sentencia -> bindParam(':titulo',$titulo, PDO::PARAM_STR);
                $sentencia -> bindParam(':url',$url, PDO::PARAM_STR);
                $sentencia -> bindParam(':texto',$texto, PDO::PARAM_STR);
                $sentencia -> bindParam(':activa',$activa, PDO::PARAM_STR);
                $sentencia -> bindParam(':id',$id, PDO::PARAM_STR);

                $sentencia -> execute();
                $resultado = $sentencia ->rowCount();

                if ($resultado) {
                    $actualizacion_correcta = true;
                }

            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }

        return $actualizacion_correcta;
    }

    public static function buscar_entradas_todos_los_campos($conexion, $termino_busqueda){
        $entradas = [];
        $termino_busqueda = '%'.$termino_busqueda.'%';

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas 
                        WHERE (titulo LIKE :busqueda OR texto LIKE :busqueda )                        
                        ORDER BY fecha DESC LIMIT 25";

                $sentencia = $conexion->prepare($sql);
                $sentencia -> bindParam(':busqueda', $termino_busqueda, PDO::PARAM_STR);

                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
             
                if (count($resultado)>0) {
                    foreach ($resultado as $fila) {
                            $entrada = new Entrada($fila['id_entrada'],
                                                    $fila['id_autor'],
                                                    $fila['url'],
                                                    $fila['titulo'],
                                                    $fila['texto'],
                                                    $fila['fecha'],
                                                    $fila['activa'] );
                            array_push($entradas, $entrada);                     
                    }   # code...
                 }                
            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function buscar_entradas_por_titulo($conexion, $termino_busqueda, $orden){
        $entradas = [];
        $termino_busqueda = '%'.$termino_busqueda.'%';

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM ENTRADAS 
                        WHERE titulo LIKE :busqueda                        
                        ORDER BY fecha $orden LIMIT 25";

                $sentencia = $conexion->prepare($sql);
                $sentencia -> bindParam(':busqueda', $termino_busqueda, PDO::PARAM_STR);

                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
             
                if (count($resultado)>0) {
                    foreach ($resultado as $fila) {
                            $entrada = new Entrada($fila['id_entrada'],
                                                    $fila['id_autor'],
                                                    $fila['url'],
                                                    $fila['titulo'],
                                                    $fila['texto'],
                                                    $fila['fecha'],
                                                    $fila['activa'] );
                            array_push($entradas, $entrada);                     
                    }   # code...
                 }                
            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function buscar_entradas_por_contenido($conexion, $termino_busqueda, $orden){
        $entradas = [];
        $termino_busqueda = '%'.$termino_busqueda.'%';

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM entradas 
                        WHERE texto LIKE :busqueda                        
                        ORDER BY fecha $orden LIMIT 25";

                $sentencia = $conexion->prepare($sql);
                $sentencia -> bindParam(':busqueda', $termino_busqueda, PDO::PARAM_STR);

                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
             
                if (count($resultado)>0) {
                    foreach ($resultado as $fila) {
                            $entrada = new Entrada($fila['id_entrada'],
                                                    $fila['id_autor'],
                                                    $fila['url'],
                                                    $fila['titulo'],
                                                    $fila['texto'],
                                                    $fila['fecha'],
                                                    $fila['activa'] );
                            array_push($entradas, $entrada);                     
                    }   # code...
                 }                
            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $entradas;
    }

    public static function buscar_entradas_por_autor($conexion, $termino_busqueda, $orden){
        $entradas = [];
        $termino_busqueda = '%'.$termino_busqueda.'%';

        if (isset($conexion)) {
            try {
                $sql = "SELECT en.* 
                        FROM entradas en 
                        LEFT JOIN usuarios us ON en.id_autor = us.id_usuario 
                        WHERE us.nombre LIKE :busqueda                        
                        ORDER BY en.fecha $orden LIMIT 25";

                $sentencia = $conexion->prepare($sql);
                $sentencia -> bindParam(':busqueda', $termino_busqueda, PDO::PARAM_STR);

                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
             
                if (count($resultado)>0) {
                    foreach ($resultado as $fila) {
                            $entrada = new Entrada($fila['id_entrada'],
                                                    $fila['id_autor'],
                                                    $fila['url'],
                                                    $fila['titulo'],
                                                    $fila['texto'],
                                                    $fila['fecha'],
                                                    $fila['activa'] );
                            array_push($entradas, $entrada);                     
                    }   # code...
                 }                
            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage();
            }
        }
        return $entradas;
    }
}