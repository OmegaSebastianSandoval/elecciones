<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">

	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>" data-bs-toggle="validator">
		<div class="content-dashboard">
			<div class="alert alert-info" role="alert" id="alerta-cantidad">
				La cantidad de votos que un usuario puede emitir solo se aplica cuando <strong>NO se está filtrando por zonas.</strong> En caso contrario, la cantidad máxima de votos permitidos por usuario se determina según la asignación específica de la zona del usuario. </div>
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->tarjeton_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->tarjeton_id; ?>" />
			<?php } ?>
			<div class="row">

				<div class="col-4 mb-3">
					<label for="tarjeton_nombre" class="form-label">Nombre Del Tarjetón</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->tarjeton_nombre; ?>" name="tarjeton_nombre" id="tarjeton_nombre" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-4 mb-3" id="content-cantidad">
					<label for="tarjeton_cantidad_votos" class="form-label">Cantidad De Votos Por Usuario</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->tarjeton_cantidad_votos; ?>" name="tarjeton_cantidad_votos" id="tarjeton_cantidad_votos" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-4 mb-3">
					<label for="tarjeton_titulo" class="form-label">Título del Tarjetón</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" value="<?= $this->content->tarjeton_titulo; ?>" name="tarjeton_titulo" id="tarjeton_titulo" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col mb-3">
					<label class="form-label" for="tarjeton_estado">Estado</label><br>
					<input type="checkbox" name="tarjeton_estado" id="tarjeton_estado" value="1" class="form-control switch-form " <?php if ($this->content->tarjeton_estado == 1) {
																																																														echo "checked";
																																																													} ?>>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col mb-3">
					<label class="form-label">Filtrar por zona</label><br>
					<input type="checkbox" name="tarjeton_zona" id="tarjeton_zona" value="1" class="form-control switch-form "
						<?php if ($this->getObjectVariable($this->content, 'tarjeton_zona') == 1) {
							echo "checked";
						} ?>>
				</div>

				<div class="col mb-3">
					<label for="tarjeton_mostrar_detalle" class="form-label">Mostrar detalle</label><br>
					<input type="checkbox" name="tarjeton_mostrar_detalle" value="1" class="form-control switch-form "
						<?php if ($this->getObjectVariable($this->content, 'tarjeton_mostrar_detalle') == 1) {
							echo "checked";
						} ?>>
					<div class="help-block with-errors"></div>
				</div>

				<input type="hidden" name="tarjeton_elecciones" value="<?php if ($this->content->tarjeton_elecciones) {
																																	echo $this->content->tarjeton_elecciones;
																																} else {
																																	echo $this->eleccion;
																																} ?>">

				<div class="col mb-3">
					<label class="form-label">Mostrar suplente</label><br>
					<input type="checkbox" name="tarjeton_mostrar_suplente" value="1" class="form-control switch-form "
						<?php if ($this->getObjectVariable($this->content, 'tarjeton_mostrar_suplente') == 1) {
							echo "checked";
						} ?>>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 d-none mb-3">
					<label class="form-label">Vista de cuadrícula</label><br>
					<input type="checkbox" name="tarjeton_mostrar_fotos" value="1" class="form-control switch-form "
						<?php if ($this->getObjectVariable($this->content, 'tarjeton_mostrar_fotos') == 1) {
							echo "checked";
						} ?>>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 mb-3">
					<label for="tarjeton_descripcion" class="form-label">Descripci&oacute;n</label>
					<textarea name="tarjeton_descripcion" id="tarjeton_descripcion" class="form-control tinyeditor" rows="10"><?= $this->content->tarjeton_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?eleccion=<?php if ($this->content->tarjeton_elecciones) {
																											echo $this->content->tarjeton_elecciones;
																										} else {
																											echo $this->eleccion;
																										} ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>


<script>

</script>