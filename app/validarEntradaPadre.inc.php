<?php

abstract class ValidadorEntradaPadre {
    
    protected $aviso_inicio;
    protected $aviso_cierre;
    
    protected $titulo;
    protected $url;
    protected $texto;
    
    protected $error_titulo;
    protected $error_url;
    protected $error_texto;

    function __construct(){
        
    }

    protected function variable_iniciada($variable){
        if (isset($variable) && !empty($variable)) {
            return true;
        };
        return false;
    }

    protected function validar_titulo($conexion, $titulo){
        if (!$this->variable_iniciada($titulo)) {
            return "Debes escribir un título";
        }

        if (strlen($titulo) > 255) {
            return "El título no puede ocupar mas de 255 caracteres";
        }

        if (RepositorioEntrada :: titulo_existe($conexion,$titulo )){
            return "Ya existe una entrada con ese título, por favor elige otro";
        }
        $this->titulo = $titulo; 
        return "";
    }

    
    protected function validar_url($conexion, $url){
        if (!$this->variable_iniciada($url)) {
            return "Debes escribir una url valida";
        }
        
        if (strlen($url) !== strlen(str_replace(' ','',$url))) {
            return "La url no debe contener espacios en blanco";
        }

        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
            return "Carácteres inválidos para la URL";
        }
        
        if (RepositorioEntrada :: url_existe($conexion,$url)){
            return "Ya existe una entrada con esa url, por favor escriba otra";
        }
        $this->url = $url; 
        return "";
    }

    protected function validar_texto($texto){
        if (!$this->variable_iniciada($texto)) {
            return "El contenido no puede estar vacío ";
        }    

        if (strlen($texto) < 10) {        
            return "Debes ingresar un contenido de longitud mayor a 10";
        }
        $this->texto = $texto;
        return "";
    }

    public function obtener_titulo(){
        return $this ->titulo;
    }
    
    public function obtener_url(){
        return $this->url;
    }
    
    public function obtener_texto(){
        return $this->texto;
    }
    
    public function mostrar_titulo(){
        if($this -> titulo !== ""){
            echo 'value="'. $this->titulo.'"';
        }
    }

    public function mostrar_url(){
        if($this ->url !== ""){
            echo 'value="'. $this ->url.'"';
        }
    }

    public function mostrar_texto(){
        if ($this ->texto !== "" && (strlen(trim($this->texto)) > 0)) {
            echo $this ->texto;
        }
    }

    public function mostrar_error_titulo(){
        if ($this->error_titulo !=="") {
            echo $this->aviso_inicio . $this->error_titulo . $this->aviso_cierre;
        }
    }

    public function mostrar_error_url(){
        if ($this->error_url !=="") {
            echo $this->aviso_inicio . $this->error_url . $this->aviso_cierre;
        }
    }

    public function mostrar_error_texto(){
        if ($this->error_texto !=="") {
            echo $this->aviso_inicio . $this->error_texto . $this->aviso_cierre;
        }
    }

    public function entrada_valida(){
        if ($this->error_titulo ==""  && $this->error_url ==""  && $this->error_texto =="") {
            return true;
        }
        return false;
    }

}