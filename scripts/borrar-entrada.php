<?php 
    include_once 'app/config.inc.php';
    include_once 'app/conexion.inc.php';
    include_once 'app/redireccion.inc.php';
    include_once 'model/repositorioEntrada.inc.php';

    include_once 'plantillas/documento-declaracion.inc.php';
    include_once 'plantillas/menu.inc.php';

    if (isset($_POST['borrar_entrada'])) {
        $id_entrada = $_POST['id_borrar'];

        Conexion :: abrir_conexion();
        
        $entrada_borrada = RepositorioEntrada :: eliminar_comentarios_y_entradas(Conexion :: obtener_conexion(),$id_entrada);

        Conexion :: cerrar_conexion(); 
        ?>

        <!-- Modal -->
        <div class="row">
        
        <div class="col-md-12 alert alert-warning alert-dismissible fade show text-center" role="alert">
            <strong>Éxito!</strong> Entrda borrada correctamente.
            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> -->
            <a class="btn btn-info align-rigth" href="<?php echo RUTA_GESTOR_ENTRADAS ?>" role="button">Volver</a>
        </div>         
        
        </div>
        <?php 
        //Redireccion :: redirigir(RUTA_GESTOR_ENTRADAS);
    }

    include_once 'plantillas/documento-cierre.inc.php';