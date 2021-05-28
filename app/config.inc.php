<?php

    //$nombre_servidor = 'xxx.xxx.xxx.xxx';
    /*$nombre_usuario  = 'xxxx';
    $password        = 'xxxx';
    $nombre_db       = 'blog';
*/
    //info de la base de datos
    define('NOMBRE_SERVIDOR', 'xxx.xxx.xxx.xxx');
    define('NOMBRE_USUARIO','xxxx');
    define('PASSWORD','xxxx');
    define('NOMBRE_DB','blog');

    //rutas de la web
    define('SERVIDOR','http://localhost/blog');
    define('RUTA_REGISTRO',SERVIDOR.'/registro');
    define('RUTA_REGISTRO_CORRECTO', SERVIDOR.'/registro-correcto');  
    define('RUTA_LOGIN',SERVIDOR.'/login');
    //define('RUTA_LOGIN',SERVIDOR.'/loginin.php');
    define('RUTA_LOGOUT',SERVIDOR.'/logout');

    define('RUTA_ENTRADAS',SERVIDOR.'/entradas');
    define('RUTA_FAVORITOS',SERVIDOR.'/favoritos');
    define('RUTA_AUTORES',SERVIDOR.'/autores');
    define('RUTA_GESTOR',SERVIDOR.'/gestor');
    define('RUTA_GESTOR_ENTRADAS',RUTA_GESTOR.'/entradas');
    define('RUTA_GESTOR_COMENTARIOS',RUTA_GESTOR.'/comentarios');
    define('RUTA_GESTOR_FAVORITOS',RUTA_GESTOR.'/favoritos');
    define('RUTA_NUEVA_ENTRADA',SERVIDOR.'/nueva-entrada');
    define('RUTA_BORRAR_ENTRADA',SERVIDOR.'/borrar-entrada');
    define('RUTA_EDITAR_ENTRADA',SERVIDOR.'/editar-entrada');
    define('RUTA_RECUPERAR_CLAVE',SERVIDOR.'/recuperar-clave');
    define('RUTA_GENERAR_URL_SECRETA',SERVIDOR.'/generar-url-secreta');
    define('RUTA_PRUEBA_MAIL',SERVIDOR.'/mail');
    define('RUTA_RECUPERACION_CLAVE',SERVIDOR.'/recuperacion-clave');
    define('RUTA_BUSCAR',SERVIDOR.'/buscar');
    define('RUTA_PERFIL',SERVIDOR.'/perfil');

    //recursos
    define('RUTA_CSS',SERVIDOR.'/css');
    define('RUTA_JS',SERVIDOR.'/js');
    define('RUTA_IMG',SERVIDOR.'/img');
    define('RUTA_ERROR',SERVIDOR.'/error-page/error-404.php');
    define('RUTA_FA',SERVIDOR.'/fontawesome');
    //define('DIRECTORIO_RAIZ',realpath(dirname(__FILE__)."/.."));
    define('DIRECTORIO_RAIZ',realpath(__DIR__."/.."));
