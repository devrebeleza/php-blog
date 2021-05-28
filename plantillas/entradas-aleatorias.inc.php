<?php
    include_once 'app/escritorEntradas.inc.php';
?>

<div class="row">
    <div class="col-md-12">
        <hr>
        <h3 class="text-center">Mas entradas interesantes</h3>
    </div>
    <?php 
        for ($i=0; $i < count($entradas_aleatorias); $i++) { 
            $entrada_actual = $entradas_aleatorias[$i];
            ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <?php echo $entrada_actual -> getTitulo(); ?>
                    </div>
                    <div class="card-body text-justify">
                        <p>
                        <?php                             
                            echo  nl2br(EscritorEntradas :: resumir_texto($entrada_actual -> getTexto(),250)); 
                        ?>
                        </p>
                        <br>
                            <div class="text-center">                                
                                <a class="btn btn-outline-info my-2 my-sm-0"
                                 href="<?php echo RUTA_ENTRADAS.'/'.$entrada_actual->getUrl(); ?>" role="button">Seguir Leyendo</a> <br>                                
                            </div>
                    </div>
                </div>
            </div>
        <?php
        }
    ?>
    <div class="col-md-12">
        <hr>
    </div>
</div>