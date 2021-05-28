<?php

class Comentario {

    private $id_comentario;
    private $id_autor;    
    private $id_entrada;
    private $titulo;
    private $texto;
    private $fecha;
    
    public function __construct($id_comentario, $id_autor, $id_entrada, $titulo, $texto, $fecha){

        $this -> id_comentario = $id_comentario;
        $this -> id_autor = $id_autor;    
        $this -> id_entrada = $id_entrada;
        $this -> titulo = $titulo;
        $this -> texto = $texto;
        $this -> fecha = $fecha;
    }

     //getters
    public function getIdComentario(){
        return $this->id_comentario;
    }

    public function getIdAutor(){
        return $this->id_autor;
    }

    public function getIdEntrada(){
        return $this->id_entrada;
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
    

    public function cambiar_titulo($titulo)    {
        $this->titulo = $titulo;
    }

    public function cambiar_texto($texto)    {        
            $this->texto = $texto;        
    }
}  
