<?php

    include_once 'app/config.inc.php';
    include_once 'app/conexion.inc.php';
    include_once 'model/repositorioUsuario.inc.php';
    include_once 'app/validarLogin.inc.php';
    include_once 'app/controlSesion.inc.php';
    include_once 'app/redireccion.inc.php';

    $titulo = "Recuperación Contraseña";

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
                        <h4>Recuperación de Contraseña</h4>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="<?php echo  RUTA_GENERAR_URL_SECRETA; ?>">
                            <h2>Introduce tu email</h2> 
                            <br>
                            <p class="text-justify">Introdcue la dirección de correo con la que te registraste y te enviaremos un email con el que podras restablecer tu contraseña. </p>                            
                            <br>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" 
                                required autofocus>                                                        
                            <br>
                            <button class="form-control btn btn-outline-info my-2 my-sm-0" type="submit" name="enviar_email">Enviar</button>                               
                        </form>                        
                        <br>                                                                       
                        <div class="row text-center">
                            <div class="col-md-6">
                                <a class="nav-link" href="<?php echo RUTA_REGISTRO ?>"> Registrate</a>    
                            </div>
                            <div class="col-md-6">
                                <a class="nav-link" href="<?php echo SERVIDOR ?>"> Volver a la página de Inicio </a> 
                            </div>
                        </div>                                                                                
                    </div>
                </div>
            </div>
        </div>
    </div>