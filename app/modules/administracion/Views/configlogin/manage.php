<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"  data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->config_login_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->config_login_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-6 form-group">
					<label for="config_login_imagen" >Imagen</label>
					<input type="file" name="config_login_imagen" id="config_login_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png, image/webp"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->config_login_imagen) { ?>
						<div id="imagen_config_login_imagen">
							<img src="/images/<?= $this->content->config_login_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('config_login_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-6 form-group">
					<label for="config_login_titulo"  class="control-label">Titulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->config_login_titulo; ?>" name="config_login_titulo" id="config_login_titulo" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="config_login_subtitulo" class="form-label" >Subtitulo</label>
					<textarea name="config_login_subtitulo" id="config_login_subtitulo"   class="form-control tinyeditor" rows="10"   ><?= $this->content->config_login_subtitulo; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>