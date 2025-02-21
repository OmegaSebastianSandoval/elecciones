<div class="general-container login-container step3-container">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <div class="row">
          <div class="col-12">
            <h3 class="title-one">Proceso electoral</h3>
          </div>
          <div class="col-12">
            <span class="title-two">
              <strong><?php echo $this->parte1 ?></strong>
              <br>
              <span class="big-text green-text" style="margin-top: 10px; display: block;">
                <?php echo $this->parte2 ?>
              </span>
            </span>
          </div>

          <div class="col-12">
            <form action="/page/step3/selectcandidate" class="row login-form" method="post" id="selectCandidate">
              <div class="table-container">
                <table>
                  <thead>
                    <tr>
                      <th colspan="4" class="table-title">
                        Ciudad: Bogotá D.C
                      </th>
                    </tr>
                    <tr>
                      <th colspan="2">
                        N
                      </th>
                      <th>
                        Candidato
                      </th>
                      <th>
                        Ciudad
                      </th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($this->candidatos as $key => $c) { ?>
                      <tr>
                        <td style="max-width: 70px;">
                          <input type="radio" name="candidate" id="candidate_<?php echo $c->id ?>" value="<?php echo $c->id ?>">
                          <label for="candidate_<?php echo $c->id ?>" class="candidate-photo">
                            <div>
                              <?php if ($c->foto) { ?>
                                <img src="/images/<?php echo $c->foto ?>" alt="">
                              <?php } else { ?>
                                <img src="/skins/page/images/user-solid.png" alt="">
                              <?php } ?>
                            </div>
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
                          </span>
                        </td>
                        <td>
                          <span class="city-candidate">
                            <?php echo $c->zona ?>
                          </span>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="col-12">
                <div class="d-flex justify-content-end">
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
                Seleccionar un <br>
                candidato de la lista y
                hacer click en continuar
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="row">
          <div class="col-12 d-flex justify-content-end">
            <div class="info-text">
              <span class="text-white">
                Señor asociado, usted se encuentra escrito en la zona de
                <?php echo $this->zonaInfo->zona ?> a continuación se visualizan los candidatos por los
                cuales usted podrá ejercer su derecho al voto,
                <br>
                <span class="green-text mt-2">
                  <?php echo $this->tarjeton->tarjeton_descripcion ?>
                </span>
              </span>
            </div>
          </div>
          <div class="col-12">
            <div class="d-flex justify-content-end align-items-center">
              <img src="/skins/page/images/check.png" alt="">
              <span class="check-text">
                Ingresar o confirmar el correo electrónico
              </span>
            </div>
          </div>
          <div class="col-12">
            <div class="d-flex justify-content-end">
              <img src="/skins/page/images/num03.png" alt="" class="step-number">
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