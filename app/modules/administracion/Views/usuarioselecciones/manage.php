<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>" data-bs-toggle="validator">
		<div class="content-dashboard">
		<input type="hidden" name="votacion" id="votacion" value="<?php echo $this->votacion ?>">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->id; ?>" />
			<?php } ?>
			<input type="hidden" name="votacion" id="votacion" value="<?= $this->votacion ?>" />
			<div class="row">
				<div class="col-3 mb-3">
					<label for="cedula" class="form-label">Cedula</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->cedula; ?>" name="cedula" id="cedula" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-3 mb-3">
					<label for="clave" class="form-label">Clave</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="password" value="" name="clave" id="clave" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-3 mb-3">
					<label for="nombre" class="form-label">Nombre</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->nombre; ?>" name="nombre" id="nombre" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-3 mb-3">
					<label for="correo" class="form-label">Correo</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->correo; ?>" name="correo" id="correo" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-3 mb-3">
					<label for="celular" class="form-label">Celular</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->celular; ?>" name="celular" id="celular" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-3 mb-3">
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
				<div class="col-3 mb-3">
					<label class="form-label">Activo</label><br>
					<input type="checkbox" name="activo" value="1" class="form-control switch-form "
					<?php if ($this->getObjectVariable($this->content, 'activo') == 1) { echo "checked"; } ?>>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-3 mb-3">
					<label class="form-label">¿Ya votó?</label><br>
					<input readonly type="checkbox" name="estado" value="1" class="form-control switch-form"
					<?php if ($this->getObjectVariable($this->content, 'estado') == 1) { echo "checked"; } ?>>
					<div class="help-block with-errors"></div>
				</div>

			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?votacion=<?php echo $this->votacion?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>

<?php if ($this->error == 2) { ?>
	<script>
		Swal.fire({
			icon: "info",
			title: "Error",
			text: "Si el usuario ya votó no es posible cambiarle la zona",
			confirmButtonColor: "#74bc1f",

		});
	</script>
<?php } ?>