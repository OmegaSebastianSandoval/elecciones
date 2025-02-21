<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
				<td>Usuario</td>
				<td>Fecha</td>
				<td>Zona</td>
				<td>Tarjeton</td>
				<td>Número certificado electoral</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($this->lists as $content) { ?>
				<?php $id =  $content->id; ?>
				<tr>

					<td><?= $this->list_usuarios[$content->usuario]; ?></td>
					<td><?= $content->fecha; ?></td>
					<td><?= $this->list_zona[$content->zona]; ?></td>
					<td><?= $this->list_tarjeton[$content->tarjeton]; ?></td>
					<td><?= $content->consecutivo; ?></td>

				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>