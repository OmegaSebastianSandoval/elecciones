<style>
  .table>:not(caption)>*>* {
    background-color: unset;
  }
</style>
<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">




  <div class="content-dashboard">
    <div class="franja-paginas">
      <div class="row align-items-center">
        <div class="col-4">
          <div class="titulo-registro">Se encontraron <?php echo $this->register_number; ?> Registros</div>
        </div>
        <div class="col-4 d-flex align-items-center justify-content-end text-end">
          <div class="texto-paginas me-2">Registros por página:</div>
          <select class="form-select form-select-sm selectpagination" style="width: auto;">
            <option value="20" <?php if ($this->pages == 20) {
                                  echo 'selected';
                                } ?>>20</option>
            <option value="30" <?php if ($this->pages == 30) {
                                  echo 'selected';
                                } ?>>30</option>
            <option value="50" <?php if ($this->pages == 50) {
                                  echo 'selected';
                                } ?>>50</option>
            <option value="100" <?php if ($this->pages == 100) {
                                  echo 'selected';
                                } ?>>100</option>
          </select>
        </div>

      </div>
    </div>

    <?php if ($this->votacion_actual_error) { ?>
      <div class="alert alert-<?= $this->votacion_actual_tipo ?> m-3" role="alert">
        <?php echo $this->votacion_actual_error ?>
      </div>
    <?php } ?>
    <div class="content-table">
      <table class=" table table-striped  table-hover table-administrator text-left">
        <thead>
          <tr>
            <td>Votaci&oacute;n titulo</td>
            <td>Votaci&oacute;n Actual</td>
            <td>Fecha inicio votaci&oacute;n</td>
            <td>Fecha Final votaci&oacute;n</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($this->lists as $content) { ?>
            <?php $id =  $content->id; ?>
            <tr style="background-color: <?= $content->votacion_actual == 1 ? '#c2ffb3 !important' : ''; ?>">

              <td><?= $content->votacion_titulo; ?></td>
              <td><?= $content->votacion_actual == 1 ? 'SI' : 'NO'; ?></td>
              <td><?= $content->fecha_inicio; ?></td>
              <td><?= $content->fecha_final; ?></td>
              <td class=" d-flex text-right">
                <a class="btn btn-azul btn-sm my-1" href="<?php echo $this->route; ?>?votacion=<?= $id ?>&page=1" data-bs-toggle="tooltip" data-placement="top" title="Editar">
                  Ver Zonas
                  <!-- <i class="fas fa-pen-alt"></i> -->
                </a>

              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <input type="hidden" id="csrf" value="<?php echo $this->csrf ?>"><input type="hidden" id="page-route"
      value="<?php echo $this->route; ?>/changepage">
  </div>
  <div align="center">
    <ul class="pagination justify-content-center">
      <?php

      $min = $this->page - 10;
      $max = $this->page + 10;

      if ($this->totalpages > 1) {
        if ($this->page != 1) {
          echo '<li class="page-item" ><a class="page-link"  href="' . $url . '?page=' . ($this->page - 1) . '">&laquo; Anterior </a></li>';
        }
        for ($i = 1; $i <= $bs - $this->totalpages; $i++) {
          if ($this->page == $i) {
            echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
          } else {
            if ($i >= $min and $i <= $max) {
              echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>';
            }
          }
        }
        if ($this->page != $this->totalpages) {
          echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
        }
      }
      ?>
    </ul>
  </div>
</div>