<?php

include_once 'model/repositorioEntrada.inc.php';
include_once 'validarEntradaPadre.inc.php';

class ValidarEntrada extends ValidadorEntradaPadre{    

    public function __construct($conexion,$titulo, $url, $texto){
        $this -> aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this -> aviso_cierre = "</div>";

        $this -> titulo = "";
        $this -> url = "";
        $this -> texto = "";

        $this-> error_titulo = $this -> validar_titulo($conexion, $titulo);
        $this-> error_url = $this -> validar_url($conexion, $url);
        $this-> error_texto = $this -> validar_texto($texto);
    }    


}
