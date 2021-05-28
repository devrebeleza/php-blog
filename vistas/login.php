<?php

    include_once 'app/config.inc.php';
    include_once 'app/conexion.inc.php';
    include_once 'model/repositorioUsuario.inc.php';
    include_once 'app/validarLogin.inc.php';
    include_once 'app/controlSesion.inc.php';
    include_once 'app/redireccion.inc.php';

    if(ControlSesion :: sesion_iniciada()){
        Redireccion :: redirigir(SERVIDOR);
    }

    if (isset($_POST['login'])) {
        Conexion :: abrir_conexion();

        $validador = new ValidadorLogin($_POST['email'],$_POST['clave'], Conexion :: obtener_conexion());
        
        if ($validador-> obtener_error() === ""){            
            if (!is_null($validador->obtener_usuario()) ) {
            ControlSesion :: iniciar_sesion($validador-> obtener_usuario() -> getIdUsuario()
                                            ,$validador-> obtener_usuario()-> getNombre());
            Redireccion :: redirigir(SERVIDOR);
            }
        }

        Conexion :: cerrar_conexion(); 
    }

    $titulo = "Login";

    include_once 'plantillas/documento-declaracion.inc.php';
    //include_once 'plantillas/menu.inc.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="text-center">
                    <img class="mb-4" src="img/sunglasses.svg" alt="" width="72" height="72">
                </div>                
                <div class="card">                    
                    <div class="card-header text-center">                    
                        <h4>Iniciar Sesión</h4>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="<?php echo RUTA_LOGIN?>">
                            <h2>Introduce tus datos</h2> 
                            <br>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" 
                                <?php
                                     if (isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])) {
                                        echo 'value="'.$_POST['email'].'"';
                                    }
                                ?>
                                required autofocus>
                            
                            <label for="clave" class="sr-only">Contraseña</label>
                            <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>
                            <!-- <br>
                            <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">Iniciar Sesión</button> -->
                            <br>
                            <button class="form-control btn btn-outline-info my-2 my-sm-0" type="submit" name="login">Inicia Sesión</button>                               
                        </form>
                        <?php
                            if (isset($_POST['login'])) {
                                echo $validador -> mostrar_error();
                            }
                        ?> 
                        <br>                                               
                        <div class="text-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="nav-link" href="<?php echo RUTA_RECUPERAR_CLAVE; ?>">Olvidaste tu contraseña?</a>
                                </div>
                                <div class="col-md-6">
                                    <a class="nav-link" href="<?php echo RUTA_REGISTRO ?>"> Registrate</a>    
                                </div>
                            </div>                            
                            <br>
                            <a class="nav-link" href="<?php echo SERVIDOR ?>"> Volver a la página de Inicio </a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>