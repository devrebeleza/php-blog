<?php
    include_once 'app/controlSesion.inc.php';
    include_once 'app/config.inc.php';

    Conexion :: abrir_conexion();
    $total_usuarios = RepositorioUsuario :: obtener_numero_usuarios(Conexion :: obtener_conexion());

    $sesion_iniciada = ControlSesion :: sesion_iniciada();
?>    
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo SERVIDOR ?>">
                <i class="fas fa-blog"></i> devReBeleza
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>              
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">            
                <ul class="navbar-nav mr-auto">
                <?php
                    if (!ControlSesion::sesion_iniciada()) {                        
                ?>                    
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo RUTA_ENTRADAS ?>"> 
                                        <!-- <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-list-nested" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h10a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm-2-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm-2-4A.5.5 0 0 1 1 3h10a.5.5 0 0 1 0 1H1a.5.5 0 0 1-.5-.5z"/>
                                        </svg>  -->
                                        <i class="fab fa-accusoft"></i>
                                        Entradas 
                                        <span class="sr-only">(current)</span>
                                    </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo RUTA_FAVORITOS ?>">
                                    <!-- <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 0a2 2 0 0 0-2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4zm4.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.178.178 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.178.178 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.178.178 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.178.178 0 0 1-.134-.098L8.16 4.1z"/>
                                    </svg>  -->
                                    <i class="fas fa-medal"></i>
                                    Favoritos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo RUTA_AUTORES ?>">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-lines-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7 1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm2 9a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                                    </svg> Autores
                                </a>
                            </li>                                    
                <?php
                    }
                ?>
                </ul>
              <ul class="nav navbar-nav navbar-right">
                    <?php 
                        if ($sesion_iniciada) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo RUTA_PERFIL; ?>">                                    
                                    <!-- <img src="<?php echo RUTA_IMG; ?>/person.svg" alt=""> -->
                                    <i class="fas fa-user-check"></i>
                                    <?php echo ' '. $_SESSION['nombre_usuario']; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo RUTA_GESTOR; ?>">
                                    <i class="fas fa-bars"></i> Gestor <span class="caret"></span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="<?php echo RUTA_LOGOUT; ?>">
                                    <!-- <img src="<?php echo RUTA_IMG; ?>/door-closed.svg" alt="">  -->
                                    <i class="fas fa-door-closed"></i> Cerrar Sesión                                    
                                </a>
                            </li>
                            <?php
                        }else{
                             ?>           
                            <li class="nav-item">
                                <a class="nav-link" href="#">                                                    
                                    <img src="<?php echo RUTA_IMG ?>/person.svg" alt="">
                                    <?php echo $total_usuarios; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo RUTA_LOGIN ?>">          
                                    <!-- <img src="<?php echo RUTA_IMG ?>/door-open.svg" alt="">  -->
                                    <i class="fas fa-door-open"></i> Iniciar Sesión                        
                                </a>                        
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo RUTA_REGISTRO ?>">
                                    <!-- <img src="<?php echo RUTA_IMG ?>/person-plus.svg" alt=""> -->
                                    <i class="fas fa-user-plus"></i> Registro
                                </a>
                            </li>
                       <?php }
                    ?>
              </ul>
              <!-- <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form> -->
            </div>
        </div>
    </nav>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Gracias por pasar por nuestro BLOG!!!
                </div>
                <div class="modal-footer">                                               
                    <a class="btn btn-outline-info my-2 my-sm-0" href="<?php echo RUTA_LOGOUT ?>" role="button">Cerrar
                    </a>                        
                </div>
                </div>
            </div>
        </div>