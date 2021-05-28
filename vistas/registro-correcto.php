<?php
    include_once 'app/config.inc.php';
    include_once 'app/conexion.inc.php';
    include_once 'model/repositorioUsuario.inc.php';
    include_once 'app/redireccion.inc.php';

   /* if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
        $nombre = $_GET['nombre'];
    } else {
       Redireccion :: redirigir(SERVIDOR);       
    }*/

    $titulo = '¡Registro Correcto!';

    include_once 'plantillas/documento-declaracion.inc.php';
    include_once 'plantillas/menu.inc.php';

?>

<div class="container">
    <div class="row"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <img src="<?php echo RUTA_IMG ?>/check-circle.svg" alt=""> Registro Correcto
                </div>
                <div class="card-body text-center">
                    <p> Gracias por registrarte <b><?php echo $nombre?></b>, toma tu dolar <img src="<?php echo RUTA_IMG ?>/cash.svg" alt=""> </p>                   
                    <br>
                    <p><a href="<?php echo RUTA_LOGIN ?>"> Inicia Sesión</a> para comenzar a usar tu cuenta</p>
                </div>
            </div>
        </div>
</div>
