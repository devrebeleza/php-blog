<?php    
    include_once 'model/recuperacionClave.inc.php';
    include_once 'model/repositorioRecuperacionClave.inc.php';
    include_once 'model/repositorioUsuario.inc.php';
    include_once 'app/redireccion.inc.php';
    include_once 'app/validarRecuperacionClave.inc.php';
    
    Conexion :: abrir_conexion();
    $validador = null;

    if (RepositorioRecuperacionClave::url_secreta_existe(Conexion::obtener_conexion(),$url_personal)) {        
        $id_usuario = RepositorioRecuperacionClave ::obtener_id_usuario_mediante_url_secreta(Conexion::obtener_conexion(),$url_personal);       
    }else {
        //echo 'no existe url';
        //echo RUTA_ERROR;
        Redireccion::redirigir(RUTA_ERROR);
    }
    
    if (isset($_POST['guardar-clave'])) {
       
        $validador = new ValidadorRecuperacionClave($_POST['clave1'],$_POST['clave2']);
        
        if ($validador -> registro_valido()) {
            $conexion = Conexion :: obtener_conexion();
            $conexion->beginTransaction();        
            // crar una transacción
            $clave_actualizada = RepositorioUsuario::actualizar_password($conexion,$id_usuario, $validador ->obtener_clave());
            $url_secreta_eliminada = RepositorioRecuperacionClave::borrar_fila_por_url_secreta($conexion, $url_personal);
            //borrar entrada de la tabla de recuperacion $id_usuario, se podria modificar la url a 
            if ($clave_actualizada && $url_secreta_eliminada) {
                
                $conexion->commit();
                
                echo " <div class='row'>
                            <div class='col-md-12 alert alert-success text-center' role='alert'> <h4> Clave cambiada exitosamente </h4>
                            </div> "
                     ."</div>".
                     " <div class='row'>"
                            ."<div class='col-md-12 text-center'>
                                <a class='btn btn-info' href=".RUTA_LOGIN.">Loguearse</a>
                            </div>"
                     ."</div> <br>";                
            }else {
                $conexion->rollback();
                echo "<div class='alert alert-danger text-center' role='alert'>
                        <h4>Inconvenientes al querer actualizar la contraseña</h4>
                     </div>";
            }
        }
    }
    Conexion :: cerrar_conexion();

    $title = "Recuperación de Contraseña";
    
    include_once 'plantillas/documento-declaracion.inc.php';
    //include_once 'plantillas/menu.inc.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="text-center">
                    <img class="mb-4" src="<?php echo RUTA_IMG; ?>/sunglasses.svg" alt="" width="72" height="72">
                </div>                
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Crea una nueva contraseña</h4>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="<?php echo RUTA_RECUPERACION_CLAVE. "/" . $url_personal; ?>">                            
                            <div class="form-group">
                                <label for="clave" class="sr-only">Nueva Contraseña</label>
                                <input class="form-control" type="password" name="clave1" id="clave1" placeholder="Mínimo 6 caracteres" minlength="6" maxlength="40" required>
                                <?php
                                    if (isset($validador)) {
                                        $validador -> mostrar_error_clave1();
                                    }                                     
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="clave" class="sr-only">Repite la Contraseña</label>
                                <input class="form-control" type="password" name="clave2" id="clave2" placeholder="Las contraseñas deben coincidir" required>
                                <?php
                                    if (isset($validador)) {
                                        $validador -> mostrar_error_clave2();
                                    }                                     
                                ?>
                            </div>
                            <button type="submit" name="guardar-clave" class="form-control btn btn-outline-info btn-block">
                            Guardar Contraseña</button>
                        </form>  
                        <br>
                        <div class="text-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="nav-link" href="<?php echo RUTA_REGISTRO; ?>"> Registrate</a>
                                </div>
                                <div class="col-md-6">
                                    <a class="nav-link" href="<?php echo SERVIDOR ?>"> Volver a la página de inicio</a>    
                                </div>
                            </div>                                                        
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
    </div>

    