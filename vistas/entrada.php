<?php
    include_once 'app/config.inc.php';
    include_once 'app/conexion.inc.php';

    include_once 'model/usuario.inc.php';
    include_once 'model/entrada.inc.php';
    include_once 'model/comentario.inc.php';

    include_once 'model/repositorioUsuario.inc.php';
    include_once 'model/repositorioEntrada.inc.php';
    include_once 'model/repositorioComentario.inc.php';

    $titulo = $entrada -> getTitulo();

    include_once 'plantillas/documento-declaracion.inc.php';
    include_once 'plantillas/menu.inc.php';
?>

<div class="container contenido-articulo">
    <div class="row">
        <div class="col-md-12">
            <h1> <?php echo $entrada -> getTitulo(); ?></h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <p> 
                Por <a href="#">                    
                    <i class="fas fa-user-circle fa-spin"></i>
                    <?php echo $autor->getNombre();?>                                       
                </a> el 
                <?php echo date("d/m/Y", strtotime($entrada->getFecha()));?> - <?php echo $autor->getEmail();?>
            </p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 ">
            <article class="text-justify">
                <?php echo nl2br($entrada->getTexto()); ?>
            </article>
        </div>
    </div>
    <?php
        include_once 'plantillas/entradas-aleatorias.inc.php';    
    ?>
    <br>
    <?php
        if (count($comentarios)>0) {
            include_once 'plantillas/comentarios-entradas.inc.php';
        }else {
            echo '<p>Todavía no existen Comentarios</p>';
        }
        
    ?>
</div>

<?php
    include_once 'plantillas/documento-cierre.inc.php';

?>