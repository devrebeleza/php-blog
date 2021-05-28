<?php

class Entrada {
    private $id_entrada;
    private $id_autor;    
    private $url;
    private $titulo;
    private $texto;
    private $fecha;
    private $activa;
    
    public function __construct( $id_entrada, $id_autor, $url, $titulo, $texto, $fecha, $activa){

        $this -> id_entrada = $id_entrada;
        $this -> id_autor = $id_autor;    
        $this -> url = $url;
        $this -> titulo = $titulo;
        $this -> texto = $texto;
        $this -> fecha = $fecha;
        $this -> activa = $activa;
    }

     //getters
    public function getIdEntrada(){
        return $this->id_entrada;
    }

    public function getIdAutor(){
        return $this->id_autor;
    }
    
    public function getUrl(){
        return $this->url;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getTexto(){
        return $this->texto;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function esta_activa(){
        return $this->activa;
    }

    public function cambiar_titulo($titulo)    {
        $this->titulo = $titulo;
    }

    public function cambiar_url($url)    {
        $this->url = $url;
    }

    public function cambiar_texto($texto)    {
        $this->texto = $texto;
    }
   
    public function cambiar_activa($activa)    {
        $this->activa = $activa;
    }

}