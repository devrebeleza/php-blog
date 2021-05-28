<?php
    // para que no guarde en caché las imagenes, aunque funcionó sin esto
     
    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");


    include_once 'app/conexion.inc.php';
    include_once 'model/repositorioUsuario.inc.php';
    include_once 'app/controlSesion.inc.php';
    include_once 'app/redireccion.inc.php';

    if (!ControlSesion::sesion_iniciada()) {
        Redireccion :: redirigir(SERVIDOR);
    }else{
        Conexion :: abrir_conexion();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = RepositorioUsuario :: obtener_usuario_por_id(Conexion :: obtener_conexion(),$id_usuario);
        
        
    }
    
    if (isset($_POST['guardar_imagen']) && !empty($_FILES['archivo_subido']['tmp_name']) ) {    

        $directorio = DIRECTORIO_RAIZ."/subidas/";
        $carpeta_objetivo = $directorio.basename($_FILES['archivo_subido']['name']);
        $subida_correcta = 1;
        $tipo_imagen =pathinfo($carpeta_objetivo, PATHINFO_EXTENSION);

        $comprobacion = getimagesize($_FILES['archivo_subido']['tmp_name']);
        if ($comprobacion == true) {
            $subida_correcta = 1;
        }else{
            $subida_correcta = 0;
        }

        if ($_FILES['archivo_subido']['size'] > 500000) {
            echo "El archivo no puede ocupar  mas de 500kb <br>";
            $subida_correcta = 0; 
        }

        if ($tipo_imagen != "jpg" && $tipo_imagen != "png" && $tipo_imagen != "jpeg" && $tipo_imagen != "gif") {
            echo "Sólo se admiten los formatos JPG, PNG, JPEG y GIF <br>";
            $subida_correcta = 0;
        }

        if ($subida_correcta == 0 ) {
            echo "Tu archivo no pudo subirse correctamente <br>";
        }else {
            if (!move_uploaded_file($_FILES['archivo_subido']['tmp_name'], DIRECTORIO_RAIZ."/subidas/".$usuario->getIdUsuario())) {               
                echo "Ha ocurrido un error al intentar subir el archivo <br>";
            }
        }        
    }

    $titulo = 'Perfil de usuario';

    include_once 'plantillas/documento-declaracion.inc.php';
    include_once 'plantillas/menu.inc.php';
?>

<div class="container perfil">
    <div class="row">
        <div class="col-md-3 text-center">        
            <?php 
                if (file_exists(DIRECTORIO_RAIZ."/subidas/".$usuario->getIdUsuario())) {
                    ?>
                        <img src="<?php echo SERVIDOR.'/subidas/'.$usuario->getIdUsuario(); ?>" class="img-thumbnail">
                    <?php
                }else {
                    ?>  
                    <i class="far fa-id-card fa-7x img-responsive"></i>
                     <?php   
                }
            ?>    
            <!-- <i class="far fa-id-card fa-7x img-responsive"></i> -->
            <br> <br> <br>
            <form class="text-center" action="<?php  echo RUTA_PERFIL; ?>" method="post" enctype="multipart/form-data" >
                <label for="archivo_subido" id="label-archivo">Sube una imagen</label>
                <input type="file" name="archivo_subido" id="archivo_subido" class="boton_subir">
                <br> <br> 
                <input type="submit" name="guardar_imagen" value="Guardar" class="form-control">
            </form>
        </div>
        <div class="col-md-9">
            <h4><small>Nombre de Usuario</small></h4>
            <h4><?php  echo $usuario -> getNombre(); ?></h4>
            <br>
            <h4><small>Email</small></h4>
            <h4><?php echo  $usuario -> getEmail(); ?></h4>
            <br>
            <h4><small>Fecha de Registro</small></h4>
            <h4><?php  echo $usuario -> getFechaRegistro(); ?></h4>
        </div>
    </div>
</div>

<?php
    include_once 'plantillas/documento-cierre.inc.php';