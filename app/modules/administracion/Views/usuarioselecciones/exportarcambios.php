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



<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>C&eacute;dula</th>
			<th>Zona anterior</th>
			<th>Zona nueva</th>
			<th>Fecha</th>
			<th>Usuario</th>

		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->cambios as $log) { ?>

			<tr>
				<td><?php echo $log->id ?></td>
				<td><?php echo $log->cedula ?></td>
				<td><?php echo $this->list_zona[$log->valor_anterior] ?></td>
				<td><?php echo $this->list_zona[$log->valor_nuevo] ?></td>
				<td><?php echo $log->fecha ?></td>
				<td><?php echo $this->list_usuarios[$log->quien] ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>