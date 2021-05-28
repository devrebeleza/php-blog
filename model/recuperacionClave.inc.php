<?php

class RecuperacionClave {
    private $id_recuperacion;
    private $id_usuario;
    private $url_secreta;
    private $fecha;

    public function __construct($id_recuperacion, $id_usuario, $url_secreta, $fecha){
        $this -> id_recuperacion = $id_recuperacion;
        $this -> id_usuario = $id_usuario;
        $this -> url_secreta = $url_secreta;
        $this -> fecha = $fecha;
    }

    

}