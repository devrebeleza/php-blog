<div class="form-group">
    <label><strong>   Nombre de Usuario </strong> </label>
    <input type="text" class="form-control" name="nombre" placeholder="usuario" <?php $validador -> mostrar_nombre(); ?> >
    <?php
        $validador -> mostrar_error_nombre();
    ?>
</div>
<div class="form-group">
    <label for=""><strong> Email </strong></label>
    <input type="email" class="form-control" name="email" placeholder="usuario@mail.com" <?php $validador -> mostrar_email(); ?> >
    <?php 
        $validador -> mostrar_error_email();
    ?>
</div>
<div class="form-group">
    <label for=""><strong> Contraseña </strong></label>
    <input type="password" class="form-control" name="clave1">
    <?php 
        $validador -> mostrar_error_clave1();
    ?>
</div>
<div class="form-group">
    <label for=""><strong> Repite tu Contraseña </strong></label>
    <input type="password" class="form-control" name="clave2">
    <?php 
        $validador -> mostrar_error_clave2();
    ?>
</div>
<br>
<div class="container text-center">
    <div class="row">
        <div class="col-md-6">
            <button class="form-control btn btn-outline-dark my-2 my-sm-0" type="reset">Limpiar</button>                                       
        </div>
        <div class="col-md-6">
            <button class="form-control btn btn-outline-info my-2 my-sm-0" type="submit" name="enviar">Enviar</button>   
        </div>
    </div>
</div>