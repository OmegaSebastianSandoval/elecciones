<div class="general-container login-container step3-container">
  <div class="step-guide">
    <div class="container">

      <h3>PASO 2: <span>SELECCIONE SU CANDIDATO</span> </h3>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="  order-2 order-md-1 col-md-<?php echo ($this->tarjeton->tarjeton_mostrar_suplente == 1 || $this->tarjeton->tarjeton_mostrar_detalle == 1) ? '8' : '7'; ?>">

        <div class="row">
          <div class="col-12">
            <h3 class="title-one">Proceso electoral </h3>
          </div>
          <div class="col-12">
            <span class="title-two">
              <strong><?php echo $this->parte1 ?><span class="green-text">
                  <?php echo $this->parte2 ?>
                </span></strong>
              <br>

            </span>
          </div>

          <div class="col-12 order-2 order-md-1">
            <form action="/page/step3/selectcandidates" class="row login-form form-multiple formulario-eleccion" method="post" id="selectCandidateMultiple1">
              <input type="hidden" name="cantidad-maxima" id="cantidad-maxima" value="<?php echo $this->cantidadMaximaVotos ?>">
              <input type="hidden" name="mostrar-fotos" id="mostrar-fotos" value="<?php echo $this->tarjeton->tarjeton_mostrar_fotos ?>">
              <?php
              $colspan = 4 + ($this->tarjeton->tarjeton_mostrar_suplente == 1) + ($this->tarjeton->tarjeton_mostrar_detalle == 1);
              ?>


              <div class="table-container">
                <table>
                  <thead class="thead-fijo">
                    <tr>
                      <th colspan="<?php echo $colspan ?>" class="table-title">
                        <?php echo $this->tarjeton->tarjeton_titulo ?>
                      </th>
                    </tr>
                    <tr>
                      <th></th>
                      <th>
                        No.
                      </th>
                      <th>
                        Candidato
                      </th>

                      <th>
                        Empresa
                      </th>
                      <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>
                        <th>
                          Detalle
                        </th>

                      <?php } ?>
                      <?php if ($this->tarjeton->tarjeton_zona == 1) { ?>
                        <th>
                          Zona
                        </th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody class="cursor-po">

                    <?php foreach ($this->candidatos as $key => $c) { ?>
                      <tr onclick="activarCheckbox('<?php echo $c->id ?>')" class="checked-candidate">
                        <td style="height: 100px">

                          <?php if ($this->cantidadMaximaVotos == 1) { ?>
                            <input type="radio" name="candidates[]" id="candidate_<?php echo $c->id ?>" value="<?php echo $c->id ?>" class="radio">
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
                        <td>
                          <span class="number-candidate">
                            <?php echo $c->numero ?>
                          </span>
                        </td>
                        <td>
                          <span class="name-candidate">
                            <?php echo $c->nombre ?>
                            <br>
                            <span>
                              <?php echo $c->detalle ?>
                            </span>
                          </span>
                        </td>

                        <td>
                          <span class="name-candidate">
                            <?php echo $c->suplente ?>
                          </span>
                        </td>
                        <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>

                          <td>
                            <span class="name-candidate">
                              <?php echo $c->detalle ?>
                            </span>
                          </td>
                        <?php } ?>
                        <?php if ($this->tarjeton->tarjeton_zona == 1) { ?>
                          <td>
                            <span class="city-candidate">
                              <?php echo $this->list_zonas[$c->zona] ?>
                            </span>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
              <div class="col-12">
                <div class="d-flex justify-content-end">
                  <a class="button back" href="/page/step3/backselection">

                    <div class="text">
                      Volver
                    </div>
                  </a>

                  <button class="button">
                    <div class="text">
                      Continuar
                    </div>

                  </button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-12 order-1 order-md-2 mt-4 mt-md-0 d-none">
            <div class="d-flex justify-content-start align-items-center">
              <img src="/skins/page/images/check.png" alt="">
              <span class="check-text">
                Seleccionar un <br>
                candidato de la lista y
                hacer click en continuar
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="  order-1 order-md-2 col-md-<?php echo ($this->tarjeton->tarjeton_mostrar_suplente == 1 || $this->tarjeton->tarjeton_mostrar_detalle == 1) ? '4' : '5'; ?>">

        <div class="row">
          <div class="col-12 d-flex justify-content-end  order-3 order-md-1">
            <div class="info-text">
              <?php if ($this->tarjeton->tarjeton_zona == 1) { ?>
                <span class="text-white">
                  Señor asociado, usted se encuentra escrito en la zona de
                  <?php echo $this->zonaInfo->zona ?> a continuación se visualizan los candidatos por los
                  cuales usted podrá ejercer su derecho al voto,
                  <br>
                  <span class="green-text mt-2">
                    <?php echo $this->tarjeton->tarjeton_descripcion ?>

                    Marque un máximo de <?php echo ($this->cantidadMaximaVotos > 1 ?  $this->cantidadMaximaVotos . ' candidatos' : $this->cantidadMaximaVotos . ' candidato') ?>.

                  </span>
                </span>
              <?php } else { ?>
                <span class="text-white">
                  PROCESO ELECTORAL fonDtodos<br>
                  A continuación se visualizan los candidatos por los cuales usted podrá ejercer su derecho al voto.
                  <span class="green-text mt-2">
                    <?php echo $this->tarjeton->tarjeton_descripcion ?>
                    Marque un máximo de <?php echo ($this->cantidadMaximaVotos > 1 ?  $this->cantidadMaximaVotos . ' candidatos' : $this->cantidadMaximaVotos . ' candidato') ?>.
                  </span>
                </span>
              <?php } ?>
            </div>
          </div>
          <div class="col-12 order-1 order-md-2">
            <div class="d-flex justify-content-center justify-content-md-end align-items-center">
              <img src="/skins/page/images/check.png" alt="">
              <span class="check-text" style="font-size: 17px;">
                Si tiene alguna duda puede comunicarse con informacion@fondtodos.com
              </span>
            </div>
          </div>
          <div class="col-12 order-2 order-md-3">
            <div class="d-flex justify-content-center justify-content-md-end">
              <img src="/skins/page/images/num03.png" alt="" class="step-number">
            </div>
          </div>
          <div class="col-12 order-3 d-none d-md-block">
            <div class="d-flex justify-content-center justify-content-md-end">
              <img src="/images/<?php echo $this->infopage->info_logo_grande ?>" alt="" class="logo-omega">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>