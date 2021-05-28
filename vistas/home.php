<?php
    
    include_once 'app/conexion.inc.php';
    include_once 'model/repositorioUsuario.inc.php';
    include_once 'app/escritorEntradas.inc.php';

    $titulo = 'Blog devReBeleza';

    include_once 'plantillas/documento-declaracion.inc.php';
    include_once 'plantillas/menu.inc.php';

    $web_javadevone = 'https://www.youtube.com/watch?v=wrsBuvbkeZo&list=PLN9W6BC54TJI6mlpAT-b7nDkpHbZp73i4&index=84&ab_channel=JavaDevOne';
    
?> 
     
          <main role="main" class="container">
            <div class="jumbotron">
              <h1>Inicio Blog devReBeleza</h1>
              <p class="lead">Iniciando tutorial JavaDevOne</p>
              <a class="btn btn-lg btn-primary" href="<?php echo $web_javadevone ?>" target="_blank" role="button">Next Video &raquo;</a>
            </div>
          </main>
       
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header" >                                                                        
                                      <img src="img/search.svg" alt=""> Búsqueda                                    
                                </div>      
                                <div class="card-body">
                                    <form role="form" method="post" action="<?php echo RUTA_BUSCAR; ?>">
                                        <div class="form-group">
                                            <input type="text" name="termino-buscar" class="form-control"  placeholder="¿Qué buscas?" aria-label="Buscar" required>
                                        </div>
                                        <button name="buscar" class="form-control btn btn-outline-info my-2 my-sm-0" type="submit">Buscar</button>
                                    </form>
                                </div>                          
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header">                                    
                                <img src="img/filter-circle.svg" class="img-fluid" alt=""> Filtro
                                </div>
                                <div class="card-body">
                                    panel filtro
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header">                                    
                                <img src="img/calendar.svg" class="img-fluid" alt=""> Archivo
                                </div>
                                <div class="card-body">
                                    panel archivo
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- <div class="card ">
                        <div class="card-header">
                              <img src="img/clock.svg" class="img-fluid" alt=""> Últimas Entradas
                        </div>
                        <div class="card-body">
                            <p>Todavía no hay nada que mostrar</p>
                        </div>
                    </div> -->
                    <?php
                       EscritorEntradas :: escribir_entradas();
                    ?>
                </div>
            </div>
        </div>
       
<?php
include_once 'plantillas/documento-cierre.inc.php'
?>