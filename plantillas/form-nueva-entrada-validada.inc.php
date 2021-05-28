
<div class="form-group">
    <label for="">Título</label>
    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ingresa un título" <?php $validador -> mostrar_titulo(); ?>>
    <?php 
        $validador -> mostrar_error_titulo();
    ?>
</div>
<div class="form-group">
    <label for="">URL</label>
    <input type="text" class="form-control" name="url" id="url" placeholder="Dirección única para la entrada sin espacios" <?php $validador -> mostrar_url(); ?>>
    <?php 
        $validador -> mostrar_error_url();
    ?>
</div>
<div class="form-group">
    <label for="">Contenido</label>
    <textarea class="form-control" name="texto" id="contenido" cols="30" rows="5" placeholder="Escribe aquí tu artículo"><?php $validador -> mostrar_texto(); ?></textarea>
    <?php 
        $validador -> mostrar_error_texto();
    ?>
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="publicar" value="si" <?php if($entrada_publica) echo 'checked';?>> Marca este recuadro si quieres que la entrada se publique inmediatamente 
    </label>
</div>
<div class="float-right">
    <button type="submit" class="btn btn-info my-2 my-sm-0" name="guardar">Guardar</button>
</div>