<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>" data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->id; ?>" />
			<?php } ?>
			<div class="row">
			<div class="col-12 col-lg-6 mb-3">
					<label for="votacion_titulo" class="form-label">Titulo</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->votacion_titulo; ?>" name="votacion_titulo" id="votacion_titulo" class="form-control" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-6 col-lg-3 mb-3">
					<label for="fecha_inicio" class="form-label">Fecha inicio votación</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="datetime-local" value="<?= $this->content->fecha_inicio; ?>" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6  col-lg-3 mb-3">
					<label for="fecha_final" class="form-label">Fecha Final votación</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="datetime-local" value="<?= $this->content->fecha_final; ?>" name="fecha_final" id="fecha_final" class="form-control" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-3q mb-3 d-none">
					<label  class="form-label">Activar vista de cuadricula</label>
					<br>
						<input type="checkbox" name="modo_candidatos" value="1" class="form-control switch-form" <?php if ($this->getObjectVariable($this->content, 'modo_candidatos') == 1) { echo "checked"; } ?>>
					 
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-3 mb-3  d-none">
					<label class="form-label">Pedir Actualizar telefono</label>
					<br>
					<input type="checkbox" name="votacion_pedir_telefono" value="1" class="form-control switch-form" <?php if ($this->getObjectVariable($this->content, 'votacion_pedir_telefono') == 1) { echo "checked";} ?>   ></input>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-3  col-lg-3 mb-3">
					<label   class="form-label">Votación actual</label>
					<br>
					<input type="checkbox" name="votacion_actual" value="1" class="form-control switch-form" <?php if ($this->getObjectVariable($this->content, 'votacion_actual') == 1) { echo "checked";} ?>   ></input>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-3  col-lg-3 mb-3">
					<label   class="form-label">Mostrar campo comentario</label>
					<br>
					<input type="checkbox" name="votacion_mostrar_campo" value="1" class="form-control switch-form" <?php if ($this->getObjectVariable($this->content, 'votacion_mostrar_campo') == 1) { echo "checked";} ?>   ></input>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-6 mb-3">
					<label for="votacion_texto_campo" class="form-label">Comentario</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->votacion_texto_campo; ?>" name="votacion_texto_campo" id="votacion_texto_campo" class="form-control">
					</label>
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