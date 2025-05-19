<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form action="<?php echo $this->route . "?eleccion=" . $this->eleccion . ""; ?>" method="post">
		<div class="content-dashboard">
			<div class="row">
				<div class="col mb-3">
					<label class="form-label">Estado (Activo/Inactivo)</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>

						<select class="form-select" name="tarjeton_estado">

							<option value="1" <?php if ($this->getObjectVariable($this->filters, 'tarjeton_estado') == 1) {
																	echo 'selected';
																} ?>>Activo</option>
							<option value="0" <?php if ($this->getObjectVariable($this->filters, 'tarjeton_estado') == 0) {
																	echo 'selected';
																} ?>>Inactivo</option>
						</select>
					</label>
				</div>
				<div class="col mb-3">
					<label class="form-label">Nombre del tarjet&oacute;n</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="text" class="form-control" name="tarjeton_nombre" value="<?php echo $this->getObjectVariable($this->filters, 'tarjeton_nombre') ?>"></input>
					</label>
				</div>
				<div class="col mb-3">
					<label class="form-label">Cantidad de votos por usuario</label>
					<label class="input-group">
						<span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
						<input type="number" class="form-control" name="tarjeton_cantidad_votos" value="<?php echo $this->getObjectVariable($this->filters, 'tarjeton_cantidad_votos') ?>"></input>
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
						<a class="btn w-100 btn-azul-claro " href="<?php echo $this->route; ?>?cleanfilter=1&eleccion=<?= $this->eleccion ?>&origin=<?= $this->origin ?>"> <i class="fas fa-eraser"></i> Limpiar Filtro</a>
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
					<a class="btn btn-sm btn-success" href="#"
						data-bs-toggle="modal" data-bs-target="#modalCreateEdit">
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
							<td class="text-right d-flex justify-content-end align-items-center gap-1">

								<!-- <a 
								class="btn btn-morado btn-sm my-1" 
								href="<?php echo $this->route; ?>/editardelegados?votacion=<?= $this->eleccion ?>&tarjeton=<?= $id ?>" 
								data-bs-toggle="tooltip"
								 data-placement="top" title="Archivo de Delegados">
									Importar Candidatos
								</a> -->

								<div class="dropdown">
									<button class="btn btn-morado btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-expanded="false">
										Candidatos
									</button>

									<ul class="dropdown-menu dropdown-morado">
										<li>
											<a
												class="dropdown-item"
												href="/administracion/candidatos?votacion=<?= $this->eleccion ?>&tarjeton=<?= $id ?>&page=1&origin=tarjeton">Ver Candidatos

											</a>

										</li>
										<li>
											<a
												href="#"
												class="btn-cargar-candidatos dropdown-item"
												data-tarjeton="<?= $id ?>"
										
												data-bs-toggle="modal"
												data-bs-target="#modalCandidatos">
												Importar Candidatos
												<!-- <i class="fa-solid fa-users-gear"></i> -->
											</a>
										</li>
									</ul>
								</div>



								<!-- <a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>" data-bs-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen-alt"></i>old</a> -->

								<span class="btn btn-azul btn-sm my-1 btn-editar"
									data-votacion='{
									"id": "<?= $content->tarjeton_id ?>",
									"nombre": "<?= addslashes($content->tarjeton_nombre) ?>",
									"cantidad_votos": "<?= $content->tarjeton_cantidad_votos ?>",
									"estado": "<?= $content->tarjeton_estado ?>",
									"titulo": "<?= addslashes($content->tarjeton_titulo) ?>",
									"zona": "<?= $content->tarjeton_zona ?>",
									"mostrar_detalle": "<?= $content->tarjeton_mostrar_detalle ?>",
									"mostrar_suplente": "<?= $content->tarjeton_mostrar_suplente ?>",
									"voto_blanco": "<?= $content->tarjeton_voto_blanco ?>",
									"descripcion": "<?= addslashes($content->tarjeton_descripcion) ?>"
							}'
									data-bs-toggle="modal"
									data-bs-target="#modalCreateEdit"
									data-bs-toggle="tooltip"
									data-placement="top"
									title="Editar">
									<i class="fa-solid fa-pencil"></i>
								</span>
								<span
									data-bs-toggle="tooltip"
									data-placement="top"
									title="Eliminar">
									<a
										class="btn btn-rojo btn-sm"
										data-bs-toggle="modal"
										data-bs-target="#modal<?= $id ?>">
										<i class="fas fa-trash-alt"></i>
									</a>
								</span>

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

<!-- Modal CREAR EDITAR -->
<div class="modal fade" id="modalCreateEdit" tabindex="-1" aria-labelledby="modalCreateEditLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="/administracion/tarjetones/insert" method="post" id="formTarjeton">
				<div class="modal-body">
					<div class="row px-1">
						<div class="col-lg-12">
							<div class="caja_azul">
								<div class="d-flex justify-content-between align-items-center h-100">
									<div class="titulo_dashboard d-flex align-items-center">
										<div class="d-flex align-items-center gap-2">
											<i class="fa-solid fa-check-to-slot"></i> <span id="modalTitle">Crear nuevo tarjetón</span>
										</div>

										<button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
										</>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 mt-3 mb-3">
							<span class="detail-modal">Por favor ingrese los datos del tarjetón.</span>
						</div>

						<div class="col-12 mb-3">
							<div class="alert alert-info" role="alert" id="alerta-cantidad">
								La cantidad de votos que un usuario puede emitir solo se aplica cuando <strong>NO se está filtrando por zonas.</strong> En caso contrario, la cantidad máxima de votos permitidos por usuario se determina según la asignación específica de la zona del usuario. </div>
						</div>
						<input type="hidden" name="id" id="tarjeton_id">
						<input type="hidden" name="tarjeton_elecciones" id="votacion-tarjeton" value="<?php echo $this->eleccion; ?>">

						<div class="col-12 mb-3">

							<label class="input-group">

								<input type="text" name="tarjeton_nombre" placeholder="Nombre Del Tarjetón" id="tarjeton_nombre" class="form-control">
							</label>

						</div>

						<div class="col-12 mb-3" id="content-cantidad">

							<label class="input-group">

								<input type="number" placeholder="Cantidad De Votos Por Usuario" name="tarjeton_cantidad_votos" id="tarjeton_cantidad_votos" class="form-control">
							</label>

						</div>

						<div class="col-12 mb-3">

							<label class="input-group">

								<input type="text" name="tarjeton_titulo" placeholder="Título del Tarjetón" id="tarjeton_titulo" class="form-control">
							</label>

						</div>

						<div class="col-6 mb-3 d-flex flex-column justify-content-center align-items-center gap-1">
							<label class="form-label" for="tarjeton_estado">Tarjetón activo</label>
							<input type="checkbox" name="tarjeton_estado" id="tarjeton_estado" value="1" class="form-control switch-form ">

						</div>

						<div class="col-6 mb-3 d-flex flex-column justify-content-center align-items-center gap-1">
							<label class="form-label">Filtrar por zona</label>
							<input type="checkbox" name="tarjeton_zona" id="tarjeton_zona" value="1" class="form-control switch-form ">
						</div>

						<div class="col-6 mb-3 d-flex flex-column justify-content-center align-items-center gap-1">
							<label for="tarjeton_mostrar_detalle" class="form-label">Mostrar detalle</label>
							<input type="checkbox" name="tarjeton_mostrar_detalle" id="tarjeton_mostrar_detalle" value="1" class="form-control switch-form ">

						</div>



						<div class="col-6 mb-3 d-flex flex-column justify-content-center align-items-center gap-1">
							<label class="form-label">Mostrar suplente</label>
							<input type="checkbox" name="tarjeton_mostrar_suplente" id="tarjeton_mostrar_suplente" value="1" class="form-control switch-form ">

						</div>
						<div class="col-6 mb-3 d-flex flex-column justify-content-center align-items-center gap-1">
							<label class="form-label">Con voto en blanco</label>
							<input type="checkbox" name="tarjeton_voto_blanco" id="tarjeton_voto_blanco" value="1" class="form-control switch-form ">

						</div>
						<div class="col-12 d-none mb-3 flex-column justify-content-center align-items-center gap-1">
							<label class="form-label">Vista de cuadrícula</label>
							<input type="checkbox" name="tarjeton_mostrar_fotos" id="tarjeton_mostrar_fotos" value="1" class="form-control switch-form ">
						</div>

						<div class="col-12 mb-3">
							<div class="form-floating">
								<textarea class="form-control" placeholder="Descripci&oacute;n" name="tarjeton_descripcion" id="tarjeton_descripcion" style="height: 100px"></textarea>
								<label for="floatingTextarea2">Descripci&oacute;n</label>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-guardar w-100" type="submit">Guardar</button>

					<button type="button" class="btn btn-cancelar w-100" data-bs-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Seleccionar todos los botones de editar
		const botonesEditar = document.querySelectorAll('.btn-editar');

		botonesEditar.forEach(boton => {
			boton.addEventListener('click', function() {
				// Obtener los datos del atributo data-votacion
				const datos = JSON.parse(this.getAttribute('data-votacion'));
				console.log(datos);
				// Llenar los campos del modal con los datos
				document.getElementById('tarjeton_id').value = datos.id;
				document.getElementById('tarjeton_nombre').value = datos.nombre;
				document.getElementById('tarjeton_cantidad_votos').value = datos.cantidad_votos;
				document.getElementById('tarjeton_titulo').value = datos.titulo;
				document.getElementById('tarjeton_estado').checked = datos.estado == 1;
				document.getElementById('tarjeton_zona').checked = datos.zona == 1;
				document.getElementById('tarjeton_mostrar_detalle').checked = datos.mostrar_detalle == 1;
				document.getElementById('tarjeton_mostrar_suplente').checked = datos.mostrar_suplente == 1;
				document.getElementById('tarjeton_voto_blanco').checked = datos.voto_blanco == 1;

				if (datos.estado == 1) {
					$('#tarjeton_estado').bootstrapToggle('on');
				} else {
					$('#tarjeton_estado').bootstrapToggle('off');
				}

				if (datos.zona == 1) {
					$('#tarjeton_zona').bootstrapToggle('on');
				} else {
					$('#tarjeton_zona').bootstrapToggle('off');
				}

				if (datos.mostrar_detalle == 1) {
					$('#tarjeton_mostrar_detalle').bootstrapToggle('on');
				} else {
					$('#tarjeton_mostrar_detalle').bootstrapToggle('off');
				}

				if (datos.mostrar_suplente == 1) {
					$('#tarjeton_mostrar_suplente').bootstrapToggle('on');
				} else {
					$('#tarjeton_mostrar_suplente').bootstrapToggle('off');
				}

				if (datos.voto_blanco == 1) {
					$('#tarjeton_voto_blanco').bootstrapToggle('on');
				} else {
					$('#tarjeton_voto_blanco').bootstrapToggle('off');
				}



				// Cambiar el título del modal
				document.getElementById('modalTitle').innerText = 'Editar Tarjetón';

				// Cambiar la acción del formulario
				document.getElementById('formTarjeton').action = '/administracion/tarjetones/update';
			});
		});
	});
</script>

<!-- Modal  CARGARCANDIDATOS	 -->
<div class="modal fade" id="modalCandidatos" tabindex="-1" aria-labelledby="modalCandidatosLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form enctype="multipart/form-data" method="post" action="/administracion/tarjetones/updatedelegados" method="post" id="formTarjeton">
				<div class="modal-body">
					<div class="row px-1">
						<div class="col-lg-12">
							<div class="caja_azul">
								<div class="d-flex justify-content-between align-items-center h-100">
									<div class="titulo_dashboard d-flex align-items-center">
										<div class="d-flex align-items-center gap-2">
											<i class="fa-solid fa-check-to-slot"></i> Cargar candidatos para la elección <span id="modalTitleCandidatos"></span>
										</div>

										<button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
										</>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 mt-3 mb-3 d-none">
							<span class="detail-modal">Por favor cargue el documento.</span>
						</div>



						<input type="hidden" name="tarjeton" id="tarjeton">
						<input type="hidden" name="origin" id="origin" value="tarjetones">

						<input type="hidden" name="votacion" id="votacion-tarjeton" value="<?php echo $this->eleccion; ?>">

						<div class="col-12 my-3">
							<div class="col-12 text-end mb-3" align="right">
								<a href="/skins/page/files/candidatosejemplo.xlsx" class="custom-btn-home me-2">
									<span class="add-button-home lf-part">Descargar archivo de ejemplo</span>
									<span class="rg-part"><i class="fas fa-plus"></i></span>
								</a>
							</div>
						</div>
						<div class="col-12 form-group">

							<input type="file" name="archivo" id="archivo" class="form-control  file-document" data-buttonName="btn-primary" onchange="validardocumento('archivo');" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, .xlsx" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-guardar w-100" type="submit">Cargar</button>

						<button type="button" class="btn btn-cancelar w-100" data-bs-dismiss="modal">Cancelar</button>
					</div>
			</form>
		</div>
	</div>
</div>