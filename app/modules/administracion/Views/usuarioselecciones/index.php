<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form action="<?php echo $this->route; ?>?votacion=<?php echo $this->votacion?>" method="post">
		<div class="content-dashboard">
			<div class="row">
				<div class="col">
					<label class="form-label">Cedula</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" class="form-control" name="cedula" value="<?php echo $this->getObjectVariable($this->filters, 'cedula') ?>"></input>
					</label>
				</div>
				<div class="col">
					<label class="form-label">Nombre</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" class="form-control" name="nombre" value="<?php echo $this->getObjectVariable($this->filters, 'nombre') ?>"></input>
					</label>
				</div>
				<div class="col">
					<label class="form-label">Correo</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" class="form-control" name="correo" value="<?php echo $this->getObjectVariable($this->filters, 'correo') ?>"></input>
					</label>
				</div>
				<div class="col">
					<label class="form-label">&nbsp;</label>
					<label class="input-group">
						<button type="submit" class="btn w-100 btn-azul"> <i class="fas fa-filter"></i> Filtrar</button>
					</label>
				</div>
				<div class="col">
					<label class="form-label">&nbsp;</label>
					<label class="input-group">
						<a class="btn w-100 btn-azul-claro " href="<?php echo $this->route; ?>?cleanfilter=1&votacion=<?php echo $this->votacion?>"> <i class="fas fa-eraser"></i> Limpiar Filtro</a>
					</label>

				</div>
			</div>
		</div>
	</form>
	<div align="center">
		<ul class="pagination justify-content-center">
			<?php
			$url = $this->route;
			$votacion = $this->votacion;

			$queryParams = "votacion={$votacion}";

			$min = max(1, $this->page - 10); // Evita valores negativos o menores a 1
			$max = min($this->totalpages, $this->page + 10); // No supera el total de páginas

			if ($this->totalpages > 1) {
				// Botón "Anterior"
				if ($this->page != 1) {
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page - 1) . '&' . $queryParams . '">&laquo; Anterior</a></li>';
				}

				// Iterar solo desde $min hasta $max
				for ($i = $min; $i <= $max; $i++) {
					if ($this->page == $i) {
						echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
					} else {
						echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '&' . $queryParams . '">' . $i . '</a></li>';
					}
				}

				// Botón "Siguiente"
				if ($this->page != $this->totalpages) {
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '&' . $queryParams . '">Siguiente &raquo;</a></li>';
				}
			}
			?>
		</ul>
	</div>
	<div class="content-dashboard">
		<?php if ($this->votacion) { ?>
			<a href="/administracion/usuarioselecciones/elecciones" class="btn btn-success mb-3 d-flex align-items-center gap-2 w-fit"> <i class="fa-solid fa-arrow-left"></i> Volver</a>
		<?php } ?>
		<div class="franja-paginas mb-3">
			<div class="row align-items-center">
				<div class="col-4">
					<div class="titulo-registro">Se encontraron <?php echo $this->register_number; ?> Registros</div>
				</div>
				<div class="col-4 d-flex align-items-center">
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
				<div class="col-4">
					<div class="d-flex justify-content-end">
						<a class="btn btn-sm btn-success me-1" href="<?php echo $this->route . "/manage?votacion=".$this->votacion; ?>">
							<i class="fas fa-plus-square"></i> Crear Nuevo
						</a>
						<a class="btn btn-sm btn-success btn-verde me-1" target="_blank" href="<?php echo $this->route . "/exportarcambios?excel=1&votacion=".$this->votacion; ?>">
							<i class="fa-solid fa-file-excel"></i> Exportar cambios
						</a>
						<a class="btn btn-sm btn-success btn-verde" target="_blank" href="<?php echo $this->route . "/exportarusuarios?excel=1&votacion=".$this->votacion; ?>">
							<i class="fa-solid fa-file-excel"></i> Exportar usuario
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="content-table m-0">
			<table class=" table table-striped  table-hover table-administrator text-left">
				<thead>
					<tr>
						<td>Cedula</td>
						<td>Nombre</td>
						<td>Correo</td>
						<td>Zona</td>
						<td width="100"></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->lists as $content) { ?>
						<?php $id =  $content->id; ?>
						<tr>
							<td><?= $content->cedula; ?></td>
							<td><?= $content->nombre; ?></td>
							<td><?= $content->correo; ?></td>
							<td><?= $this->list_zona[$content->zona]; ?></td>
							<td class="text-right">
								<div>
									<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>&votacion=<?php echo $this->votacion?>" data-bs-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen-alt"></i></a>
									<span data-bs-toggle="tooltip" data-placement="top" title="Eliminar"><a class="btn btn-rojo btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>"><i class="fas fa-trash-alt"></i></a></span>
								</div>
								<!-- Modal -->
								<div class="modal fade text-left" id="modal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
												<button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<div class="">¿Esta seguro de eliminar este registro?</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
												<a class="btn btn-danger" href="<?php echo $this->route; ?>/delete?id=<?= $id ?>&csrf=<?= $this->csrf; ?><?php echo ''; ?>&votacion=<?php echo $this->votacion?>">Eliminar</a>
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
		<input type="hidden" id="csrf" value="<?php echo $this->csrf ?>"><input type="hidden" id="page-route" value="<?php echo $this->route; ?>/changepage">
	</div>
	<div align="center">
		<ul class="pagination justify-content-center">
			<?php
			$url = $this->route;
			$votacion = $this->votacion;

			$queryParams = "votacion={$votacion}";

			$min = max(1, $this->page - 10); // Evita valores negativos o menores a 1
			$max = min($this->totalpages, $this->page + 10); // No supera el total de páginas

			if ($this->totalpages > 1) {
				// Botón "Anterior"
				if ($this->page != 1) {
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page - 1) . '&' . $queryParams . '">&laquo; Anterior</a></li>';
				}

				// Iterar solo desde $min hasta $max
				for ($i = $min; $i <= $max; $i++) {
					if ($this->page == $i) {
						echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
					} else {
						echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '&' . $queryParams . '">' . $i . '</a></li>';
					}
				}

				// Botón "Siguiente"
				if ($this->page != $this->totalpages) {
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '&' . $queryParams . '">Siguiente &raquo;</a></li>';
				}
			}
			?>
		</ul>
	</div>
</div>