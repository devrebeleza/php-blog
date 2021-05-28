<?php
    include_once 'app/conexion.inc.php';
    include_once 'model/usuario.inc.php';
    include_once 'model/repositorioUsuario.inc.php';
    include_once 'app/validarRegistro.inc.php';
    include_once 'app/redireccion.inc.php';
    include_once 'app/config.inc.php';
    

    if (isset($_POST['enviar'])) {
        Conexion :: abrir_conexion();
            
        $validador = new ValidadorRegistro($_POST['nombre'], $_POST['email'], $_POST['clave1'], $_POST['clave2'], Conexion :: obtener_conexion());

        if ($validador->registro_valido()) {
            $usuario = new Usuario('',$validador->obtener_nombre(), 
                                   $validador->obtener_email(), 
                                   password_hash($validador->obtener_clave(),PASSWORD_DEFAULT),
                                   '',
                                   '');                    
            $usuario_insertado = RepositorioUsuario :: insertar_usuario(Conexion :: obtener_conexion(),$usuario);                

            if ($usuario_insertado) {
                Redireccion :: redirigir(RUTA_REGISTRO_CORRECTO.'/'.$usuario->getNombre()); 
            }
        }
        Conexion :: cerrar_conexion();
    }

    $titulo = 'Registro';

    include_once 'plantillas/documento-declaracion.inc.php';
    include_once 'plantillas/menu.inc.php';
?>

<!-- Inicio Registro -->
<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Formulario de Registro</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="card">
                <div class="card-header">
                    <h3 class="panel-title"> 
                        Instrucciones
                    </h3>
                </div>
                <div class="card-body">
                    <br>
                    <p class='text-justify'>
                        Para unirte al blog introduce nombre de usuario, email y contraseña. 
                        El email debe ser válido ya que se utilizará para gestionar tu cuenta.
                        La contraseña debe ser segura.
                    </p>
                    <br>
                    <a href="#" class="">¿Ya tienes cuenta</a>
                    <br>
                    <br>
                    <a href="#" class="">¿Olvidaste tu contraseña?</a>
                    <br>                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="panel-title text-center">
                        Introduce tus datos
                    </h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php echo RUTA_REGISTRO ?>" >
                        <?php
                            if (isset($_POST['enviar'])) {
                                include_once 'plantillas/registro_validado.inc.php';
                            }else{
                                include_once 'plantillas/registro_vacio.inc.php';
                            }
                        ?>                                                                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php'
?>