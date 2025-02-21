<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<table width="400" border="1">

		<thead>
			<tr>
				<!-- <td>Usuario</td> -->
				<!-- <td>Fecha</td> -->
				<td>Zona</td>
				<!-- <td>Tarjeton</td> -->
				<!-- <td>Número certificado electoral</td> -->
				<td>Total Votos</td>

			</tr>
		</thead>
		<tbody>
			<?php $total = 0;?>
			<?php foreach ($this->lists as $content) { ?>
				<?php 
				$id =  $content->id; 
				$total += $content->total_usuarios;
				?>

				<tr>

					<!-- <td><?= $this->list_usuarios[$content->usuario]; ?></td> -->
					<!-- <td><?= $content->fecha; ?></td> -->
					<td><?= $this->list_zona[$content->zona]; ?></td>
					<!-- <td><?= $this->list_tarjeton[$content->tarjeton]; ?></td> -->
					<!-- <td><?= $content->consecutivo; ?></td> -->
					<td><?= $content->total_usuarios ; ?></td>

				</tr>
			<?php } ?>
			<tr >
				<td style="background-color: #e5e5e5;">Total</td>
				<td style="background-color: #e5e5e5;"><?= $total; ?></td>
		</tbody>
	</table>
