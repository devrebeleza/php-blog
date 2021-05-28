<?php
    include_once __DIR__.'/../model/repositorioUsuario.inc.php';

    class ValidadorLogin{

        private $usuario;
        private $error;
        private $aviso_inicio;
        private $aviso_cierre;

        public function __construct($email, $clave, $conexion){
            $this -> aviso_inicio = "<br><div class='alert alert-danger text-center' role='alert'>";
            $this -> aviso_cierre = "</div>";
            $this -> error = "";

            if (!$this -> variable_iniciada($email) || !$this -> variable_iniciada($clave))  {
                $this -> usuario = null;
                $this -> error = "Debes introducir tu email y tu contraseña";
            } else{
                $this -> usuario = RepositorioUsuario :: obtener_usuario_por_email($conexion, $email);

                if ($this->usuario=="") {
                    $this -> error = "Datos incorrectos";                
                } elseif (!password_verify($clave,$this->usuario->getPassword())) {
                    $this -> error = "Datos incorrectos";                
                }                
            }
        }

        private function variable_iniciada($variable){
            if (isset($variable) && !empty($variable)) {
                return true;
            } else{
                return false; 
            }
        }

        public function obtener_usuario(){
            return $this -> usuario;
        }

        public function obtener_error(){
            return $this -> error;
        }

        public function mostrar_error(){
            if ($this->error !=='') {
                echo $this -> aviso_inicio . $this -> error . $this -> aviso_cierre;
            }
        }

    }
