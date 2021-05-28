<?php

class Redireccion {

    public static function redirigir($url){
        header('Location: '. $url , true , 301);
        exit(); // die(); cualquiera de los dos. Siempre cortar la redirección
    }

}