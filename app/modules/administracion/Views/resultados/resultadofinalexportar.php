<style>
	table {
		border-collapse: collapse;
		width: 100%;
	}

	th,
	td {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	th {
		background-color: #f2f2f2;
	}
</style>

<div class="content-dashboard">

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