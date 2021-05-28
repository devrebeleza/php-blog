<div class="row pg-entradas">
    <div class="col-md-12">
        <h2>Gestión de entradas</h2>
        <br> 
            <a class="btn btn-info my-2 my-sm-0"
                href="<?php echo RUTA_NUEVA_ENTRADA; ?>" role="button">Crear Entrada</a> 
        <br>                                    
    </div>
</div>
<div class="row pg-entradas">
    <div class="col-md-12">
        <?php
            if (count($array_entradas)>0) {                
                 ?> 
                 <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Título</th>
                            <th>Estado</th>
                            <th>Comentarios</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for ($i=0; $i < count($array_entradas); $i++) { 
                                $entrada_actual = $array_entradas[$i][0];
                                $comentarios_entrada_actual = $array_entradas[$i][1];
                                ?>
                                  <tr>
                                    <td ><?php echo $entrada_actual -> getFecha() ?></td>
                                    <td><?php echo $entrada_actual -> getTitulo() ?></td>
                                    <td class="text-center"><?php echo $entrada_actual -> esta_activa() ?></td>
                                    <td class="text-center"><?php echo $comentarios_entrada_actual ?></td>
                                    <td>
                                        <form action="<?php echo RUTA_EDITAR_ENTRADA; ?>" method="post">
                                            <input type="hidden" name="id_entrada" value="<?php echo $entrada_actual->getIdEntrada(); ?>">                                            
                                            <button type="submit" class="btn btn-success btn-sm" name="editar_entrada">Editar</button>
                                        </form>                                        
                                    </td>
                                    <td>
                                        <form action="<?php echo RUTA_BORRAR_ENTRADA; ?>" method="post">
                                            <input type="hidden" name="id_borrar" value="<?php echo $entrada_actual->getIdEntrada(); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" name="borrar_entrada">Borrar</button>
                                        </form>
                                    </td>
                                </tr>        
                                <?php
                            };
                        ?>
                    </tbody>
                </table>
                <?php
            }else{
                ?>
                <h3 class="text-center">Todavía no has escrito ninguna entrada</h3> <br><br>
                <?php 
            }
        ?>
    </div>   
</div>