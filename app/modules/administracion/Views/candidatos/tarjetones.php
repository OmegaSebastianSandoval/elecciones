<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">

	<div align="center">
		<ul class="pagination justify-content-center">
		<?php
			$url = $this->route."/tarjetones";
			$votacion = $this->votacion;
			$tarjeton = $this->tarjeton;
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
			<a href="/administracion/candidatos/elecciones?page=1" class="btn btn-success mb-3 d-flex align-items-center gap-2 w-fit"> <i class="fa-solid fa-arrow-left"></i> Volver</a>
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
					<a class="btn btn-sm btn-success d-none" href="<?php echo $this->route . "\manage" . "?eleccion=" . $this->eleccion . ""; ?>">
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

								<a class="btn btn-morado btn-sm my-1" href="<?php echo $this->route; ?>?votacion=<?= $this->votacion ?>&tarjeton=<?= $id?>&page=1" data-bs-toggle="tooltip" data-placement="top" title="Archivo de Delegados">
									Ver Candidatos
									<!-- <i class="fa-solid fa-users-gear"></i> -->
								</a>
							
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
						$url = $this->route."/tarjetones";

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