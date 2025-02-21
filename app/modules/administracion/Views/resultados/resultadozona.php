<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">

	<div class="content-dashboard">
	<div class="d-flex justify-content-end gap-4 pe-3">
			<a class="btn btn-verde" target="_blank" href="<?php echo $this->route; ?>/resultadozonaexprotar?excel=1" data-bs-toggle="tooltip" data-placement="top" title="Exportar"><i class="fa-solid fa-file-excel"></i> Exportar</a>

		</div>
		<div class="content-table">
			<table class=" table table-striped  table-hover table-administrator text-left">
				<thead>
					<tr>
						<td>Zona</td>
						<td>Usuarios</td>
						<td>Votos</td>
						<td>Porcentaje</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->zonas as $content) { ?>
						<?php $id =  $content->id; ?>
						<tr>

							<td><?= $content->zona; ?></td>
							<td><?= $content->totalUsuarios; ?></td>
							<td><?= $content->total; ?></td>
							<td><?= number_format($content->porcentaje, 2) . '%'; ?></td>


						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

	</div>
</div>