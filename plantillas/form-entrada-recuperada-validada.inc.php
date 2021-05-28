<input type="hidden" id="id_entrada_recup" name="id_entrada_recup" value="<?php echo $id_entrada_recup?>">
<div class="form-group">
    <label for="">Título</label>
    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ingresa un título" <?php $validador -> mostrar_titulo(); ?>>
    <input type="hidden" name="titulo_original" id="titulo_original" value="<?php echo $validador -> obtener_titulo_original()?>">
    <?php 
        $validador -> mostrar_error_titulo();
    ?>
</div>
<div class="form-group">
    <label for="">URL</label>
    <input type="text" class="form-control" name="url" id="url" placeholder="Dirección única para la entrada sin espacios" <?php $validador -> mostrar_url(); ?>>
    <input type="hidden" name="url_original" id="url_original" value="<?php echo $validador -> obtener_url_original()?>">    
    <?php 
        $validador -> mostrar_error_url();
    ?>
</div>
<div class="form-group">
    <label for="">Contenido</label>
    <textarea class="form-control" name="texto" id="texto" cols="30" rows="5" placeholder="Escribe aquí tu artículo"><?php $validador -> mostrar_texto(); ?></textarea>
    <input type="hidden" name="texto_original" id="texto_original" value="<?php echo $validador -> obtener_texto_original()?>">    
    <?php 
        $validador -> mostrar_error_texto();
    ?>
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="publicar" value="si" <?php if($validador ->obtener_checkbox()) echo 'checked';?>> Publicar Entrada 
        <input type="hidden" name="publicar_original" id="publicar_original" value="<?php echo $validador -> obtener_checkbox_original()?>">    
    </label>
</div>
<div class="float-right">
    <button type="submit" class="btn btn-info my-2 my-sm-0" name="guardar_cambios_entrada">Guardar cambios</button>
</div>

