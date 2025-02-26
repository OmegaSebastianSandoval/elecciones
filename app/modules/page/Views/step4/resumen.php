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

  .contenedor-general {
    height: auto;
    min-height: calc(100% - 130px);
    padding-bottom: 45px;
  }
</style>

<div class="general-container login-container step3-container">
  <div class="step-guide">
    <div class="container">
      <h3>PASO 3: <span>CONFIRME SU VOTO</span> </h3>
    </div>
  </div>
  <div class="container pt-5">
    <span class="title-two d-block mt-2">
      <strong>Resumen
        <span class="green-text">
          proceso electoral
        </span>
      </strong>
      <br>
    </span>
    <div class="info-text mt-3 text-blue">

      Señor asociado.
      <br>
      <span>
        Usted seleccionó el siguiente candidato. Para continuar debe hacer click en el botón votar.
      </span>

    </div>

    <div class="bg-whit">
      <form action="/page/step4/saveselectionmultiple" class="row login-form p-0" method="post" id="saveSelectionMultiple">
        <?php foreach ($this->resumenCompleto as $tarjeton) { ?>
          <?php if ($tarjeton['tarjeton']->tarjeton_mostrar_fotos == 1) { ?>
            <table>
              <thead>
                <tr>
                  <th colspan="4" class="table-title">
                    <?php echo  $tarjeton['tarjeton']->tarjeton_nombre ?>
                  </th>
                </tr>

              </thead>
            </table>
            <div class="grid-container mb-4">
              <?php foreach ($tarjeton['candidatos'] as $key => $c) { ?>
                <div class="grid-item">
                  <div class="row">
                    <div class="col-12">
                      <input type="radio" name="candidate" id="candidate_<?php echo $c->id ?>" value="<?php echo $c->id ?>">
                      <label for="candidate_<?php echo $c->id ?>" class="img-container">
                        <?php if ($c->foto) { ?>
                          <img src="/images/<?php echo $c->foto ?>" alt="">
                        <?php } else { ?>
                          <img src="/skins/page/images/user-solid.png" alt="">
                        <?php } ?>
                      </label>
                    </div>
                    <div class="col-12 pt-2">
                      <span class="number-candidate">
                        <span><?php echo $c->numero ?>.</span> <?php echo $c->nombre ?>
                      </span>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>

          <?php  } else { ?>
            <table class="mb-4">
              <thead>
                <tr>
                  <?php
                  $colspan = 3 + ( $tarjeton['tarjeton']->tarjeton_mostrar_suplente == 1) + ( $tarjeton['tarjeton']->tarjeton_mostrar_detalle == 1);
                  ?>
                  
                  <th colspan="<?php echo $colspan ?>" class="table-title">


                    <?php echo $tarjeton['tarjeton']->tarjeton_nombre ?>
                  </th>
                </tr>

              </thead>
              <tbody>
                <?php foreach ($tarjeton['candidatos'] as $candidate) { ?>
                  <tr>
                    <td width="100">
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
                    <td width="50">
                      <span class="number-candidate">
                        <?php echo $candidate->numero ?>
                      </span>
                    </td>
                    <td>
                      <span class="name-candidate">
                        <?php echo $candidate->nombre ?>
                        <!--  <br>
                        <span>
                          <?php echo $candidate->detalle ?>
                        </span> -->
                      </span>
                    </td>
                    <?php if ($tarjeton['tarjeton']->tarjeton_mostrar_detalle == 1) { ?>

                      <td align="center">
                        <span class="name-candidate">
                          <?php echo $candidate->detalle ?>
                        </span>
                      </td>
                    <?php } ?>

                  </tr>
                <?php } ?>

              </tbody>
            </table>

          <?php     }  ?>


        <?php } ?>

        <?php if ($this->config->votacion_mostrar_campo == 1) { ?>

          <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" name="comentarios" id="comentarios" style="height: 100px"></textarea>
            <label for="comentarios" style="left:auto"> <?php echo $this->config->votacion_texto_campo ?> deje aca su comentario</label>
          </div>
        <?php } ?>
        <!-- <input type="hidden" name="zona" value="<?php echo $this->user_info->zona ?>"> -->

        <div class="col-12 mt-4">
          <div class="d-flex justify-content-center gap-5">
            <a class="button back" href="/page/step3" style="">

              <div class="text">
                Volver
              </div>
            </a>


            <button class="button" type="submit" id="btn-select">
              <div class="text">
                Votar
              </div>

            </button>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
<script language='javascript' type='text/javascript'>
  function DisableBackButton() {
    window.history.forward()
  }
  DisableBackButton();
  window.onload = DisableBackButton;
  window.onpageshow = function(evt) {
    if (evt.persisted) DisableBackButton()
  }
  window.onunload = function() {
    void(0)
  }
</script>