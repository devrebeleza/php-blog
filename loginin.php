<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Signin Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">
 
    <!-- CSS --> <!--bootsrap web-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        
        <!-- para agregar bootstrap local -->
        <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
        <!-- archivo estilo personal -->
        <link href="css/estilos.css" rel="stylesheet"> 
        <link rel="stylesheet" href="css/navbar-top-fixed.css">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>
<body class="text-center">
    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-5">
        <form class="form-signin">
            <img class="mb-4" src="img/sunglasses.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Por favor inicia Sesión</h1>
            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
            <label for="inputPassword" class="sr-only">Contraseña</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Recordarme
                </label>
            </div>                    
            <button class="form-control btn btn-outline-info my-3 my-sm-0" type="submit" name="enviar">Iniciar Sesión</button>                                           
        </form>
        <div class="text-center">
            <br>
            <a href="#">¿Olvidaste tu contraseña?</a>
        </div>
      </div>
    </div>    
</body>
</html>
