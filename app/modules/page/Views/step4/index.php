<div class="general-container login-container step3-container">
  <div class="container">
    <div class="row">
      <div class="col-md-<?php echo ($this->tarjeton->tarjeton_mostrar_suplente == 1 || $this->tarjeton->tarjeton_mostrar_detalle == 1) ? '8' : '7'; ?>">
        <div class="row">
          <div class="col-12">
            <h3 class="title-one">Proceso electoral</h3>
          </div>
          <div class="col-12 d-none">
            <span class="title-two">
              <strong>Delegados a la</strong>
              <br>
              <span class="big-text green-text" style="margin-top: 10px; display: block;">
                asamblea 2021 - 2022
              </span>
            </span>
          </div>
          <div class="col-12">
            <form action="/page/step4/saveselection" class="row login-form" method="post" id="saveSelection">
              <?php if ($this->tarjetonForma == 1) { ?>

                <div class="grid-container col-md-12">
                  <div class="grid-item w-100">
                    <div class="row">
                      <?php if (!$this->candidates) { ?>

                        <div class="col-md-4">
                          <label for="candidate_<?php echo $this->candidate->id ?>" class="img-container">
                            <?php if ($this->candidate->foto) { ?>
                              <img src="/images/<?php echo $this->candidate->foto ?>" alt="">
                            <?php } else { ?>
                              <img src="/skins/page/images/user-solid.png" alt="">
                            <?php } ?>
                          </label>
                        </div>
                        <div class="col-md-8">
                          <div class="row h-100 align-items-center">
                            <div class="col-12 pt-2">
                              <span class="number-candidate">
                                <span><?php echo $this->candidate->numero ?>.</span> <?php echo $this->candidate->nombre ?>
                              </span>
                            </div>
                            <?php if ($this->tarjeton->tarjeton_mostrar_suplente == 1) { ?>

                              <div class="col-12 pt-2">
                                <span class="number-candidate">
                                  Suplente: <?php echo  $this->candidate->suplente ?>
                                </span>
                              </div>
                            <?php } ?>
                            <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>

                              <div class="col-12 pt-2">
                                <span class="number-candidate">
                                  <?php echo  $this->candidate->detalle ?>
                                </span>
                              </div>
                            <?php } ?>
                            <div class="col-12 py-2">
                              <span class="city-candidate">
                                <?php echo $this->list_zonas[$candidate->zona] ?>
                              </span>
                            </div>
                          </div>
                        </div>

                        <?php } else {
                        foreach ($this->candidates as $candidate) { ?>
                          <div class="col-md-4">
                            <label for="candidate_<?php echo $candidate->id ?>" class="img-container">
                              <?php if ($candidate->foto) { ?>
                                <img src="/images/<?php echo $candidate->foto ?>" alt="">
                              <?php } else { ?>
                                <img src="/skins/page/images/user-solid.png" alt="">
                              <?php } ?>
                            </label>
                          </div>
                          <div class="col-md-8">
                            <div class="row h-100 align-items-center">
                              <div class="col-12 pt-2">
                                <span class="number-candidate">
                                  <span><?php echo $candidate->numero ?>.</span> <?php echo $candidate->nombre ?>
                                </span>
                              </div>
                              <?php if ($this->tarjeton->tarjeton_mostrar_suplente == 1) { ?>

                                <div class="col-12 pt-2">
                                  <span class="number-candidate">
                                    Suplente: <?php echo  $candidate->suplente ?>
                                  </span>
                                </div>
                              <?php } ?>
                              <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>

                                <div class="col-12 pt-2">
                                  <span class="number-candidate">
                                    <?php echo  $candidate->detalle ?>
                                  </span>
                                </div>
                              <?php } ?>
                              <div class="col-12 py-2">
                                <span class="city-candidate">
                                  <?php echo $this->list_zonas[$candidate->zona] ?>
                                </span>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php } else { ?>

                <?php
                $colspan = 4 + ($this->tarjeton->tarjeton_mostrar_suplente == 1) + ($this->tarjeton->tarjeton_mostrar_detalle == 1);
                ?>
                <table>
                  <thead>
                    <tr>
                      <th colspan="<?php echo $colspan ?>" class="table-title">
                        Zona: <?php echo  $this->zonaInfo->zona ?>
                      </th>
                    </tr>
                    <tr>
                      <th>
                      </th>
                      <th>
                        N
                      </th>
                      <th>
                        Candidato
                      </th>
                      </th>
                      <?php if ($this->tarjeton->tarjeton_mostrar_suplente == 1) { ?>
                        <th>
                          Suplente
                        </th>

                      <?php } ?>
                      <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>
                        <th>
                          Detalle
                        </th>

                      <?php } ?>
                      <th>
                        Ciudad
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!$this->candidates) { ?>

                      <tr>
                        <td style="max-width: 70px;">
                          <label for="candidate_<?php echo $this->candidate->id ?>" class="candidate-photo">
                            <div>
                              <?php if ($this->candidate->foto) { ?>
                                <img src="/images/<?php echo $this->candidate->foto ?>" alt="">
                              <?php } else { ?>
                                <img src="/skins/page/images/user-solid.png" alt="">
                              <?php } ?>
                            </div>
                          </label>
                        </td>
                        <td>
                          <span class="number-candidate">
                            <?php echo $this->candidate->numero ?>
                          </span>
                        </td>
                        <td>
                          <span class="name-candidate">
                            <?php echo $this->candidate->nombre ?>
                          </span>
                        </td>
                        <?php if ($this->tarjeton->tarjeton_mostrar_suplente == 1) { ?>

                          <td>
                            <span class="name-candidate">
                              <?php echo  $this->candidate->suplente ?>
                            </span>
                          </td>
                        <?php } ?>
                        <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>

                          <td>
                            <span class="name-candidate">
                              <?php echo  $this->candidate->detalle ?>
                            </span>
                          </td>
                        <?php } ?>
                        <td>
                          <span class="city-candidate">
                            <?php echo $this->list_zonas[$this->candidate->zona] ?>
                          </span>
                        </td>
                      </tr>
                      <?php } else {

                      foreach ($this->candidates as $candidate) { ?>
                        <tr>
                          <td style="max-width: 70px;">
                            <label for="candidate_<?php echo $candidate->id ?>" class="candidate-photo">
                              <div>
                                <?php if ($candidate->foto) { ?>
                                  <img src="/images/<?php echo $candidate->foto ?>" alt="">
                                <?php } else { ?>
                                  <img src="/skins/page/images/user-solid.png" alt="">
                                <?php } ?>
                              </div>
                            </label>
                          </td>
                          <td>
                            <span class="number-candidate">
                              <?php echo $candidate->numero ?>
                            </span>
                          </td>
                          <td>
                            <span class="name-candidate">
                              <?php echo $candidate->nombre ?>
                            </span>
                          </td>
                          <?php if ($this->tarjeton->tarjeton_mostrar_suplente == 1) { ?>

                            <td>
                              <span class="name-candidate">
                                <?php echo  $candidate->suplente ?>
                              </span>
                            </td>
                          <?php } ?>
                          <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>

                            <td>
                              <span class="name-candidate">
                                <?php echo  $candidate->detalle ?>
                              </span>
                            </td>
                          <?php } ?>
                          <td>
                            <span class="city-candidate">
                              <?php echo $this->list_zonas[$candidate->zona] ?>
                            </span>
                          </td>
                        </tr>
                      <?php } ?>

                    <?php } ?>

                  </tbody>
                </table>
              <?php } ?>
              <?php if ($this->candidates) {
                foreach ($this->candidates as $candidate) { ?>
                  <input type="hidden" name="candidates_ids[]" value="<?php echo $candidate->id  ?>">
                  <input type="hidden" name="zona" value="<?php echo $candidate->zona ?>">
                <?php } ?>
              <?php } else { ?>
                <input type="hidden" name="zona" value="<?php echo $this->candidate->zona ?>">
                <input type="hidden" name="candidate_id" value="<?php echo $this->candidate_id ?>">
              <?php } ?>

              <?php   if ($this->config->votacion_mostrar_campo == 1) { ?>

                <div class="form-floating mt-3">
                  <textarea class="form-control" placeholder="" name="comentarios" id="comentarios" style="height: 100px"></textarea>
                  <label for="comentarios"> <?php echo $this->config->votacion_texto_campo ?></label>
                </div>
              <?php } ?>
              <div class="col-12 mt-4">
                <div class="d-flex justify-content-start">
                  <a class="button back" href="/page/step3" style="">
                    <svg height="24" viewBox="0 0 24 24" fill="#FFFF" width="24" xmlns="http://www.w3.org/2000/svg">
                      <path class="heroicon-ui" d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z" />
                    </svg>
                    Retornar
                  </a>
                  <button class="button">
                    <div class="text">
                      Continuar
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-12">
            <div class="d-flex justify-content-start align-items-center">
              <img src="/skins/page/images/check.png" alt="">
              <span class="check-text">
                Verificar candidato <br>
                seleccionado y hacer
                click en continuar
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-<?php echo ($this->tarjeton->tarjeton_mostrar_suplente == 1 || $this->tarjeton->tarjeton_mostrar_detalle == 1) ? '4' : '5'; ?>">
        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            <div class="info-text">
              <span class="text-white">
                Señor asociado, usted seleccionó los <br>
                siguientes candidatos, debe hacer <br>
                click en botón confirmar.
                <br>
              </span>
            </div>
          </div>
          <div class="col-12">
            <div class="d-flex justify-content-end">
              <img src="/skins/page/images/num04.png" alt="" class="step-number">
            </div>
          </div>
          <div class="col-12">
            <div class="d-flex justify-content-end">
              <img src="/images/<?php echo $this->infopage->info_logo_grande ?>" alt="" class="logo-omega">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .grid-container {
    border-left: 2px solid #0033a060;
    border-bottom: 2px solid #0033a060;
    border-right: 2px solid #0033a060;
    padding-top: 10px;
  }

  .general-container.step3-container table .candidate-photo,
  .general-container.step3-container table .candidate-photo div {
    pointer-events: none;
  }

  .grid-container .grid-item .img-container {
    pointer-events: none;


  }
</style>