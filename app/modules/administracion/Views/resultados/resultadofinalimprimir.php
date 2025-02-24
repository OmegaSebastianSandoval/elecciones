<style>
	* {
		font-size: 15px;
		font-family: Arial, sans-serif;
	}

	table {
		border-collapse: collapse;
		width: 100%;
		max-width: 700px;
		margin: auto;
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

	.signature-section {
		margin: auto;

		width: 100%;
		margin-top: 40px;
	}

	p {
		text-align: center;
	}

	h1 {

    line-height: 1em;
    font-weight: 500;
    color: #88a231 !important;
		font-size: 23px;
		text-align : center;
		margin: 0;
	}

	strong {

    line-height: 1em;
    font-weight: 500;
    color: #88a231 !important;
		font-size: 25px;
	}
	.tr-gris{
		background-color:#D4D4D4
	}
</style>
<table align="center"  style="background-color:#f2f2f2">
	<thead>
		<tr>
			<td colspan="3" align="center">
				<h1><?= $this->votacionInfo->votacion_titulo?> <br>
					<strong>Resultados</strong>
				</h1>
			</td>
		</tr>
	</thead>
</table>
<?php foreach ($this->resultados as $tarjetonId => $resultado) { ?>
	<table border="0" style="background-color:#f2f2f2">
		<thead>
			<tr>
				<?php if ($resultado['tarjeton']->tarjeton_zona == 1) { ?>
					<td colspan="3"><?= $resultado['tarjeton']->tarjeton_nombre ?></td>
				<?php } else { ?>
					<td><?= $resultado['tarjeton']->tarjeton_nombre ?></td>
					<td>Votos</td>
				<?php } ?>
			</tr>
			<?php if ($resultado['tarjeton']->tarjeton_zona == 1) { ?>

				<tr>
					<td>Zona</td>
					<td>Votos</td>
					<td>Porcentaje</td>
				</tr>
			<?php } ?>

		</thead>
		<tbody>
			<?php foreach ($resultado['zonas'] as $zona) { ?>
				<tr class="tr-gris" bgcolor="gray" style="background-color:#D4D4D4 !important">
					<?php if ($resultado['tarjeton']->tarjeton_zona == 1) { ?>
						<td><?= $zona['zona']->zona ?></td>
					<?php } else { ?>
						<td></td>
					<?php } ?>

					<?php if ($resultado['tarjeton']->tarjeton_zona == 1) { ?>
						<td><?php echo ($zona['votosRegistrados']) ?> \ <?php echo $zona['votosPosibles'] ?></td>

					<?php } else { ?>
						<td><?= $zona['votosRegistrados'] ?></td>
					<?php } ?>

					<?php if ($resultado['tarjeton']->tarjeton_zona == 1) { ?>
						<td><?= number_format($zona['promedioZona'], 2) ?> % </td>
					<?php } ?>
				</tr>
				<?php foreach ($zona['resultados'] as $resultadoZona) { ?>
					<tr>
						<td><?= $resultadoZona->nombre_candidato ?></td>
						<td><?= $resultadoZona->total_votos ?></td>
						<?php if ($resultado['tarjeton']->tarjeton_zona == 1) { ?>
							<td><?= number_format($resultadoZona->porcentaje_votos, 2) ?> % </td>
						<?php } ?>
					</tr>
				<?php } ?>
			<?php } ?>
		</tbody>
	</table>
<?php } ?>

<!-- Sección de Firma -->
<div class="signature-section ">
	<p>Este informe se gener&oacute; el <?= date('Y-m-d H:i:s') ?>. Firma: ____________________________</p>
</div>
<?php if ($this->imprimir == 1) { ?>
	<script type="text/javascript">
		window.print();
	</script>
<?php } ?>