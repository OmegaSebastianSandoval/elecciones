<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">

	<div class="content-dashboard">
		<?php if (count($this->lists) >= 1) { ?>

			<div class="d-flex justify-content-end gap-4 ">
				<a href="/administracion/resultados?votacion=<?= $this->votacion ?>" class="btn btn-success mb-3 d-flex align-items-center gap-2 w-fit me-auto"> <i class="fa-solid fa-arrow-left"></i> Volver</a>

				<a target="_blank" href="<?php echo $this->route; ?>/verexportar?votacion=<?= $this->votacion ?>&excel=1" data-bs-toggle="tooltip" data-placement="top" title="Exportar" class="custom-btn-home ">
					<span class="add-button-home lf-part">Exportar</span>
					<span class="rg-part"><i class="fas fa-plus"></i></span>
				</a>


				<a target="_blank" href="<?php echo $this->route; ?>/verexportarvotantes?votacion=<?= $this->votacion ?>&excel=1" data-bs-toggle="tooltip" data-placement="top" title="Exportar" class="custom-btn-home ">
					<span class="add-button-home lf-part">Exportar Votantes</span>
					<span class="rg-part"><i class="fas fa-plus"></i></span>
				</a>

				<a target="_blank" href="<?php echo $this->route; ?>/verexportarvotanteszona?votacion=<?= $this->votacion ?>&excel=1" data-bs-toggle="tooltip" data-placement="top" title="Exportar" class="custom-btn-home ">
					<span class="add-button-home lf-part">Exportar Votantes Por Zona</span>
					<span class="rg-part"><i class="fas fa-plus"></i></span>
				</a>
			</div>
			<div class="content-table m-0">

				<table class=" table table-striped  table-hover table-administrator text-left">
					<thead>
						<tr>
							<td>Usuario</td>
							<td>Fecha</td>
							<td>Candidato</td>
							<td>tarjeton</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($this->lists as $content) { ?>
							<?php $id =  $content->id; ?>
							<tr>

								<td><?= $this->list_usuarios[$content->usuario]; ?></td>
								<td><?= $content->fecha; ?></td>
								<td><?= $this->list_candidatos[$content->candidato]; ?></td>
								<td><?= $this->list_tarjeton[$content->tarjeton]; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>


			</div>
		<?php } else { ?>
			<div class="d-flex ">
				<a href="/administracion/resultados?votacion=<?= $this->votacion ?>" class="btn btn-success mb-3 d-flex align-items-center gap-2 w-fit me-auto"> <i class="fa-solid fa-arrow-left"></i> Volver</a>
			</div>

			<div class="alert alert-warning text-center" role="alert">
				No hay registros
			</div>
		<?php } ?>

	</div>
</div>