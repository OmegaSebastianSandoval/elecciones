<div class="general-container login-container step3-container">
  <div class="step-guide">
    <div class="container">

      <h3>PASO 2: <span>SELECCIONE SU CANDIDATO</span> </h3>
    </div>
  </div>
  <div class="container pt-5">

    <span class="title-two mt-3 d-block">
      <strong><?php echo $this->parte1 ?>
        <span class="green-text">
          <?php echo $this->parte2 ?>
        </span>
      </strong>
      <br>
    </span>
    <div class="info-text mt-3">
      <?php
     

     $cantidadMaxima = $this->cantidadMaximaVotos;
     $cantidadCandidatos = count($this->candidatos);
     
     if ($cantidadMaxima > $cantidadCandidatos) {
         $cantidadMaxima = $cantidadCandidatos;
     
         if ($this->tarjeton->tarjeton_voto_blanco == 1) {
             $cantidadMaxima--;
         }
     }
     
      ?>
      <?php if ($this->tarjeton->tarjeton_zona == 1) { ?>
        <div class="text-gray mt-2">
          Señor asociado, usted se encuentra inscrito en la zona de
          <?php echo $this->zonaInfo->zona ?> a continuación se visualizan los candidatos por los
          cuales usted podrá ejercer su derecho al voto,
          <span class="text-gray mt-2">

            <?php echo $this->tarjeton->tarjeton_descripcion ?>

            Marque un máximo de <?php echo ($cantidadMaxima > 1 ?  $cantidadMaxima . ' candidatos' : $cantidadMaxima . ' candidato') ?>.

          </span>
        </div>
      <?php } else { ?>
        <div class="text-blue mt-2">

          <?php echo $this->tarjeton->tarjeton_descripcion ?>

        </div>

      <?php } ?>
    </div>

    <div class="alert alert-warning" role="alert">
      Has click sobre la foto para seleccionar.
    </div>

    <form action="/page/step3/selectcandidates" class="row login-form form-multiple formulario-eleccion p-0" method="post" id="selectCandidateMultiple1">
      <input type="hidden" name="cantidad-maxima" id="cantidad-maxima" value="<?php echo $this->cantidadMaximaVotos ?>">
      <input type="hidden" name="mostrar-fotos" id="mostrar-fotos" value="<?php echo $this->tarjeton->tarjeton_mostrar_fotos ?>">
      <?php
      $colspan = 5 + ($this->tarjeton->tarjeton_mostrar_suplente == 1) + ($this->tarjeton->tarjeton_mostrar_detalle == 1);
      ?>


      <div class="table-container">
        <div class="table-column">
          <table>
            <thead class="thead-fijo">
              <tr>
                <th colspan="<?php echo $colspan ?>" class="table-title">
                  <?php echo $this->tarjeton->tarjeton_titulo ?>
                </th>
              </tr>
              <tr>
                <th></th>
                <th>No.</th>
                <th>Candidato</th>
                
                <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>
                  <th>Detalle</th>
                <?php } ?>
                <?php if ($this->tarjeton->tarjeton_zona == 1) { ?>
                  <th>Zona</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody class="cursor-po">
              <?php foreach (array_slice($this->candidatos, 0, ceil(count($this->candidatos) / 2)) as $key => $c) { ?>
                <tr class="checked-candidate">
                  <td style="height: 100px">
                    <?php if ($this->cantidadMaximaVotos == 1) { ?>
                      <input type="radio" name="candidates[]" id="candidate_<?php echo $c->id ?>" value="<?php echo $c->id ?>" class="radio" onclick="event.stopPropagation()">
                      <label for="candidate_<?php echo $c->id ?>" class="candidate-photo">
                      <?php } else { ?>
                        <input type="checkbox" data-name="<?php echo $c->nombre ?>" name="candidates[]" id="candidate_<?php echo $c->id ?>" value="<?php echo $c->id ?>" class="checkbox">
                        <label for="candidate_<?php echo $c->id ?>" class="checkbox-label">
                        <?php } ?>
                        <?php if ($c->foto) { ?>
                          <img src="/images/<?php echo $c->foto ?>" alt="">
                        <?php } else { ?>
                          <img src="/skins/page/images/user-solid.png" alt="">
                        <?php } ?>
                        </label>
                  </td>
                  <td><span class="number-candidate number"><?php echo $c->numero ?></span></td>
                  <td><span class="name-candidate"><?php echo $c->nombre ?><br>
                      <!-- <span><?php echo $c->detalle ?></span> -->
                    </span></td>
                  
                  <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>
                    <td><span class="name-candidate"><?php echo $c->detalle ?></span></td>
                  <?php } ?>
                  <?php if ($this->tarjeton->tarjeton_zona == 1) { ?>
                    <td><span class="city-candidate"><?php echo $this->list_zonas[$c->zona] ?></span></td>
                  <?php } ?>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>

        <div class="table-column">
          <table>
            <thead class="thead-fijo">
              <tr>
                <th colspan="<?php echo $colspan ?>" class="table-title">
                  <?php echo $this->tarjeton->tarjeton_titulo ?>
                </th>
              </tr>
              <tr>
                <th></th>
                <th>No.</th>
                <th>Candidato</th>
                
                <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>
                  <th>Detalle</th>
                <?php } ?>
                <?php if ($this->tarjeton->tarjeton_zona == 1) { ?>
                  <th>Zona</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody class="cursor-po">
              <?php foreach (array_slice($this->candidatos, ceil(count($this->candidatos) / 2)) as $key => $c) { ?>
                <tr class="checked-candidate">
                  <td style="height: 100px">
                    <?php if ($this->cantidadMaximaVotos == 1) { ?>
                      <input type="radio" name="candidates[]" id="candidate_<?php echo $c->id ?>" value="<?php echo $c->id ?>" class="radio" onclick="event.stopPropagation()">
                      <label for="candidate_<?php echo $c->id ?>" class="candidate-photo">
                      <?php } else { ?>
                        <input type="checkbox" data-name="<?php echo $c->nombre ?>" name="candidates[]" id="candidate_<?php echo $c->id ?>" value="<?php echo $c->id ?>" class="checkbox">
                        <label for="candidate_<?php echo $c->id ?>" class="checkbox-label">
                        <?php } ?>
                        <?php if ($c->foto) { ?>
                          <img src="/images/<?php echo $c->foto ?>" alt="Imagen Candidato">
                        <?php } else { ?>
                          <img src="/skins/page/images/user-solid.png" alt="Imagen Default">
                        <?php } ?>
                        </label>
                  </td>
                  <td><span class="number-candidate number"><?php echo $c->numero ?></span></td>
                  <td><span class="name-candidate"><?php echo $c->nombre ?><br>
                      <!-- <span><?php echo $c->detalle ?></span> -->
                    </span></td>
                  
                  <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>
                    <td><span class="name-candidate"><?php echo $c->detalle ?></span></td>
                  <?php } ?>
                  <?php if ($this->tarjeton->tarjeton_zona == 1) { ?>
                    <td><span class="city-candidate"><?php echo $this->list_zonas[$c->zona] ?></span></td>
                  <?php } ?>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-12 mt-3 d-flex justify-content-center">
        <div class="d-flex justify-content-end">
          <!--  <a class="button back" href="/page/step3/backselection">

            <div class="text">
              Volver
            </div>
          </a> -->

          <button class="button">
            <div class="text">
              Continuar
            </div>

          </button>
        </div>
      </div>
    </form>
  </div>
</div>



<style>
  .table-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px
  }

  .table-column {
    flex: 1 1 49%;
    box-sizing: border-box;
    /* padding: 0 10px; */
  }

  .table-column table {
    width: 100%;
  }

  .thead-fijo {
    display: table-header-group;
  }

  .thead-fijo th {
    background-color: #f2f2f2;
    font-weight: bold;
  }
</style>