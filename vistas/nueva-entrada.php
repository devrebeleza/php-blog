<?php
    include_once 'app/config.inc.php';
    include_once 'app/conexion.inc.php';
    include_once 'model/entrada.inc.php';
    include_once 'model/repositorioEntrada.inc.php';
    include_once 'app/validarEntrada.inc.php';
    include_once 'app/redireccion.inc.php';
    include_once 'app/controlSesion.inc.php';
    
    $entrada_publica = 0;
    if (ControlSesion :: sesion_iniciada()){
            if (isset($_POST['guardar'])) {
                Conexion :: abrir_conexion();

                $validador = new validarEntrada(Conexion :: obtener_conexion(),$_POST['titulo'],$_POST['url'],
                                                htmlspecialchars($_POST['texto']));

                if (isset($_POST['publicar']) && $_POST['publicar'] == 'si') {
                    $entrada_publica = 1;
                }                        
                
                if ($validador -> entrada_valida()) {
                    if (ControlSesion :: sesion_iniciada()) {
                        $entrada = new Entrada('',$_SESSION['id_usuario'],
                                            $validador -> obtener_url(),
                                            $validador -> obtener_titulo(),
                                            $validador -> obtener_texto(),
                                            '',
                                            $entrada_publica
                                            );
                        $entrada_insertada = RepositorioEntrada :: insertar_entrada(Conexion :: obtener_conexion(), $entrada);
                        if ($entrada_insertada) {
                            Redireccion :: redirigir(RUTA_GESTOR_ENTRADAS);
                        }
                    } else {
                        Redireccion :: redirigir(RUTA_LOGIN );
                    }
                    Conexion :: cerrar_conexion();
                }
            }
    }else {
        Redireccion :: redirigir(SERVIDOR);
    }

    $titulo = 'Nueva entrada';

    include_once 'plantillas/documento-declaracion.inc.php';
    include_once 'plantillas/menu.inc.php';
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Crea tu nueva entrada</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form role="form" class="form-nueva-entrada" method="post" action="<?php echo RUTA_NUEVA_ENTRADA?>">
                <?php
                    if (isset($_POST['guardar'])) {
                        include_once 'plantillas/form-nueva-entrada-validada.inc.php';
                    }else{
                        include_once 'plantillas/form-nueva-entrada-vacio.inc.php';
                    }
                ?>
                <br>
            </form>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php'
?>