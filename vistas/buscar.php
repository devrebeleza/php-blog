<?php
    include_once 'app/escritorEntradas.inc.php';
    $busqueda = null;
    $resultados = null;
    //$resultados_multiples = null;

    $buscar_titulo = false;
    $buscar_contenido = false;
    $buscar_tags = false;
    $buscar_autor = false;


    if (isset($_POST['buscar']) 
            && isset($_POST['termino-buscar']) && !empty($_POST['termino-buscar'])) {
        
        $busqueda = $_POST['termino-buscar'];        
       // $resultados_multiples = false;
        Conexion :: abrir_conexion();

        $resultados = RepositorioEntrada::buscar_entradas_todos_los_campos(Conexion::obtener_conexion(),$busqueda);
        
        Conexion::cerrar_conexion();                        

    }

    if (isset($_POST['busqueda_avanzada']) && isset($_POST['campos']) 
    && isset($_POST['termino-buscar']) && !empty($_POST['termino-buscar'])) {
        $busqueda = $_POST['termino-buscar'];
       // $resultados_multiples = true;

        if (in_array("titulo",$_POST['campos'])) {
            $buscar_titulo = true;
        }
        if (in_array("contenido",$_POST['campos'])) {
            $buscar_contenido = true;
        }
        if (in_array("tags",$_POST['campos'])) {
            $buscar_tags = true;
        }
        if (in_array("autor",$_POST['campos'])) {
            $buscar_autor = true;
        }
        
        if($_POST['ordenar'] == "recientes" ){
            $orden = 'DESC';            
        }else{
            $orden ='ASC';
        }
        Conexion::abrir_conexion();

        if ($buscar_titulo) {
            $entradas_por_titulo = RepositorioEntrada :: buscar_entradas_por_titulo(Conexion::obtener_conexion(), $busqueda, $orden);
            //print_r($entradas_por_titulo);
            //echo "<br><br>";
        }
        if ($buscar_contenido) {
            $entradas_por_contenido = RepositorioEntrada :: buscar_entradas_por_contenido(Conexion::obtener_conexion(), $busqueda, $orden);
            //print_r($entradas_por_contenido);
            //echo "<br><br>";
        }
        if ($buscar_tags) {
            // $entradas_por_tags = RepositorioEntrada :: buscar_entradas_por_tags(Conexion::obtener_conexion(), $busqueda, $orden);
           // echo "Aún no implementado". "<br><br>";
            
        }
        if ($buscar_autor) {
            $entradas_por_autor = RepositorioEntrada :: buscar_entradas_por_autor(Conexion::obtener_conexion(), $busqueda, $orden);
            //print_r($entradas_por_autor);
            //echo "<br><br>";
        }

        Conexion::cerrar_conexion();
    }

    $titulo = "Buscador en Blog";

    include_once 'plantillas/documento-declaracion.inc.php';
    include_once 'plantillas/menu.inc.php';


?>
    <div class="container">     
        <div class="jumbotron">
            <h1 class="text-center">Formulario de Búsqueda</h1>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <form role="form" method="post" action="<?php echo RUTA_BUSCAR; ?>">
                        <div class="form-group">
                            <input type="text" name="termino-buscar" class="form-control"  placeholder="¿Qué buscas?" 
                                aria-label="Buscar" required <?php echo "value='".$busqueda."'"?> >
                        </div>
                        <button name="buscar" class="form-control btn btn-outline-dark my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </div>                
            </div>
        </div>              
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <a data-toggle="collapse" href="#avanzada">Búsqueda Avanzada</a>
                        </h5>
                    </div>
                    <div id="avanzada" class="panel-collapse collapse">
                        <div class="card-body">
                            <form role="form" action="<?php echo RUTA_BUSCAR;?>" method="post">
                                <div class="form-group">
                                    <input type="text" name="termino-buscar" class="form-control"  placeholder="¿Qué buscas?" 
                                        aria-label="Buscar" required <?php echo "value='".$busqueda."'"?> >
                                </div>
                                <P>Buscar en los siguientes campos:</P>
                                <label class="form-check form-check-inline">                                
                                    <input class="form-check-input" type="checkbox" id="titulo" value="titulo" name="campos[]" 
                                    <?php
                                        if (isset($_POST['busqueda_avanzada'])) {
                                            if ($buscar_titulo) {
                                                echo "checked";
                                            }
                                        }else{
                                            echo "checked";
                                        }
                                    ?>                                    
                                    >
                                    <label class="form-check-label" for="titulo">Titulo</label>                                    
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="contenido" value="contenido" name="campos[]" 
                                    <?php
                                        if (isset($_POST['busqueda_avanzada'])) {
                                            if ($buscar_contenido) {
                                                echo "checked";
                                            }
                                        }else{
                                            echo "checked";
                                        }
                                    ?>                       
                                    >
                                    <label class="form-check-label" for="contenido">Contenido</label>                
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="tags" value="tags" name="campos[]"
                                    <?php
                                        if (isset($_POST['busqueda_avanzada'])) {
                                            if ($buscar_tags) {
                                                echo "checked";
                                            }
                                        }else{
                                            echo "checked";
                                        }
                                    ?>                       
                                    >
                                    <label class="form-check-label" for="tags">Tags</label>                
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="autor" value="autor" name="campos[]"
                                    <?php
                                        if (isset($_POST['busqueda_avanzada'])) {
                                            if ($buscar_autor) {
                                                echo "checked";
                                            }
                                        }
                                    ?>                       
                                    >
                                    <label class="form-check-label" for="autor">Autor</label>                
                                </label>
                                <hr>
                                <p>Ordenar por:</p>                            
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ordenar" id="entradasrecientes" value="recientes"
                                    <?php
                                        if (isset($_POST['busqueda_avanzada'])) {
                                            if (isset($orden) && $orden == 'DESC') {
                                                echo "checked";
                                            }
                                        }else{
                                            echo "checked";
                                        }
                                    ?>   
                                    >
                                    <label class="form-check-label" for="entradasrecientes">Entradas mas recientes</label>
                                </div>  
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ordenar" id="entradasantiguas" value="antiguas"
                                    <?php
                                        if (isset($_POST['busqueda_avanzada'])) {
                                            if (isset($orden) && $orden == 'ASC') {
                                                echo "checked";
                                            }
                                        }
                                    ?>   
                                    >
                                    <label class="form-check-label" for="entradasantiguas">Entradas mas antiguas</label>
                                </div>  
                                <br> <br>
                                <button name="busqueda_avanzada" class="from-control btn btn-outline-info  my-2 my-sm-0" type="submit">Busqueda avanzada</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="container" id="resultados">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header text-center">
                    <h1>Resultados 
                    <?php
                        if (isset($_POST['buscar']) && isset($resultados) && count($resultados)) {
                            echo '<small>'.count($resultados).' resultados</small>';
                        }elseif (isset($_POST['busqueda_avanzada'])) {
                            echo "terminar contando resultados avanzados";
                        }
                    ?>
                    </h1>                 
                </div>
            </div>
        </div>
        <?php 
            if (isset($_POST['buscar'])){
                if(isset($resultados) && count($resultados)) {                                
                    EscritorEntradas::mostrar_entradas_busqueda($resultados);
                }else{ 
                  echo '<h3>No se encontraron coincidencias</h3> <br>';
                }
            }elseif (isset($_POST['busqueda_avanzada'])) {

                    if (   ( isset($entradas_por_titulo)    && count($entradas_por_titulo)) 
                        || ( isset($entradas_por_contenido) && count($entradas_por_contenido)) 
                        || ( isset($entradas_por_autor)     && count($entradas_por_autor))) {            
                    //echo 'mas de una entrada';
                    $parametros = count($_POST['campos']);
                    $ancho_columnas = 12 / $parametros;
                    // 
                    ?>
                        <div class="row">
                            <?php 
                                for ($i=0; $i <$parametros ; $i++) { 
                            ?>
                                <div class="<?php echo 'col-md-'.$ancho_columnas; ?> text-center">
                                    <h5> <?php echo 'Coincidencias en '. $_POST['campos'][$i]; ?> </h5>
                                    <br>                            
                            <?php    
                                switch ($_POST['campos'][$i]) {
                                    case "titulo":
                                        EscritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_titulo);
                                    break;
                                    case "contenido":
                                        EscritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_contenido);
                                    break;
                                    case "tags":
                                        echo 'entradas por tags - en desarrollo';
                                    break;
                                    case "autor":
                                        EscritorEntradas::mostrar_entradas_busqueda_multiple($entradas_por_autor);
                                    break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                                ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    <?php     
                    }                               
            }else{
                echo '<h3>No se encontraron coincidencias</h3> <br>';
                // <!-- <p>No se encontraron coincidencias</p> -->
            }
        ?>
    </div>

<?php
    include_once 'plantillas/documento-cierre.inc.php';
?>    
