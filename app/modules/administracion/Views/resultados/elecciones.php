<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">

	<div class="content-dashboard">

		<div class="content-table">
			<table class=" table table-striped  table-hover table-administrator text-left">
				<thead>
					<tr>
						<td>Elección</td>
						<td>Fecha Inicio</td>
						<td>Fecha Fin</td>
						<td>Actual Votación</td>

						<td width="200"></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->lists as $content) { ?>
						<?php $id =  $content->id; ?>
						<tr>

							<td><?= $content->votacion_titulo; ?></td>
							<td><?= $content->fecha_inicio; ?></td>
							<td><?= $content->fecha_final; ?></td>
							<td><?= $content->votacion_actual == 1 ? 'SI' : 'NO'; ?></td>
							
							<td class="text-right">
								<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>?votacion=<?=$id?>" data-bs-toggle="tooltip" data-placement="top" title="Ver"><i class="fa-solid fa-magnifying-glass"></i></a>
							</td>



						</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>
	</div>

</div>