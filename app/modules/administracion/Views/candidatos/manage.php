<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>" data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="votacion" id="votacion" value="<?php echo $this->votacion; ?>" />
			<input type="hidden" name="tarjeton" id="tarjeton" value="<?php echo $this->tarjeton; ?>" />
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->id; ?>" />
			<?php } ?>
			<div class="row">

				<div class="col-md-3 mb-3">
					<label for="numero" class="form-label">Numero</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->numero; ?>" name="numero" id="numero" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-md-3 mb-3">
					<label for="nombre" class="form-label">Nombre</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->nombre; ?>" name="nombre" id="nombre" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-md-3 mb-3 d-none">
					<label for="suplente" class="form-label">Suplente</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->suplente; ?>" name="suplente" id="suplente" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-md-3 mb-3">
					<label class="form-label">Zona</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="far fa-list-alt"></i></span>
						<select class="form-select" name="zona">
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_zona as $key => $value) { ?>
								<option <?php if ($this->getObjectVariable($this->content, "zona") == $key) {
													echo "selected";
												} ?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-md-3 mb-3 d-none">
					<label for="lista" class="form-label">Lista</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->lista; ?>" name="lista" id="lista" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-md-3 mb-3  d-none">
					<label for="detalle" class="form-label">Detalle</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->detalle; ?>" name="detalle" id="detalle" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-md-3 mb-3">
					<label for="candidato_tarjeton" class="form-label">Tarjeton</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->candidato_tarjeton ? $this->content->candidato_tarjeton : $this->tarjeton; ?> " name="candidato_tarjeton" id="candidato_tarjeton" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-md-3 mb-3 d-none">
					<label for="cedula" class="form-label">Cedula</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->cedula; ?>" name="cedula" id="cedula" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-md-4 mb-3">
					<label for="foto">Foto</label>
					<input type="file" name="foto" id="foto" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png">
					<div class="help-block with-errors"></div>
					<?php if ($this->content->foto) { ?>
						<div id="imagen_foto">
							<img src="/images/<?= $this->content->foto; ?>" class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('foto','<?php echo $this->route . "/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove"></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?votacion=<?php echo $this->votacion; ?>&tarjeton=<?php echo $this->tarjeton; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>