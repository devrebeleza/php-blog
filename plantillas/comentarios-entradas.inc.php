<div class="row">
    <div class="col-md-12">
        <button class="btn btn-outline-info form-control my-2 my-sm-0" data-toggle="collapse" data-target="#comentarios">
            <?php
                echo "Ver comentarios (". count($comentarios) . ")" ;
            ?>
        </button>
        <br> <br>
        <div id="comentarios" class="collapse">
            <?php
                for ($i=0; $i < count($comentarios) ; $i++) { 
                    $comentario = $comentarios[1];
                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <?php echo $comentario-> getTitulo(); ?>
                                </div>
                                <div class="card-body row">
                                   <div class="col-md-2 text-center">
                                        <?php echo $comentario-> getIdAutor(); ?>
                                   </div>
                                   <div class="col-md-10 text-justify">
                                        <p>
                                            <?php echo $comentario-> getFecha(); ?>
                                        </p> 
                                        <p>
                                            <?php echo nl2br($comentario-> getTexto()); ?>
                                        </p>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php    
                }
            ?>
        </div>
    </div>
</div>