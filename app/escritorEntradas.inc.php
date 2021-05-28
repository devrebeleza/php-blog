<?php
 include_once __DIR__.'/../model/repositorioEntrada.inc.php';
 include_once __DIR__.'/../model/entrada.inc.php';
 
 class EscritorEntradas{

    public static function escribir_entradas(){
        $entradas = RepositorioEntrada :: obtener_todas_por_fecha_descendiente(Conexion :: obtener_conexion());        
        if (count($entradas)>0) {        
            foreach ($entradas as $entrada) {                
                self :: escribir_entrada($entrada);
            }
        }
    }

    public static function escribir_entrada($entrada){
        if (!isset($entrada)) {
           // echo $entrada->getTitulo() . '<br>';
            return;
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center" >
                        <?php
                            echo $entrada->getTitulo();
                        ?>
                    </div>
                    <div class="card-body">
                        <p> 
                            <strong>
                                <?php
                                    //echo $entrada->getFecha(). '<br>';
                                    echo date("d/m/Y", strtotime($entrada->getFecha()));
                                ?>
                            </strong>
                        </p>
                        <div class="text-justify">
                            <?php
                                echo nl2br( self :: resumir_texto($entrada->getTexto(),400) );
                            ?>
                        </div>
                        <br>
                            <div class="text-center">                                
                                <a class="btn btn-outline-info my-2 my-sm-0"
                                 href="<?php echo RUTA_ENTRADAS.'/'.$entrada->getUrl(); ?>" role="button">Seguir Leyendo</a> <br>                                
                            </div>
                    </div>                    
                </div>
                <br>
            </div>
        </div>

        <?php
    }

    public static function mostrar_entradas_busqueda($entradas){
        for ($i=1; $i <= count($entradas) ; $i++) { 
            if ($i % 3 == 1) {
                ?>
                <div class="row">
                <?php
            }

            $entrada = $entradas[$i -1];
            self::mostrar_entrada($entrada);
            if ($i % 3 == 0) {
                ?>
                </div>
                <?php
            }            
        }
    }

    public static function mostrar_entradas_busqueda_multiple($entradas){
        for ($i=0; $i < count($entradas) ; $i++) {             
            ?>
            <div class="row">
            <?php
        
            $entrada = $entradas[$i];
            self::mostrar_entrada_multiple($entrada);
            ?>
            </div>
            <?php        
        }
    }

    public static function mostrar_entrada($entrada){
        if (!isset($entrada)) {
           // echo $entrada->getTitulo() . '<br>';
            return;
        }
        ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center" >
                    <?php
                        echo $entrada->getTitulo();
                    ?>
                </div>
                <div class="card-body">
                    <p> 
                        <strong>
                            <?php
                                //echo $entrada->getFecha(). '<br>';
                                echo date("d/m/Y", strtotime($entrada->getFecha()));
                            ?>
                        </strong>
                    </p>
                    <div class="text-justify">
                        <?php
                            echo nl2br( self :: resumir_texto($entrada->getTexto(),400) );
                        ?>
                    </div>
                    <br>
                        <div class="text-center">                                
                            <a class="btn btn-outline-info my-2 my-sm-0"
                                href="<?php echo RUTA_ENTRADAS.'/'.$entrada->getUrl(); ?>" role="button">Seguir Leyendo</a> <br>                                
                        </div>
                </div>                    
            </div>
            <br>
        </div>    
        <?php
    }

    public static function mostrar_entrada_multiple($entrada){
        if (!isset($entrada)) {
           // echo $entrada->getTitulo() . '<br>';
            return;
        }
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" >
                    <?php
                        echo $entrada->getTitulo();
                    ?>
                </div>
                <div class="card-body">
                    <p> 
                        <strong>
                            <?php
                                //echo $entrada->getFecha(). '<br>';
                                echo date("d/m/Y", strtotime($entrada->getFecha()));
                            ?>
                        </strong>
                    </p>
                    <div class="text-justify">
                        <?php
                            echo nl2br( self :: resumir_texto($entrada->getTexto(),400) );
                        ?>
                    </div>
                    <br>
                        <div class="text-center">                                
                            <a class="btn btn-outline-info my-2 my-sm-0"
                                href="<?php echo RUTA_ENTRADAS.'/'.$entrada->getUrl(); ?>" role="button">Seguir Leyendo</a> <br>                                
                        </div>
                </div>                    
            </div>
            <br>
        </div>    
        <?php
    }

    public static function resumir_texto($texto, $longitud_maxima){
        //$longitud_maxima = 400;

        $resultado = '';

        if (strlen($texto) >= $longitud_maxima) {
            $resultado = substr($texto,0,$longitud_maxima).'...';
            //$resultado.='...';
        }else{
            $resultado = $texto;
        }

        return $resultado;
    }
 }

 /* self y parent
Cuando queramos acceder a una constante o método estático desde dentro de la clase, usamos la palabra reservada: self.

Cuando queramos acceder a una constante o método de una clase padre, usamos desde la clase extendida la palabra reservada: parent. 
Un caso típico es cuando en una clase extendida se sobreescribe el mismo método eliminando las definiciones y cambiando su visibilidad 
del método de la clase padre, como en el ejemplo anterior.

Diferencia entre $this y self::
Uno usa $this para hacer referencia al objeto (instancia) actual, y se utiliza self:: para referenciar a la clase actual. 
Se utiliza $this->nombre para nombres no estáticos y se utiliza self::nombres para nombres estáticos.

*/

