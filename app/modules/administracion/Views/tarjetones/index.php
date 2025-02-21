<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form action="<?php echo $this->route . "?eleccion=" . $this->eleccion . ""; ?>" method="post">
		<div class="content-dashboard">
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Estado (Activar)</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" class="form-control" name="tarjeton_estado" value="<?php echo $this->getObjectVariable($this->filters, 'tarjeton_estado') ?>"></input>
					</label>
				</div>
				<div class="col mb-3">
					<label class="form-label">Nombre Del Tarjet&oacute;n</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" class="form-control" name="tarjeton_nombre" value="<?php echo $this->getObjectVariable($this->filters, 'tarjeton_nombre') ?>"></input>
					</label>
				</div>
				<div class="col mb-3">
					<label class="form-label">Cantidad De Votos Por Usuario</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" class="form-control" name="tarjeton_cantidad_votos" value="<?php echo $this->getObjectVariable($this->filters, 'tarjeton_cantidad_votos') ?>"></input>
					</label>
				</div>
				<div class="col mb-3">
					<label class="form-label">&nbsp;</label>
					<label class="input-group">
						<button type="submit" class="btn w-100 btn-azul"> <i class="fas fa-filter"></i> Filtrar</button>
					</label>
				</div>
				<div class="col mb-3">
					<label class="form-label">&nbsp;</label>
					<label class="input-group">
						<a class="btn w-100 btn-azul-claro " href="<?php echo $this->route; ?>?cleanfilter=1"> <i class="fas fa-eraser"></i> Limpiar Filtro</a>
					</label>
				</div>
			</div>
		</div>
	</form>
	<div align="center">
		<ul class="pagination justify-content-center">
			<?php
			$min = $this->page - 10;
			$max = $this->page + 10;

			if ($this->totalpages > 1) {
				if ($this->page != 1) {
					echo '<li class="page-item" ><a class="page-link"  href="' . $url . '?page=' . ($this->page - 1) . '">&laquo; Anterior </a></li>';
				}
				for ($i = 1; $i <= $this->totalpages; $i++) {
					if ($this->page == $i) {
						echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
					} else {
						if ($i >= $min and $i <= $max) {
							echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>';
						}
					}
				}
				if ($this->page != $this->totalpages) {
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
				}
			}
			?>
		</ul>
	</div>
	<div class="content-dashboard">
		<?php if ($this->eleccion) { ?>
			<a href="/administracion/configvotacion" class="btn btn-success mb-3 d-flex align-items-center gap-2 w-fit"> <i class="fa-solid fa-arrow-left"></i> Volver</a>
		<?php } ?>
		<div class="franja-paginas mb-3">
			<div class="row align-items-center">
				<div class="col-5">
					<div class="titulo-registro">Se encontraron <?php echo $this->register_number; ?> Registros</div>
				</div>
				<div class="col-5 d-flex align-items-center">
					<div class="texto-paginas me-2">Registros por página:</div>
					<select class="form-select form-select-sm selectpagination" style="width: auto;">
						<option value="20" <?php if ($this->pages == 20) {
																	echo 'selected';
																} ?>>20</option>
						<option value="30" <?php if ($this->pages == 30) {
																	echo 'selected';
																} ?>>30</option>
						<option value="50" <?php if ($this->pages == 50) {
																	echo 'selected';
																} ?>>50</option>
						<option value="100" <?php if ($this->pages == 100) {
																	echo 'selected';
																} ?>>100</option>
					</select>
				</div>
				<div class="col-2 text-end">
					<a class="btn btn-sm btn-success" href="<?php echo $this->route . "\manage" . "?eleccion=" . $this->eleccion . ""; ?>">
						<i class="fas fa-plus-square"></i> Crear Nuevo
					</a>
				</div>
			</div>
		</div>
		<?php if ($this->votacion_actual_error) { ?>
      <div class="alert alert-<?= $this->votacion_actual_tipo ?> m-3" role="alert">
        <?php echo $this->votacion_actual_error ?>
      </div>
    <?php } ?>
		
		<div class="content-table m-0">
			<table class=" table table-striped  table-hover table-administrator text-left">
				<thead>
					<tr>
						<td>ID del Tarjeton</td>

						<td>Nombre Del Tarjet&oacute;n</td>
						<td>Cantidad De Votos Por Usuario</td>
						<td>Estado</td>
						<td width="100">Orden</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->lists as $content) { ?>
						<?php $id =  $content->tarjeton_id; ?>
						<tr>
							<td><?= $content->tarjeton_id; ?></td>

							<td><?= $content->tarjeton_nombre; ?></td>
							<td><?= $content->tarjeton_cantidad_votos; ?></td>
							<td><?= ($content->tarjeton_estado == 1) ? 'Activo' : 'Inactivo'; ?></td>
							<td>
								<input type="hidden" id="<?= $id; ?>" value="<?= $content->orden; ?>"></input>
								<button class="up_table btn btn-primary btn-sm"><i class="fas fa-angle-up"></i></button>
								<button class="down_table btn btn-primary btn-sm"><i class="fas fa-angle-down"></i></button>
							</td>
							<td class="text-right">

								<a class="btn btn-morado btn-sm my-1" href="<?php echo $this->route; ?>/editardelegados?votacion=<?= $this->eleccion ?>&tarjeton=<?= $id?>" data-bs-toggle="tooltip" data-placement="top" title="Archivo de Delegados">
									Importar Candidatos
									<!-- <i class="fa-solid fa-users-gear"></i> -->
								</a>
								<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>" data-bs-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen-alt"></i></a>
								<span data-bs-toggle="tooltip" data-placement="top" title="Eliminar"><a class="btn btn-rojo btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>"><i class="fas fa-trash-alt"></i></a></span>

								<!-- Modal -->
								<div class="modal fade text-left" id="modal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<div class="">¿Esta seguro de eliminar este registro?</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
												<a class="btn btn-danger" href="<?php echo $this->route; ?>/delete?id=<?= $id ?>&csrf=<?= $this->csrf; ?><?php echo '' . '&eleccion=' . $this->eleccion; ?>">Eliminar</a>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<input type="hidden" id="csrf" value="<?php echo $this->csrf ?>"><input type="hidden" id="order-route" value="<?php echo $this->route; ?>/order"><input type="hidden" id="page-route" value="<?php echo $this->route; ?>/changepage">
	</div>
	<div align="center">
		<ul class="pagination justify-content-center">
			<?php
			$url = $this->route;
			if ($this->totalpages > 1) {
				if ($this->page != 1)
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page - 1) . '&eleccion=' . $this->eleccion . '"> &laquo; Anterior </a></li>';
				for ($i = 1; $i <= $this->totalpages; $i++) {
					if ($this->page == $i)
						echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
					else
						echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '&eleccion=' . $this->eleccion . '">' . $i . '</a></li>  ';
				}
				if ($this->page != $this->totalpages)
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '&eleccion=' . $this->eleccion . '">Siguiente &raquo;</a></li>';
			}
			?>
		</ul>
	</div>
</div>