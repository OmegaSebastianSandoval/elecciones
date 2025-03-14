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

            <input type="text" class="form-control" name="fecha_inicio"
              value="<?php echo $this->getObjectVariable($this->filters, 'fecha_inicio') ?>"></input>
          </label>
        </div>
        <div class="col-3 mb-3">
          <label class="form-label">Fecha Final votación</label>
          <label class="input-group">

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
                <div class="w-100 d-flex align-items-center justify-content-end gap-1">

                  <div class="dropdown">
                    <button class="btn btn-verde btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Zonas
                    </button>

                    <ul class="dropdown-menu dropdown-verde">
                      <li>
                        <a
                          class="dropdown-item"
                          href="/administracion/zonas?votacion=<?php echo $id ?>&origin=home">Ver Zonas

                        </a>
                      </li>
                      <li>
                        <a
                          href="#"
                          class="btn-zonas dropdown-item"
                          data-votacion="<?php echo $id ?>"
                          title="Archivo de Zonas Elecciones"
                          data-bs-toggle="modal" data-bs-target="#modalZona">
                          Importar Zonas
                        </a>
                      </li>
                    </ul>
                  </div>




                  <!-- <a class="btn btn-rosado btn-sm my-1" href="/administracion/tarjetones/index/?eleccion=<?= $id ?>" data-bs-toggle="tooltip" data-placement="top" title="Tarjetones">
                    Crear/Ver Tarjetones
                
                  </a>-->


                  <div class="dropdown">
                    <button class="btn btn-rosado btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Tarjetones
                    </button>

                    <ul class="dropdown-menu dropdown-rosado">
                      <li>
                        <a
                          class="dropdown-item"
                          href="/administracion/tarjetones/index/?eleccion=<?= $id ?>=<?php echo $id ?>&origin=home">Ver Tarjetones

                        </a>
                      </li>
                      <li>
                        <a
                          href="#"
                          class="btn-tarjetones dropdown-item"
                          data-votacion="<?php echo $id ?>"
                          data-bs-toggle="modal" data-bs-target="#modalTarjeton">
                          Crear Tarjetón
                        </a>
                      </li>
                    </ul>
                  </div>




                  <div class="dropdown">
                    <button class="btn btn-verde btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Usuarios
                    </button>

                    <ul class="dropdown-menu dropdown-verde">
                      <li>
                        <a
                          class="dropdown-item"
                          href="/administracion/usuarioselecciones?votacion=<?php echo $id ?>&origin=home">Ver Usuarios

                        </a>
                      </li>
                      <li>
                        <a
                          href="#"
                          class="btn-zonas dropdown-item"
                          data-votacion="<?php echo $id ?>"
                          title="Archivo de Zonas Elecciones"
                          data-bs-toggle="modal" data-bs-target="#modalUsuarios">
                          Importar Usuarios
                        </a>
                      </li>
                    </ul>
                  </div>


                  <span class="btn btn-azul btn-sm my-1 btn-editar" data-votacion='{"id":"<?= $content->id ?>", "votacion_titulo":"<?= $content->votacion_titulo ?>", "fecha_inicio":"<?= $content->fecha_inicio ?>", "fecha_final":"<?= $content->fecha_final ?>", "votacion_actual":"<?= $content->votacion_actual ?>", "votacion_mostrar_campo":"<?= $content->votacion_mostrar_campo ?>", "votacion_texto_campo":"<?= $content->votacion_texto_campo ?>"}' data-bs-toggle="tooltip" data-placement="top" title="Editar">
                    <i class="fa-solid fa-pencil"></i>
                  </span>

                  <span data-bs-tooltip="tooltip" data-placement="top" title="Eliminar"><a class="btn btn-rojo btn-sm my-1" data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>">
                      <i class="fa-solid fa-trash"></i>
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
                    <div class="d-flex align-items-center gap-2">
                      <i class="fa-solid fa-check-to-slot"></i> <span id="modalTitle">Crear nueva votación</span>
                    </div>

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

                <input type="text" placeholder="Título" name="votacion_titulo" id="votacion_titulo" class="form-control" required>
              </label>

            </div>

            <div class="col-12 mb-3">
              <label for="fecha_inicio" class="form-label">Fecha inicio votación</label>
              <label class="input-group">

                <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" class="form-control" required onchange="validarFechas()">
              </label>

            </div>
            <div class="col-12 mb-3">
              <label for="fecha_final" class="form-label">Fecha Final votación</label>
              <label class="input-group">

                <input type="datetime-local" name="fecha_final" id="fecha_final" class="form-control" required onchange="validarFechas()">
              </label>
            </div>

            <div class="col-6 mb-3 d-flex flex-column justify-content-center align-items-center gap-1">
              <label class="form-label m-0">Votación actual</label>

              <input type="checkbox" name="votacion_actual" value="1" class="form-control switch-form" id="votacion_actual"></input>

            </div>

            <div class="col-6 mb-3 d-flex flex-column justify-content-center align-items-center gap-1">
              <label class="form-label m-0">Mostrar campo comentario</label>

              <input type="checkbox" name="votacion_mostrar_campo" value="1" class="form-control switch-form" id="votacion_mostrar_campo"></input>

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
    const votacionMostrarCampo = document.getElementById('votacion_mostrar_campo');
    const votacionTextoCampo = document.getElementById('votacion_texto_campo');
    const formVotacion = document.getElementById('form-votacion');

    // Función para limpiar los campos del modal
    function limpiarCamposModal() {
      votacionId.value = '';
      votacionTitulo.value = '';
      fechaInicio.value = '';
      fechaFinal.value = '';
      votacionActual.checked = false;
      votacionMostrarCampo.checked = false;
      votacionTextoCampo.value = '';
      $(votacionActual).bootstrapToggle('off');
      $(votacionMostrarCampo).bootstrapToggle('off');

      // Restablecer el atributo "min" si es necesario
      fechaInicio.removeAttribute('min');
      fechaFinal.removeAttribute('min');
    }
    // Limpiar campos cuando el modal se cierre
    const myModalEl = document.getElementById('modalVotacion')
    myModalEl.addEventListener('hidden.bs.modal', event => {
      limpiarCamposModal();
    });
    // Función para cargar datos en el modal
    function cargarDatosEnModal(data) {
      formVotacion.action = '/administracion/configvotacion/update';
      modalTitle.textContent = 'Editar votación';
      votacionId.value = data.id;
      votacionTitulo.value = data.votacion_titulo;
      fechaInicio.value = data.fecha_inicio;
      fechaFinal.value = data.fecha_final;
      votacionActual.checked = data.votacion_actual == 1;
      votacionMostrarCampo.checked = data.votacion_mostrar_campo == 1;
      votacionTextoCampo.value = data.votacion_texto_campo;

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
      // Eliminar el atributo "min" al editar
      fechaInicio.removeAttribute('min');
      fechaFinal.removeAttribute('min');

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

      // Establecer el atributo "min" solo al crear
      fechaInicio.setAttribute('min', new Date().toISOString().slice(0, 16));
      fechaFinal.setAttribute('min', new Date().toISOString().slice(0, 16));

      modalVotacion.show();
    });
  });
</script>
<script>
  function validarFechas() {
    const votacionId = document.getElementById('votacionId').value;

    // Solo validar fechas si estamos creando una nueva votación
    if (!votacionId) {
      const fechaInicioInput = document.getElementById('fecha_inicio'); // Elemento del DOM
      const fechaFinInput = document.getElementById('fecha_final'); // Elemento del DOM

      const fechaInicio = fechaInicioInput.value; // Valor del campo
      const fechaFin = fechaFinInput.value; // Valor del campo

      // Establecer el valor mínimo de la fecha final como la fecha de inicio
      if (fechaInicio) {
        fechaFinInput.setAttribute('min', fechaInicio);
      }
      if (fechaFin) {
        fechaInicioInput.setAttribute('max', fechaFin);
      }

      if (fechaInicio && fechaFin) {
        const inicio = new Date(fechaInicio);
        const fin = new Date(fechaFin);

        // Validar que la fecha de inicio no sea mayor que la fecha de fin
        if (inicio > fin) {
          swal.fire({
            title: 'Error',
            text: 'La fecha de inicio no puede ser mayor que la fecha de fin.',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#1C405A'
          });
          fechaInicioInput.value = ""; // Limpiar el campo
          fechaFinInput.value = ''; // Limpiar el campo
          return;
        }

        // Validar que la fecha de fin no sea menor que la fecha de inicio
        if (fin < inicio) {
          swal.fire({
            title: 'Error',
            text: 'La fecha de fin no puede ser menor que la fecha de inicio.',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#1C405A'
          });
          fechaInicioInput.value = ''; // Limpiar el campo
          fechaFinInput.value = ''; // Limpiar el campo
          return;
        }
      }
    }
  }
</script>









<div class="modal fade" id="modalZona" tabindex="-1" aria-labelledby="modalZonaLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-body">
        <form class="text-left" enctype="multipart/form-data" method="post" action="/administracion/configvotacion/updatezonas" id="form-zona" data-bs-toggle="validator">
          <input type="hidden" name="votacion" id="votacion-zona">
          <input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
          <input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
          <?php if ($this->content->id) { ?>
            <input type="hidden" name="id" id="id" value="<?= $this->content->id; ?>" />
          <?php } ?>
          <div class="row px-1">

            <div class="col-lg-12">
              <div class="caja_azul">
                <div class="d-flex justify-content-between align-items-center h-100">
                  <div class="titulo_dashboard d-flex align-items-center">
                    <div class="d-flex align-items-center gap-2">
                      <i class="fa-solid fa-location-dot"></i> <span id="modalTitleZona">Importar Zonas</span>
                    </div>

                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                    </>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12  text-end my-3">
              <a href="/skins/page/files/zonasejemplo.xlsx" target="_blank"
                class="custom-btn-home">
                <span class="add-button-home lf-part">Descargar archivo de ejemplo</span>
                <span class="rg-part"><i class="fas fa-plus"></i></span>
              </a>
            </div>

            <div class="col-12 form-group">
              <input type="file" name="archivo" id="archivo" class="form-control  file-document" data-buttonName="btn-primary" onchange="validardocumento('archivo');" accept=" application/vnd.ms-excel, .xlsx">

            </div>

            <div class="col-12  text-center mt-3 ">
              <div class="btn-modal-footer d-grid gap-2">
                <button type="submit" class="btn btn-guardar w-100" type="submit">Guardar</button>

                <button type="button" class="btn btn-cancelar w-100" data-bs-dismiss="modal">Cancelar</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalUsuarios" tabindex="-1" aria-labelledby="modalUsuariosLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-body">
        <form class="text-left" enctype="multipart/form-data" method="post" action="/administracion/configvotacion/updateusuariosjs" id="form-usuarios" data-bs-toggle="validator">
          <input type="hidden" name="votacion" id="votacion-usuarios">
          <input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
          <input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
          <?php if ($this->content->id) { ?>
            <input type="hidden" name="id" id="id" value="<?= $this->content->id; ?>" />
          <?php } ?>
          <div class="row px-1">

            <div class="col-lg-12">
              <div class="caja_azul">
                <div class="d-flex justify-content-between align-items-center h-100">
                  <div class="titulo_dashboard d-flex align-items-center">
                    <div class="d-flex align-items-center gap-2">
                      <i class="fa-solid fa-location-dot"></i> <span id="modalTitleZona">Importar Usuarios</span>
                    </div>

                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                    </>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12  text-end my-3">
              <a href="/skins/page/files/zonasejemplo.xlsx" target="_blank"
                class="custom-btn-home">
                <span class="add-button-home lf-part">Descargar archivo de ejemplo</span>
                <span class="rg-part"><i class="fas fa-plus"></i></span>
              </a>
            </div>

            <div class="col-12 form-group">
              <input type="file" name="archivo2" id="archivo2" class="form-control  file-document" data-buttonName="btn-primary" onchange="validardocumento('archivo2');" accept=" application/vnd.ms-excel, .xlsx">

            </div>

            <div class="d-none justify-content-center mt-4" id="spinner-usuarios">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
            <div id="resumen-cargue" class="my-3"></div>

            <div class="col-12  text-center mt-3 ">
              <div class="btn-modal-footer d-grid gap-2">
                <button type="submit" class="btn btn-guardar w-100" type="submit" id="btn-submit-usuarios">Guardar</button>

                <button type="button" class="btn btn-cancelar w-100" data-bs-dismiss="modal" id="btn-cancel-usuarios">Cancelar</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('form-usuarios').addEventListener('submit', async function(event) {
    event.preventDefault();
    document.getElementById('btn-submit-usuarios').disabled = true;
    document.getElementById('btn-can-usuarios').disabled = true;
    document.getElementById('spinner-usuarios').classList.remove('d-none');
    document.getElementById('spinner-usuarios').classList.add('d-flex');

    const formData = new FormData(this);
    let nextBatch = true;
    let inicio = 0;

    while (nextBatch) {
      // Agrega el parámetro "inicio" al FormData
      formData.set('inicio', inicio);

      try {
        const response = await fetch(this.action, {
          method: 'POST',
          body: formData,
        });

        const data = await response.json();



        // Actualiza el contenido del modal con el resumen
        document.getElementById('resumen-cargue').innerHTML = `
  <div class="alert alert-warning text-center" role="alert">
    Procesados: <strong>${data.campofinal} de ${data.total}</strong>
  </div>
  <div class="progress mt-3">
    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: ${(data.campofinal / data.total) * 100}%;" aria-valuenow="${data.campofinal}" aria-valuemin="0" aria-valuemax="${data.total}">
      ${Math.round((data.campofinal / data.total) * 100)}%
    </div>
  </div>
`;

        // Verifica si debe continuar con la siguiente tanda
        if (data.rute.includes('updateusuariosjs')) {
          inicio = data.campofinal + 1; // Prepara el siguiente lote
        } else {
          nextBatch = false; // Detiene el bucle
          swal.fire({
            title: 'Carga masiva completada',
            text: 'Se han importado los usuarios correctamente.',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#1C405A'
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              const modalUsuarios = new bootstrap.Modal(document.getElementById('modalUsuarios'));
              modalUsuarios.hide();
            }
          });
        }
      } catch (error) {
        console.error('Error:', error);
        nextBatch = false; // Detiene el bucle en caso de error
      }
    }
  });
</script>

<!-- Modal para Crear Tarjetón -->
<div class="modal fade" id="modalTarjeton" tabindex="-1" aria-labelledby="modalTarjetonLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>" data-bs-toggle="validator">
          <input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
          <input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">

          <div class="row px-1">
            <div class="col-lg-12">
              <div class="caja_azul">
                <div class="d-flex justify-content-between align-items-center h-100">
                  <div class="titulo_dashboard d-flex align-items-center">
                    <div class="d-flex align-items-center gap-2">
                      <i class="fa-solid fa-check-to-slot"></i> <span id="modalTitleTarjeton">Crear Nuevo Tarjetón</span>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 mt-3 mb-3">
              <span class="detail-modal">Por favor ingrese los datos del tarjetón.</span>
            </div>

            <div class="alert alert-info px-3" role="alert" id="alerta-cantidad">
              La cantidad de votos que un usuario puede emitir solo se aplica cuando <strong>NO se está filtrando por zonas.</strong> En caso contrario, la cantidad máxima de votos permitidos por usuario se determina según la asignación específica de la zona del usuario. </div>

            <input type="hidden" name="tarjeton_elecciones" id="votacion-tarjeton">

            <div class="col-12 mb-3">

              <label class="input-group">

                <input type="text" name="tarjeton_nombre" placeholder="Nombre Del Tarjetón" id="tarjeton_nombre" class="form-control">
              </label>

            </div>

            <div class="col-12 mb-3" id="content-cantidad">
         
              <label class="input-group">

                <input type="number" placeholder="Cantidad De Votos Por Usuario" name="tarjeton_cantidad_votos" id="tarjeton_cantidad_votos" class="form-control">
              </label>

            </div>

            <div class="col-12 mb-3">
             
              <label class="input-group">

                <input type="text" name="tarjeton_titulo" placeholder="Título del Tarjetón" id="tarjeton_titulo" class="form-control">
              </label>

            </div>

            <div class="col-4 mb-3">
              <label class="form-label" for="tarjeton_estado">Tarjetón activo</label><br>
              <input type="checkbox" name="tarjeton_estado" id="tarjeton_estado" value="1" class="form-control switch-form ">

            </div>

            <div class="col-4 mb-3">
              <label class="form-label">Filtrar por zona</label><br>
              <input type="checkbox" name="tarjeton_zona" id="tarjeton_zona" value="1" class="form-control switch-form ">
            </div>

            <div class="col-4 mb-3">
              <label for="tarjeton_mostrar_detalle" class="form-label">Mostrar detalle</label><br>
              <input type="checkbox" name="tarjeton_mostrar_detalle" value="1" class="form-control switch-form ">

            </div>



            <div class="col-6 mb-3">
              <label class="form-label">Mostrar suplente</label><br>
              <input type="checkbox" name="tarjeton_mostrar_suplente" value="1" class="form-control switch-form ">

            </div>
            <div class="col-6 mb-3">
              <label class="form-label">Con voto en blanco</label><br>
              <input type="checkbox" name="tarjeton_voto_blanco" value="1" class="form-control switch-form ">

            </div>
            <div class="col-12 d-none mb-3">
              <label class="form-label">Vista de cuadrícula</label><br>
              <input type="checkbox" name="tarjeton_mostrar_fotos" value="1" class="form-control switch-form ">

            </div>

            <div class="col-12 mb-3">
              <label for="tarjeton_descripcion" class="form-label">Descripci&oacute;n</label>
              <textarea name="tarjeton_descripcion" id="tarjeton_descripcion" class="form-control tinyeditor" rows="10"></textarea>

            </div>

            <div class="col-12 text-center mt-3">
              <div class="btn-modal-footer d-grid gap-2">
                <button type="submit" class="btn btn-guardar w-100" type="submit">Guardar</button>
                <button type="button" class="btn btn-cancelar w-100" data-bs-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const modalTarjeton = new bootstrap.Modal(document.getElementById('modalTarjeton'));
  modalTarjeton.show();
</script>