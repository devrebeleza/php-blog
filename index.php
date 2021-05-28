<?php
 include_once 'app/config.inc.php';
 include_once 'app/conexion.inc.php';

 include_once 'model/usuario.inc.php';
 include_once 'model/entrada.inc.php';
 include_once 'model/comentario.inc.php';

 include_once 'model/repositorioUsuario.inc.php';
 include_once 'model/repositorioEntrada.inc.php';
 include_once 'model/repositorioComentario.inc.php';

    $componentes_url = parse_url($_SERVER['REQUEST_URI']);

    $ruta = $componentes_url['path'];

    $partes_ruta = explode('/',$ruta);
    $partes_ruta = array_filter($partes_ruta); // elimina indices que estén vacios en array
    $partes_ruta = array_slice($partes_ruta,0);  // todos los indices vacios se eliminan

    //$ruta_elegida = 'vistas/404.php';
    $ruta_elegida = RUTA_ERROR;

    if ($partes_ruta[0] == 'blog') {
        if (count($partes_ruta) == 1) {
            $ruta_elegida = 'vistas/home.php';
        }elseif (count($partes_ruta) == 2) {
            switch ($partes_ruta[1]) {
                case 'login':
                    $ruta_elegida = 'vistas/login.php';
                break;
                case 'logout':
                    $ruta_elegida = 'vistas/logout.php';
                break;
                case 'registro':
                    $ruta_elegida = 'vistas/registro.php';
                break;                
                case 'favoritos':
                    $ruta_elegida = 'vistas/favorito.php';
                break;
                case 'autores':
                    $ruta_elegida = 'vistas/autor.php';
                break;
                case 'gestor':
                    $ruta_elegida = 'vistas/gestor.php';
                    $gestor_actual = '';
                break;
                case 'nueva-entrada':
                    $ruta_elegida = 'vistas/nueva-entrada.php';
                    break;
                case 'borrar-entrada':
                    $ruta_elegida = 'scripts/borrar-entrada.php';
                    break;
                case 'editar-entrada':
                    $ruta_elegida = 'vistas/editar-entrada.php';
                    break;
                case 'recuperar-clave':
                    $ruta_elegida = 'vistas/recuperar-clave.php';
                    break;                        
                case 'generar-url-secreta':
                    $ruta_elegida = 'scripts/generar-url-secreta.php';
                    break;
                case 'mail':
                    $ruta_elegida = 'vistas/prueba-mail.php';
                    break;                        
                case 'script-relleno':
                   /// $ruta_elegida = 'scripts/script-relleno.php';
                break;                
                case 'buscar':
                    $ruta_elegida = 'vistas/buscar.php';
                break;                
                case 'perfil':
                    $ruta_elegida = 'vistas/perfil.php';
                break;                
            }
        }elseif (count($partes_ruta) == 3) {
            if ($partes_ruta[1] == 'registro-correcto') {
                $nombre = $partes_ruta[2];
                $ruta_elegida = 'vistas/registro-correcto.php';
            }elseif ($partes_ruta[1] == 'entradas') {
                $url = $partes_ruta[2];
                
                Conexion :: abrir_conexion();
                $entrada = RepositorioEntrada :: obtener_entrada_por_url(Conexion::obtener_conexion(),$url);
                
                if ($entrada != null) {
                    $autor = RepositorioUsuario :: obtener_usuario_por_id(Conexion::obtener_conexion(),$entrada->getIdAutor());
                    $comentarios = repositorioComentario :: obtener_comentarios(Conexion::obtener_conexion(),$entrada->getIdEntrada());
                    $entradas_aleatorias = RepositorioEntrada :: obtener_entradas_aleatorias(Conexion::obtener_conexion(),3,$entrada->getIdEntrada());
                                       
                    $ruta_elegida = 'vistas/entrada.php';
                }
            }elseif ($partes_ruta[1]=='gestor') {
                switch ($partes_ruta[2]) {
                    case 'entradas':
                         $gestor_actual = 'entradas';
                         $ruta_elegida = 'vistas/gestor.php';
                         break;
                    case 'comentarios':
                         $gestor_actual = 'comentarios';
                         $ruta_elegida = 'vistas/gestor.php';
                         break;
                    case 'favoritos':
                         $gestor_actual = 'favoritos';
                         $ruta_elegida = 'vistas/gestor.php';
                        break;                    
                }
            }elseif ($partes_ruta[1]=='recuperacion-clave') {
                $url_personal = $partes_ruta[2];
                $ruta_elegida = 'vistas/recuperacion-clave.php';
            }            
        }
    }
    include_once $ruta_elegida;



    /*if ($partes_ruta[2] == 'login') {
        include_once 'vistas/login.php';
    }else if ($partes_ruta[2]=='registro') { 
        include_once 'vistas/registro.php';
    }else if ( $partes_ruta[1]=='blog' && $partes_ruta[2]=='') {
        include_once 'vistas/home.php';
    }else{
        include_once 'retro-error-page/404.php';
    }*/

/*
    define('RUTA_REGISTRO',SERVIDOR.'/registro');
    define('RUTA_REGISTRO_CORRECTO', SERVIDOR.'/registro-correcto.php');  
    define('RUTA_LOGIN',SERVIDOR.'/login');
    //define('RUTA_LOGIN',SERVIDOR.'/loginin.php');
    define('RUTA_LOGOUT',SERVIDOR.'/logout');

    define('RUTA_ENTRADAS',SERVIDOR.'/entradas');
    define('RUTA_FAVORITOS',SERVIDOR.'/favoritos');
    define('RUTA_AUTORES',SERVIDOR.'/autores');
    
    //recursos
    define('RUTA_CSS',SERVIDOR.'/css');
    define('RUTA_JS',SERVIDOR.'/js');
    define('RUTA_IMG',SERVIDOR.'/img');*/