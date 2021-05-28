<?php
    include_once 'app/conexion.inc.php';
    include_once 'app/config.inc.php';

    include_once 'model/usuario.inc.php';
    include_once 'model/repositorioUsuario.inc.php';
    
    include_once 'model/recuperacionClave.inc.php';
    include_once 'model/repositorioRecuperacionClave.inc.php';

    include_once 'app/redireccion.inc.php';

    //string aleatorio
    function sa($longitud){
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $cant_caracteres = strlen($caracteres);

        $string_aleatorio = '';

        for ($i=0; $i < $longitud; $i++) { 
            $string_aleatorio .= $caracteres[rand(0,$cant_caracteres-1)];
        }

        return $string_aleatorio;
    }

    if (isset($_POST['enviar_email'])) {
        $email = $_POST['email'];

        Conexion :: abrir_conexion();

        if (!RepositorioUsuario :: email_existe(Conexion :: obtener_conexion(),$email)) {
            return;
        }

        $usuario = RepositorioUsuario :: obtener_usuario_por_email(Conexion :: obtener_conexion(), $email);

        $nombre_usuario = $usuario -> getNombre();
        $string_aleatorio = sa(10);

        $url_secreta = hash('sha256',$string_aleatorio . $nombre_usuario);

        $peticion_generada = RepositorioRecuperacionClave :: generar_peticion(Conexion :: obtener_conexion(), $usuario ->getIdUsuario(), $url_secreta );

        
        Conexion :: cerrar_conexion();

        if ($peticion_generada) {
            echo "petición correcta";
            Redireccion :: redirigir(SERVIDOR);
        }else{
            echo "petición incorrecta";
        }


    }