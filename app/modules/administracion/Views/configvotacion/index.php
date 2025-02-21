<style>
  .table>:not(caption)>*>* {
    background-color: unset;
  }
</style>
<h1 class="titulo-principal py-2"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">


  <form action="<?php echo $this->route; ?>" method="post">
    <div class="content-dashboard">
      <div class="row">
        <div class="col-3 mb-3">
          <label class="form-label">Fecha inicio votación</label>
          <label class="input-group">
            <span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
            <input type="text" class="form-control" name="fecha_inicio"
              value="<?php echo $this->getObjectVariable($this->filters, 'fecha_inicio') ?>"></input>
          </label>
        </div>
        <div class="col-3 mb-3">
          <label class="form-label">Fecha Final votación</label>
          <label class="input-group">
            <span class="input-group-text input-icono"><i class="fas fa-pencil-alt"></i></span>
            <input type="text" class="form-control" name="fecha_final"
              value="<?php echo $this->getObjectVariable($this->filters, 'fecha_final') ?>"></input>
          </label>
        </div>
        <div class="col-3">
          <label class="form-label">&nbsp;</label>
          <label class="input-group">
            <button type="submit" class="btn w-100 btn-azul"> <i class="fas fa-filter"></i> Filtrar</button>
          </label>
        </div>
        <div class="col-3">
          <label class="form-label">&nbsp;</label>
          <label class="input-group">
            <a class="btn w-100 btn-azul-claro " href="<?php echo $this->route; ?>?cleanfilter=1"> <i
                class="fas fa-eraser"></i> Limpiar Filtro</a>
          </label>
        </div>
      </div>
    </div>
  </form>
  <div align="center">
    <ul class="pagination justify-content-center">
      <?php
      $min = $this->page - 10;
      $max = $this->page + 10;

      if ($this->totalpages > 1) {
        if ($this->page != 1) {
          echo '<li class="page-item" ><a class="page-link"  href="' . $url . '?page=' . ($this->page - 1) . '">&laquo; Anterior </a></li>';
        }
        for ($i = 1; $i <= $this->totalpages; $i++) {
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

  <?php if ($this->errors) { ?>
    <div class="alert alert-danger" role="alert">
      <ul>
        <?php foreach ($this->errors as $error) { ?>
          <li><?php echo $error; ?></li>
        <?php } ?>
      </ul>
    </div>
  <?php } ?>

  <?php if ($this->errors_warning) { ?>
    <div class="alert alert-warning" role="alert">
      <ul>
        <?php foreach ($this->errors_warning as $error) { ?>
          <li><?php echo $error; ?></li>
        <?php } ?>
      </ul>
    </div>

  <?php } ?>

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
        <div class="col-4 text-end">
          <a class="btn btn-sm btn-success" href="<?php echo $this->route . "\manage"; ?><?php if ($this->padre) {
                                                                                            echo "?padre=" . $this->padre;
                                                                                          } ?>">
            <i class="fas fa-plus-square"></i> Crear Nuevo
          </a>
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
                <div>
                  <a class="btn btn-rosado btn-sm my-1" href="/administracion/tarjetones/index/?eleccion=<?= $id ?>" data-bs-toggle="tooltip" data-placement="top" title="Tarjetones">
                    Crear/Ver Tarjetones
                    <!-- <i class="fa-regular fa-address-card"></i> -->
                  </a>
                  <a class="btn btn-verde btn-sm my-1" href="<?php echo $this->route; ?>/editarzonas?id=<?= $id ?>" data-bs-toggle="tooltip" data-placement="top" title="Archivo de Usuarios Elecciones">
                    Importar Zonas
                    <!-- <i class="fa-solid fa-user-group"></i> -->
                  </a>


                  <a class="btn btn-verde btn-sm my-1" href="<?php echo $this->route; ?>/editarusuarios?id=<?= $id ?>" data-bs-toggle="tooltip" data-placement="top" title="Archivo de Usuarios Elecciones">
                    Importar Usuarios
                    <!-- <i class="fa-solid fa-user-group"></i> -->
                  </a>
                  <a class="btn btn-azul btn-sm my-1" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>" data-bs-toggle="tooltip" data-placement="top" title="Editar">
                    Editar Votación
                    <!-- <i class="fas fa-pen-alt"></i> -->
                  </a>

                  <span data-bs-toggle="tooltip" data-placement="top" title="Eliminar"><a class="btn btn-rojo btn-sm my-1" data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>"><i class="fas fa-trash-alt"></i></a></span>
                </div>
                <!-- Modal -->
                <div class="modal fade text-left" id="modal<?= $id ?>" tabindex="-1" role="dialog"
                  aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="">¿Esta seguro de eliminar este registro?</div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger"
                          href="<?php echo $this->route; ?>/delete?id=<?= $id ?>&csrf=<?= $this->csrf; ?><?php echo ''; ?>">Eliminar</a>
                      </div>
                    </div>
                  </div>
                </div>
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