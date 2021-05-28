<?php
    include_once 'app/config.inc.php';
    include_once 'app/conexion.inc.php';
    include_once 'model/entrada.inc.php';
    include_once 'model/repositorioEntrada.inc.php';

    include_once 'app/validarEntradaEditada.inc.php';
    include_once 'app/redireccion.inc.php';
    include_once 'app/controlSesion.inc.php';

    Conexion :: abrir_conexion();

    if (isset($_POST['guardar_cambios_entrada'])) {
        $entrada_publica_nueva =0;
        if (isset($_POST['publicar']) && $_POST['publicar']== "si") {
            $entrada_publica_nueva = 1;
        }

        $validador = new ValidadorEntradaEditada(Conexion::obtener_conexion(),
                                                $_POST['titulo'], $_POST['titulo_original'], 
                                                $_POST['url'], $_POST['url_original'],
                                                htmlspecialchars($_POST['texto']), $_POST['texto_original'],
                                                $entrada_publica_nueva, $_POST['publicar_original']);
    
        if (!$validador -> hay_cambios()) {
            Redireccion::  redirigir(RUTA_GESTOR_ENTRADAS);
        }elseif ($validador -> entrada_valida()) {
            $cambios_efectuados = RepositorioEntrada :: actualizar_entrada(Conexion::obtener_conexion(),
                                                                        $_POST['id_entrada_recup'],
                                                                        $validador -> obtener_titulo(),
                                                                        $validador -> obtener_url(),
                                                                        $validador -> obtener_texto(),
                                                                        $validador -> obtener_checkbox()
                                                                        );
            if ($cambios_efectuados) {
                echo 'ENTRADA VALIDA Y GUARDADA';
                Redireccion::  redirigir(RUTA_GESTOR_ENTRADAS);
            }else {
                echo 'chb: ' . $validador -> obtener_checkbox();
                echo '<br> chb: ' . $validador -> obtener_checkbox_original();
            }                                                                        
        }                                                

    }
    $titulo = "Editar Entrada";

    include_once 'plantillas/documento-declaracion.inc.php';
    include_once 'plantillas/menu.inc.php';
?>

    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">Edita tu entrada</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form role="form" class="form-nueva-entrada" method="post" action="<?php echo RUTA_EDITAR_ENTRADA?>">
                    <?php                         
                        if (isset($_POST['editar_entrada'])) {                                                         
                            $id_entrada_recup = $_POST['id_entrada'];
                            $entrada_recuperada = RepositorioEntrada :: obtener_entrada_por_id(Conexion :: obtener_conexion(), $id_entrada_recup);
                            
                            include_once 'plantillas/form-entrada-recuperada.inc.php';                                                        

                        }elseif (isset($_POST['guardar_cambios_entrada'])) {
                            $id_entrada_recup = $_POST['id_entrada_recup'];                            
                            
                            include_once 'plantillas/form-entrada-recuperada-validada.inc.php';
                        }
                    ?>
                    <br>
                </form>
            </div>
        </div>
    </div>


<?php
    Conexion :: cerrar_conexion();
    include_once 'plantillas/documento-cierre.inc.php'
?>