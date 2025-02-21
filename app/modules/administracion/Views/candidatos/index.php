<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form action="<?php echo $this->route; ?>" method="post">
		<div class="content-dashboard">
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Numero</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" class="form-control" name="numero" value="<?php echo $this->getObjectVariable($this->filters, 'numero') ?>"></input>
					</label>
				</div>
				<div class="col mb-3">
					<label class="form-label">Nombre</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" class="form-control" name="nombre" value="<?php echo $this->getObjectVariable($this->filters, 'nombre') ?>"></input>
					</label>
				</div>
				<div class="col mb-3">
					<label class="form-label">Cedula</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" class="form-control" name="cedula" value="<?php echo $this->getObjectVariable($this->filters, 'cedula') ?>"></input>
					</label>
				</div>
				<div class="col mb-3">
					<label class="form-label">Zona</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<select class="form-select" name="zona">
							<option value="">Seleccione</option>
							<?php foreach ($this->list_zona as $key => $value) { ?>
								<option value="<?php echo $key; ?>" <?php if ($this->getObjectVariable($this->filters, 'zona') == $key) {
																											echo 'selected';
																										} ?>><?php echo $value; ?></option>
							<?php } ?>
						</select>


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
						<a class="btn w-100 btn-azul-claro " href="<?php echo $this->route; ?>?cleanfilter=1"> <i class="fas fa-eraser"></i> Limpiar Filtro</a>
					</label>
				</div>
			</div>
		</div>
	</form>
	<div align="center">
		<ul class="pagination justify-content-center mb-3">
			<?php
			$url = $this->route;
			$votacion = $this->votacion;
			$tarjeton = $this->tarjeton;
			$queryParams = "votacion={$votacion}&tarjeton={$tarjeton}";

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
	<div class="content-dashboard mb-3">
		<?php if ($this->votacion && $this->tarjeton) { ?>
			<a href="/administracion/candidatos/tarjetones?votacion=<?= $this->votacion ?>&page=1" class="btn btn-success mb-3 d-flex align-items-center gap-2 w-fit"> <i class="fa-solid fa-arrow-left"></i> Volver</a>
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
					<a class="btn btn-sm btn-success" href="<?php echo $this->route . "\manage?votacion=" . $this->votacion . "&tarjeton=" . $this->tarjeton; ?>">
						<i class="fas fa-plus-square"></i> Crear Nuevo
					</a>
				</div>
			</div>
		</div>
		<div class="content-table m-0">
			<table class=" table table-striped  table-hover table-administrator text-left">
				<thead>
					<tr>
						<td>Numero</td>
						<td>Nombre</td>
						<td>Detalle</td>
						<td>Tarjetón</td>
						<td>Zona</td>
						<td>Foto</td>

						<td width="100"></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->lists as $content) { ?>
						<?php $id =  $content->id; ?>
						<tr>
							<td><?= $content->numero; ?></td>
							<td><?= $content->nombre; ?></td>
							<td><?= $content->detalle; ?></td>
							<td><?= $content->candidato_tarjeton; ?></td>
							<td><?= $this->list_zona[$content->zona]; ?></td>
							<td>
								<?php if ($content->foto) { ?>
									<img src="/images/<?= $content->foto; ?>" class="img-thumbnail thumbnail-administrator" />
								<?php } ?>
								<!--<div><?= $content->foto; ?></div>-->
							</td>
							<td class="text-right">
								<div>
									<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>&votacion=<?= $this->votacion ?>&tarjeton=<?= $this->tarjeton; ?>"><i class="fas fa-pencil-alt"></i></a>
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
												<a class="btn btn-danger" href="<?php echo $this->route; ?>/delete?id=<?= $id ?>&csrf=<?= $this->csrf; ?>&votacion=<?= $this->votacion ?>&tarjeton=<?= $this->tarjeton; ?>">Eliminar</a>
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
	<ul class="pagination justify-content-center mb-3">
    <?php
    $url = $this->route;
    $votacion = $this->votacion;
    $tarjeton = $this->tarjeton;
    $queryParams = "votacion={$votacion}&tarjeton={$tarjeton}";

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