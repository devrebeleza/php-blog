<?php

class Usuario {
    private $id_usuario;
    private $nombre;
    private $email;
    private $password;
    private $fecha_registro;
    private $activo;
    
    public function __construct($id_usuario, $nombre, $email, $password,$fecha_registro,$activo){
        $this-> id_usuario = $id_usuario;
        $this-> nombre = $nombre;
        $this-> email = $email;
        $this-> password = $password;
        $this-> fecha_registro = $fecha_registro;
        $this-> activo = $activo;
    }

    //getters
    public function getIdUsuario(){
        return $this->id_usuario;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getEmail(){
        return $this->email;
    }
    
    public function getPassword(){
        return $this->password;
    }

    public function getFechaRegistro(){
        return $this->fecha_registro;
    }

    public function estaActivo(){
        return $this->activo;
    }

    //setters
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password=$password;
    }

    public function setActivo($activo){
        $this->activo= $activo;
    }
}