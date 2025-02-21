<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">

	<div class="content-dashboard">
		<a href="/administracion/resultados/elecciones" class="btn btn-success mb-3 d-flex align-items-center gap-2 w-fit"> <i class="fa-solid fa-arrow-left"></i> Volver</a>
		<div class="content-table p-0 m-0">
			<table class=" table table-striped  table-hover table-administrator text-left">
				<thead>
					<tr>
						<td>Opción</td>
						<td width="200"></td>
					</tr>
				</thead>
				<tbody>


					<tr>
						<td>Resultados Individuales</td>
						<td class="text-right">
							<div>
								<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/ver?votacion=<?= $this->votacion ?>" data-bs-toggle="tooltip" data-placement="top" title="Ver"><i class="fa-solid fa-magnifying-glass"></i></a>

								<a class="btn btn-verde btn-sm d-none" target="_blank" href="<?php echo $this->route; ?>/verexportar?votacion=<?= $this->votacion ?>&excel=1" data-bs-toggle="tooltip" data-placement="top" title="Exportar"><i class="fa-solid fa-file-excel"></i></a>
							</div>
						</td>
					</tr>
					<tr class="d-none">
						<td>Resultado de seguimiento</td>
						<td class="text-right">
							<div>
								<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/resultadozona" data-bs-toggle="tooltip" data-placement="top" title="Ver"><i class="fa-solid fa-magnifying-glass"></i></a>

								<a class="btn btn-verde btn-sm d-none" target="_blank" href="<?php echo $this->route; ?>/resultadozonaexprotar?votacion=<?= $this->votacion ?>&excel=1" data-bs-toggle="tooltip" data-placement="top" title="Exportar"><i class="fa-solid fa-file-excel"></i></a>
							</div>
						</td>
					</tr>
					<tr>
						<td>Resultado final</td>
						<td class="text-right">
							<div>
								<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/resultadofinal?votacion=<?= $this->votacion ?>" data-bs-toggle="tooltip" data-placement="top" title="Ver"><i class="fa-solid fa-magnifying-glass"></i></a>

								<a class="btn btn-verde btn-sm" target="_blank" href="<?php echo $this->route; ?>/resultadofinalimprimir?votacion=<?= $this->votacion ?>&excel=1" data-bs-toggle="tooltip" data-placement="top" title="Exportar"><i class="fa-solid fa-file-excel"></i></a>


								<a class="btn  btn-azul-claro  btn-sm" target="_blank" href="<?php echo $this->route; ?>/resultadofinalimprimir?votacion=<?= $this->votacion ?>&imprimir=1" data-bs-toggle="tooltip" data-placement="top" title="Exportar"><i class="fa-solid fa-print"></i></a>

							</div>
						</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>

</div>