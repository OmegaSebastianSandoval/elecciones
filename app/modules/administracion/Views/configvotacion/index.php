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
          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalVotacion" data-bs-tooltip="tooltip" data-placement="top" title="Crear Nuevo" id="btn-crear">
            <i class="fas fa-plus-square"></i> Crear Nuevo
          </button>
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

                  <span class="btn btn-verde btn-zonas btn-sm my-1" data-bs-tooltip="tooltip" data-votacion="<?php echo $id ?>" data-placement="top" title="Archivo de Zonas Elecciones" data-bs-toggle="modal" data-bs-target="#modalZona">
                    Importar Zonas
                    <!-- <i class="fa-solid fa-user-group"></i> -->
                  </span>


                  <a class="btn btn-rosado btn-sm my-1" href="/administracion/tarjetones/index/?eleccion=<?= $id ?>" data-bs-toggle="tooltip" data-placement="top" title="Tarjetones">
                    Crear/Ver Tarjetones
                    <!-- <i class="fa-regular fa-address-card"></i> -->
                  </a>

                  <a class="btn btn-verde btn-sm my-1" href="<?php echo $this->route; ?>/editarusuarios?id=<?= $id ?>" data-bs-toggle="tooltip" data-placement="top" title="Archivo de Usuarios Elecciones">
                    Importar Usuarios
                    <!-- <i class="fa-solid fa-user-group"></i> -->
                  </a>
                  <span class="btn btn-azul btn-sm my-1 btn-editar" data-votacion='{"id":"<?= $content->id ?>", "votacion_titulo":"<?= $content->votacion_titulo ?>", "fecha_inicio":"<?= $content->fecha_inicio ?>", "fecha_final":"<?= $content->fecha_final ?>", "votacion_actual":"<?= $content->votacion_actual ?>", "votacion_mostrar_campo":"<?= $content->votacion_mostrar_campo ?>", "votacion_texto_campo":"<?= $content->votacion_texto_campo ?>"}' data-bs-toggle="tooltip" data-placement="top" title="Editar">
                    Editar Votación
                  </span>

                  <span data-bs-toggle="tooltip" data-placement="top" title="Eliminar"><a class="btn btn-rojo btn-sm my-1" data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>">
                      Borrar votación
                      <!-- <i class="fas fa-trash-alt"></i> -->
                    </a></span>
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

<div class="modal fade" id="modalVotacion" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="text-left" enctype="multipart/form-data" method="post" action="/administracion/configvotacion/insert" data-bs-toggle="validator" id="form-votacion">
        <div class="modal-body">
          <div class="row px-1">
            <div class="col-lg-12">
              <div class="caja_azul">
                <div class="d-flex justify-content-between align-items-center h-100">
                  <div class="titulo_dashboard d-flex align-items-center">
                    <span class="d-flex align-items-center gap-2" id="modalTitle">
                      <i class="fa-solid fa-building icon-dash"></i> Crear nuevo cliente
                    </span>

                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                    </>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 mt-3 mb-3">
              <span class="detail-modal">Por favor ingrese los datos de la votacion.</span>
            </div>
            <input type="hidden" name="id" id="votacionId">
            <div class="col-12 mb-3">

              <label class="input-group">

                <input type="text" placeholder="Título" name="votacion_titulo" id="votacion_titulo" class="form-control"  required>
              </label>
              <div class="help-block with-errors"></div>
            </div>

            <div class="col-12 mb-3">
              <label for="fecha_inicio" class="form-label">Fecha inicio votación</label>
              <label class="input-group">

                <input type="datetime-local"  name="fecha_inicio" id="fecha_inicio" class="form-control" required onchange="validarFechas()" min="<?= date('Y-m-d\TH:i'); ?>">
              </label>

            </div>
            <div class="col-12 mb-3">
              <label for="fecha_final" class="form-label">Fecha Final votación</label>
              <label class="input-group">

                <input type="datetime-local"  name="fecha_final" id="fecha_final" class="form-control" required onchange="validarFechas()" min="<?= date('Y-m-d\TH:i'); ?>">
              </label>
            </div>

            <div class="col-6 mb-3">

              <input type="checkbox" name="votacion_actual" value="1" class="form-control switch-form" id="votacion_actual"></input>
              <br>
              <label class="form-label">Votación actual</label>
            </div>

            <div class="col-6 mb-3">

              <input type="checkbox" name="votacion_mostrar_campo" value="1" class="form-control switch-form" id="votacion_mostrar_campo" ></input>
              <br>
              <label class="form-label">Mostrar campo comentario</label>
            </div>
            <div class="col-12 mb-3">

              <div class="form-floating">
                <textarea name="votacion_texto_campo" id="votacion_texto_campo" placeholder="Comentarios" class="form-control"><?= $this->content->votacion_texto_campo ? $this->content->votacion_texto_campo : null; ?></textarea>
                <label for="floatingTextarea">Comentarios</label>
              </div>

            </div>



            <input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
            <input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">

            <div class="col-lg-12 text-center mt-3">
              <div class="btn-modal-footer d-grid gap-2">
                <button type="submit" class="btn btn-guardar w-100" type="submit">Guardar</button>

                <button type="button" class="btn btn-cancelar w-100" data-bs-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modalVotacion = new bootstrap.Modal(document.getElementById('modalVotacion'));
    const modalTitle = document.getElementById('modalTitle');
    const votacionId = document.getElementById('votacionId');
    const votacionTitulo = document.getElementById('votacion_titulo');
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFinal = document.getElementById('fecha_final');
    const votacionActual = document.getElementById('votacion_actual');
    console.log(votacionActual);
    const votacionMostrarCampo = document.getElementById('votacion_mostrar_campo');
    const votacionTextoCampo = document.getElementById('votacion_texto_campo');
    const formVotacion = document.getElementById('form-votacion');
    // Función para cargar datos en el modal
    function cargarDatosEnModal(data) {
      console.log(data);
      formVotacion.action = '/administracion/configvotacion/update';
      modalTitle.textContent = 'Editar votación';
      votacionId.value = data.id;
      votacionTitulo.value = data.votacion_titulo;
      fechaInicio.value = data.fecha_inicio;
      fechaFinal.value = data.fecha_final;
      votacionActual.checked = data.votacion_actual == 1;
      votacionMostrarCampo.checked = data.votacion_mostrar_campo == 1;
      votacionTextoCampo.value = data.votacion_texto_campo;


      data.votacion_mostrar_campo == 1 ? votacionMostrarCampo.setAttribute('checked', 'checked') : votacionMostrarCampo.removeAttribute('checked');
      data.votacion_actual == 1 ? votacionActual.setAttribute('checked', 'checked') : votacionMostrarCampo.removeAttribute('checked');
      // Actualizar los toggles usando Bootstrap Toggle
      if (data.votacion_actual == 1) {
        $(votacionActual).bootstrapToggle('on'); // Activar el toggle
      } else {
        $(votacionActual).bootstrapToggle('off'); // Desactivar el toggle
      }

      if (data.votacion_mostrar_campo == 1) {
        $(votacionMostrarCampo).bootstrapToggle('on'); // Activar el toggle
      } else {
        $(votacionMostrarCampo).bootstrapToggle('off'); // Desactivar el toggle
      }
      modalVotacion.show();
    }

    // Evento para abrir el modal de edición
    document.querySelectorAll('.btn-editar').forEach(button => {
      button.addEventListener('click', function() {
        const data = JSON.parse(this.getAttribute('data-votacion'));
        cargarDatosEnModal(data);
      });
    });

    // Evento para abrir el modal de creación
    document.getElementById('btn-crear').addEventListener('click', function() {
      formVotacion.action = '/administracion/configvotacion/insert';
      modalTitle.textContent = 'Crear nueva votación';
      votacionId.value = '';
      votacionTitulo.value = '';
      fechaInicio.value = '';
      fechaFinal.value = '';
      votacionActual.checked = false;
      votacionMostrarCampo.checked = false;
      votacionTextoCampo.value = '';
      modalVotacion.show();
    });
  });
</script>
<script>
  function validarFechas() {
    var fechaInicio = document.getElementById('fecha_inicio').value;
    var fechaFin = document.getElementById('fecha_final').value;

    if (fechaInicio && fechaFin) {
      var inicio = new Date(fechaInicio);
      var fin = new Date(fechaFin);

      // Validar que la fecha de inicio no sea mayor que la fecha de fin
      if (inicio > fin) {
        // alert('La fecha de inicio no puede ser mayor que la fecha de fin.');
        swal.fire({
          title: 'Error',
          text: 'La fecha de inicio no puede ser mayor que la fecha de fin.',
          icon: 'error',
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#1C405A'
        })
        document.getElementById('fecha_inicio').value = '';
        document.getElementById('fecha_final').value = '';
        return;
      }

      // Validar que la fecha de fin no sea menor que la fecha de inicio
      if (fin < inicio) {
        // alert('La fecha de fin no puede ser menor que la fecha de inicio.');
        swal.fire({
          title: 'Error',
          text: 'La fecha de fin no puede ser menor que la fecha de inicio.',
          icon: 'error',
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#1C405A'
        })
        document.getElementById('fecha_inicio').value = '';
        document.getElementById('fecha_final').value = '';
        return;
      }

      // Establecer el valor mínimo de la fecha final como la fecha de inicio
      document.getElementById('fecha_final').min = fechaInicio;

      // Establecer el valor máximo de la fecha de inicio como la fecha de fin
      document.getElementById('fecha_inicio').max = fechaFin;
    }
  }
</script>
<script>
  const myModal = new bootstrap.Modal('#modalCrear', {
    show: true
  })

  // myModal.show()
</script>









<div class="modal fade" id="modalZona" tabindex="-1" aria-labelledby="modalZonaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalZonaLabel">Importar Zonas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="text-left" enctype="multipart/form-data" method="post" action="/administracion/configvotacion/updatezonas" data-bs-toggle="validator">
          <input type="hidden" name="votacion" id="votacion-zona">
          <input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
          <input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
          <?php if ($this->content->id) { ?>
            <input type="hidden" name="id" id="id" value="<?= $this->content->id; ?>" />
          <?php } ?>
          <div class="row">
            <div class="col-12  text-end mb-3" align="right">
              <a href="/skins/page/files/zonasejemplo.xlsx" class="custom-btn-home me-2">
                <span class="add-button-home lf-part">Descargar archivo de ejemplo</span>
                <span class="rg-part"><i class="fas fa-plus"></i></span>
              </a>
            </div>
            <input type="hidden" name="votacion" value="<?php echo $this->votacion; ?>">
            <div class="col-12 form-group">
              <label for="archivo" class="form-label">Archivo de Zonas</label>
              <input type="file" name="archivo" id="archivo" class="form-control  file-document" data-buttonName="btn-primary" onchange="validardocumento('archivo');" accept=" application/vnd.ms-excel, .xlsx">
              <div class="help-block with-errors"></div>
            </div>

            <div class="col-12 ">
              <label for="archivo" class="form-label">&nbsp;</label>
              <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-guardar" type="submit">Guardar</button>

              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>