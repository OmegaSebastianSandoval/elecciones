<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="/administracion/configvotacion/updatezonas" data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->id; ?>" />
			<?php } ?>
			<div class="row">
				<div class="col-12 text-end mb-3" align="right">
					<a href="/skins/page/files/ejemplozonas.xlsx" class="custom-btn-home me-2">
						<span class="add-button-home lf-part">Descargar archivo de ejemplo</span>
						<span class="rg-part"><i class="fas fa-plus"></i></span>
					</a>
				</div>
				<input type="hidden" name="votacion" value="<?php echo $this->votacion; ?>">
				<div class="col-12 form-group">
					<label for="archivo" class="form-label">Archivo de Zonas</label>
					<input type="file" name="archivo" id="archivo" class="form-control  file-document" data-buttonName="btn-primary" onchange="validardocumento('archivo');" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, .xlsx">
					<div class="help-block with-errors"></div>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>