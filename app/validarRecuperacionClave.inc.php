<?php

    class ValidadorRecuperacionClave{

        private $aviso_inicio;
        private $aviso_cierre;
        private $patron;

        private $clave;
        
        private $error_clave1;
        private $error_clave2;

        public function __construct($clave1, $clave2){
            $this -> aviso_inicio = "<br><div class='alert alert-danger text-center' role='alert'>";
            $this -> aviso_cierre = "</div>";
            $this -> patron = "/\b[A-Za-z0-9.-]{6,40}\b/";

            $this -> clave = "";

            $this-> error_clave1 = $this->validar_clave1($clave1);
            $this-> error_clave2 = $this->validar_clave2($clave1,$clave2);

            if ($this -> error_clave1 === "" && $this -> error_clave2 === "") {
                $this -> clave = password_hash($clave1, PASSWORD_DEFAULT);
            }
        }

        private function variable_iniciada($variable){
            if (isset($variable) && !empty($variable)) {
                return true;
            } else{
                return false; 
            }
        }

        public function obtener_clave(){
            return $this -> clave;
        }

        private function validar_clave1($clave1){
            if(!$this->variable_iniciada($clave1)){
                return "Debes escribir una contraseña.";
            } 
            
            if (!preg_match($this->patron, $clave1)) {
                return "La contraseña debe ser de longitud mayor a 6 y no debe contener caracteres especiales";
            }

            //$clave_cifrada = password_hash($clave1, PASSWORD_DEFAULT);
            //$this -> clave = $clave_cifrada;            

            return "";
        }
        
        private function validar_clave2($clave1, $clave2){
            if(!$this->variable_iniciada($clave1)){
                return "Primero debes completar la contraseña.";
            }

            if(!$this->variable_iniciada($clave2)){
                return "Debes repetir tu contraseña.";
            } 

            if ($clave1 !== $clave2){
                return "Ambas contraseñas deben coincidir";
            }

            return "";
        }        

        public function mostrar_error_clave1(){
            if ($this -> error_clave1 !== "") {
                echo $this -> aviso_inicio . $this -> error_clave1 . $this -> aviso_cierre;
            }
        }

        public function mostrar_error_clave2(){
            if ($this -> error_clave2 !== "") {
                echo $this -> aviso_inicio . $this -> error_clave2 . $this -> aviso_cierre;
            }
        }

        public function registro_valido(){
            if ($this->error_clave1==="" && $this->error_clave2 ==="")  {
                return true;
            } else {
                return false;
            }
        }

    }