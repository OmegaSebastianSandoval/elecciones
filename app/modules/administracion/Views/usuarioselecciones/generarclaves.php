<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid mt-4">
<?php if ($this->votacion) { ?>
			<a href="/administracion/usuarioselecciones/eleccionesgenerar?page=1" class="btn btn-success mb-3 d-flex align-items-center gap-2 w-fit"> <i class="fa-solid fa-arrow-left"></i> Volver</a>
		<?php } ?>
	<form action="/administracion/usuarioselecciones/generar" method="post" id="generarClaves">
		<input type="hidden" name="votacion" value="<?php echo $this->votacion; ?>">
		<div class="content-dashboard m-0">
			<div class="alert alert-danger text-center" role="alert">
				<strong>¿Desea generar claves para todos los votantes?</strong>
				<br>
				(Las nuevas claves reemplazaran las actuales)
			</div>

			<div class="d-flex justify-content-center gap-4">
				<?php if (!$this->mostrar) { ?>
					<button type="submit" id="btn-submit" class="btn btn-danger">Generar</button>
				<?php } else { ?>
					<a href="/administracion/usuarioselecciones/exportarclaves?excel=1" target="_blank" class="btn btn-success ">Descargar Excel</a>
				<?php } ?>
			</div>
		</div>

	</form>


</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		document.getElementById('generarClaves').addEventListener('submit', function(e) {
			e.preventDefault();
			if (confirm('¿Desea generar claves para todos los votantes?')) {
				this.submit();
				document.getElementById('btn-submit').disabled = true;
			}
		});
	});
</script>