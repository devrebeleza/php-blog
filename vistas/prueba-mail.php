<?php

    $destinatario = "unemail@servidor.mail.com";
    $asunto = "mail de prueba";
    $mensaje = "Un mensaje de pruebva";

    $exito = mail($destinatario,$asunto,$mensaje);

    if ($exito) {
        echo "Email enviado correctamente";
    }else{
        echo "Error al enviar email";
    }