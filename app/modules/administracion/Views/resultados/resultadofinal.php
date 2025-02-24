<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">

	<div class="content-dashboard ">

		<div class="d-flex justify-content-end gap-4 pe-3">
			<div class="text-end" align="right">
				<a  target="_blank" href="<?php echo $this->route; ?>/resultadofinalimprimir?excel=1&votacion=<?= $this->votacion?>" data-bs-toggle="tooltip" data-placement="top" title="Exportar" class="custom-btn-home me-2">
					<span class="add-button-home lf-part">Exportar</span>
					<span class="rg-part"><i class="fas fa-plus"></i></span>
				</a>
			</div>

			<div class="text-end" align="right">
				<a  target="_blank" href="<?php echo $this->route; ?>/resultadofinalimprimir?imprimir=1&votacion=<?= $this->votacion?>" data-bs-toggle="tooltip" data-placement="top" title="Exportar" class="custom-btn-home me-2">
					<span class="add-button-home lf-part">Imprimir</span>
					<span class="rg-part"><i class="fas fa-plus"></i></span>
				</a>
			</div>

		</div>

		<div class="content-table">

			<?php foreach ($this->resultados as $tarjetonId => $resultado) { ?>
				<table class="table table-administrator mb-3">
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
							<tr bgcolor="#D4D4D4">
								<?php if ($resultado['tarjeton']->tarjeton_zona == 1) { ?>
									<td><?= $zona['zona']->zona ?></td>
								<?php } else { ?>
									<td></td>

								<?php } ?>


								<?php if ($resultado['tarjeton']->tarjeton_zona == 1) { ?>

									<td><?= ($zona['votosRegistrados']) . " / " . $zona['votosPosibles'] ?></td>
								<?php } else { ?>
									<td><?= $zona['votosRegistrados'] ?></td>
								<?php } ?>


								<?php if ($resultado['tarjeton']->tarjeton_zona == 1) { ?>
									<td><?= number_format($zona['promedioZona'], 2) ?> % </td>
								<?php } ?>
							</tr>
							<?php foreach ($zona['resultados'] as $resultadoZona) { ?>
								<tr>
									<td>
										<?= $resultadoZona->nombre_candidato ?>
									</td>
									<td>
										<?= $resultadoZona->total_votos ?>
									</td>
									<?php if ($resultado['tarjeton']->tarjeton_zona == 1) { ?>

										<td>
											<?= number_format($resultadoZona->porcentaje_votos, 2) ?> %
										</td>
									<?php } ?>

								</tr>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
			<?php } ?>
		</div>

	</div>
</div>
<style>
	.table>:not(caption)>*>*{
		background-color: inherit;
	}
</style>