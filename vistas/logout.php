<?php
    include_once 'app/config.inc.php';
    include_once 'app/controlSesion.inc.php';
    include_once 'app/redireccion.inc.php';
    
    ControlSesion :: cerrar_sesion();
    Redireccion :: redirigir(SERVIDOR);