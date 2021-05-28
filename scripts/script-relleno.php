<?php
    include_once 'app/config.inc.php';
    include_once 'app/conexion.inc.php';

    include_once 'model/usuario.inc.php';
    include_once 'model/entrada.inc.php';
    include_once 'model/comentario.inc.php';

    include_once 'model/repositorioUsuario.inc.php';
    include_once 'model/repositorioEntrada.inc.php';
    include_once 'model/repositorioComentario.inc.php';

    echo '<div>Inicio script</div> <br>'; 

    Conexion :: abrir_conexion();

    for ($usuarios = 0; $usuarios <100; $usuarios++ ){

        $nombre = sa(10);
        $email =$nombre.'@'.sa(3);
        $password = password_hash('123456',PASSWORD_DEFAULT);

        $usuario = new Usuario('',$nombre, $email, $password,'','');

        RepositorioUsuario :: insertar_usuario(Conexion:: obtener_conexion(),$usuario);        
    }

    for ($entradas=0; $entradas < 100; $entradas++) { 
        $titulo = sa(10);
        $url = $titulo;
        $texto = lorem();
        $autor = rand(1,100);

        $entrada = new Entrada('', $autor, $url, $titulo, $texto, '', '');

        RepositorioEntrada :: insertar_entrada(Conexion :: obtener_conexion(), $entrada );
    }

    for ($comentarios=0; $comentarios < 100; $comentarios++) { 
        $autor = rand(1,100);
        $entrada = rand(1,100);
        $titulo = sa(10); 
        $texto = lorem();

        $comentario = new Comentario('',$autor,$entrada,$titulo,$texto,'');

        RepositorioComentario :: insertar_comentario(Conexion :: obtener_conexion(), $comentario);

    }

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

    function lorem(){
        $lorem = 'Lorem ipsum dolor sit amet consectetur adipiscing elit bibendum, rhoncus sem porta maecenas risus ridiculus luctus, aptent suspendisse ultrices feugiat nisl ornare auctor. Nascetur tempus vitae ullamcorper a turpis porttitor faucibus senectus cubilia euismod iaculis, dictumst velit nisi non fringilla dis vivamus phasellus sodales. Praesent dictum natoque justo curae porttitor aenean accumsan, felis per ante rhoncus dui a luctus cursus, scelerisque orci nisl feugiat litora hendrerit. Nostra torquent quis metus aptent fringilla iaculis nunc augue sem, maecenas per auctor quam tristique facilisis faucibus ornare, sodales ac interdum viverra sollicitudin massa quisque netus varius, cursus nascetur natoque lacinia dictumst nulla odio.

        Convallis platea netus tortor aliquet etiam facilisi orci suscipit, felis massa leo sem proin metus eu, mi condimentum interdum libero feugiat integer neque. Pulvinar in primis quisque ac est accumsan curae sodales nunc ultrices, mollis duis feugiat faucibus egestas ridiculus posuere ante torquent, hac ultricies dictum tempus platea a litora cursus per. Nibh semper sodales venenatis ac tempus erat duis a morbi, eros himenaeos platea non iaculis fames sed vel ligula, ullamcorper felis at condimentum cursus sagittis eget auctor. Turpis elementum interdum aenean netus tincidunt nostra iaculis urna, ante semper accumsan penatibus quam eget cum sapien, tempor eu tempus enim varius auctor augue.
        
        Tempus senectus id turpis hendrerit mollis malesuada condimentum mi nisl, litora luctus phasellus tristique eu elementum sociosqu dictum, himenaeos posuere facilisis aliquam gravida potenti cum nibh. Libero maecenas vivamus neque placerat lectus auctor mus, at natoque mauris cras tortor dignissim, augue himenaeos turpis pulvinar duis interdum. Purus metus vulputate porta sed dis vivamus, fusce quis donec morbi cubilia a accumsan, eget pharetra fringilla facilisi nam.
        
        Curae quam pretium nascetur nibh per lacinia maecenas fames sed sagittis, cras litora morbi nec ac penatibus ut metus velit. Tellus maecenas nisl luctus ullamcorper feugiat iaculis, fames donec venenatis blandit egestas volutpat facilisis, augue purus magnis odio ut. Duis commodo metus velit tempus penatibus fermentum curabitur rutrum mauris curae, purus ultricies euismod sem vulputate cras tristique placerat ridiculus aliquam, varius dictumst pretium platea egestas luctus vestibulum suspendisse class. Tempor nostra auctor lobortis sagittis egestas eleifend hac, metus donec ornare dictumst cursus fermentum laoreet dapibus, etiam nascetur diam nunc ac platea.
        
        Nulla taciti platea potenti nostra dapibus hendrerit ultrices primis ultricies eros urna, porta nam rutrum ullamcorper congue ligula venenatis placerat sapien. Nec ut mollis posuere magna dapibus phasellus taciti dis, condimentum felis eget vivamus quis sollicitudin. Etiam purus sollicitudin volutpat commodo vulputate odio consequat, sapien vitae lacus feugiat congue orci fames a, enim himenaeos dui condimentum tellus sociosqu. Imperdiet class dignissim tempor hac dui, integer litora sapien.';
    
        return $lorem;
    }

    echo '<div>Finalizó script</div>';