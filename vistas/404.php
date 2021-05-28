<?php

    header($_SERVER['SERVER_PROTOCOL'].'404 NOT FOUND',TRUE,404);
    
    include_once 'app/config.inc.php';
    
    // modifiqué el archivo C:\xampp\php\php.ini allow_url_include=Off a On para que permita usar http://
    include_once RUTA_ERROR.'/error-404.php';

