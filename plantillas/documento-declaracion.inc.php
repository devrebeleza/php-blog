<!DOCTYPE html>
<html lang="es">
    <head>
        
        <meta charset="utf-8">

        <!-- sólo para IE -->
        
        <!-- presentación de vista ; ancho de la pag web corresponda a la pantalla ; escala inicial tamaño normal (sin zoom)-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <?php
            if (!isset($titulo) || empty($titulo)) {
                $titulo =  'Blog devReBeleza';
            }
                echo "<title>$titulo</title>";
            
        ?>
        <!-- CSS --> <!--bootsrap web-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        
        <!-- para agregar bootstrap local -->
        <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
        <!-- archivo estilo personal -->
        <!-- <link href="css/estilos.css" rel="stylesheet">   ruta relativa-->
        <link href="<?php echo RUTA_CSS ?>/estilos.css" rel="stylesheet"> 
        <link href="<?php echo RUTA_CSS ?>/navbar-top-fixed.css" rel="stylesheet">
        <link href="<?php echo RUTA_FA ?>/css/fontawesome.css" rel="stylesheet"> 
        <link href="<?php echo RUTA_FA ?>/css/all.css" rel="stylesheet"> 
    </head>

    <body>
