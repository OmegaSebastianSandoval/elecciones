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



<div class="content-table">
	<table class=" table table-striped  table-hover table-administrator text-left">
		<thead>
			<tr>
				<td>Cedula</td>
				<td>Nombre</td>
				<td>Clave</td>
				<td>Correo</td>
				<td>Activo</td>
				<td>Ya vot&oacute;?</td>


			</tr>
		</thead>
		<tbody>
			<?php foreach ($this->lists as $content) { ?>

				<tr>
					<td><?= $content["cedula"]; ?></td>
					<td><?= $content["nombre"]; ?></td>
					<td><?= $content["clave"]; ?></td>
					<td><?= $content["correo"]; ?></td>
					<td><?= $content["activo"] ==1 ? 'Si' : 'NO'; ?></td>
					<td><?= $content["estado"] ==1 ? 'Si' : 'NO'; ?></td>

				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>