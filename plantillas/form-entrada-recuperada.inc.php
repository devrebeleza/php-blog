<input type="hidden" id="id_entrada_recup" name="id_entrada_recup" value="<?php echo $id_entrada_recup?>">
<div class="form-group">
    <label for="">Título</label>
    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ingresa un título" 
    value="<?php echo $entrada_recuperada -> getTitulo()?>">    
    <input type="hidden" name="titulo_original" id="titulo_original" value="<?php echo $entrada_recuperada -> getTitulo()?>">        
</div>
<div class="form-group">
    <label for="">URL</label>
    <input type="text" class="form-control" name="url" id="url" placeholder="Dirección única para la entrada sin espacios"
    value="<?php echo $entrada_recuperada -> getUrl()?>">
    <input type="hidden" name="url_original" id="url_original" value="<?php echo $entrada_recuperada -> getUrl()?>">    
</div>
<div class="form-group">
    <label for="">Contenido</label>
    <textarea class="form-control" name="texto" id="texto" cols="30" rows="5"
     placeholder="Escribe aquí tu artículo"><?php echo $entrada_recuperada -> getTexto()?></textarea>
     <input type="hidden" name="texto_original" id="texto_original" value="<?php echo $entrada_recuperada -> getTexto()?>">    
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="publicar" value="si" <?php if($entrada_recuperada->esta_activa()) echo 'checked'; ?> > Publicar Entrada 
        <input type="hidden" name="publicar_original" id="publicar_original" value="<?php echo $entrada_recuperada -> esta_activa()?>">
    </label>    
</div>
<div class="float-right">
    <button type="submit" class="btn btn-info my-2 my-sm-0" name="guardar_cambios_entrada">Guardar cambios</button>
</div>