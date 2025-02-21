<div class="container">

	<br>
	<h1>Configuración de votación</h1>
	<br>
	<div class="alert alert-warning text-center" role="alert">
		Campo iniciar: <strong><?php echo $this->campoinicial; ?></strong>
	</div>

</div>
<script type="text/javascript">
	window.location.href = "<?php echo $this->rute; ?>&votacion=<?php echo $this->votacion; ?>";
</script>