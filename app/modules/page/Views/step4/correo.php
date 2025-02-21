<div style=" background: #6e6e6e20; padding: 10px; font-size: 15px;">
  <table style="width: 100%; background-color:#0033a060;">

    <thead>
      <tr>
        <th colspan="4" class="table-title">
          <h1 style="border:0;color:#ffffff;font-weight:400;margin:0;outline:0;padding:0;"> Resumen proceso electoral</h1>
        </th>
      </tr>

    </thead>

  </table>
  <table style="width: 100%;">
    <thead>
      <tr>
        <th colspan="4" style="padding-top: 10px; padding-bottom: 10px;">
          Zona: <?php echo  $this->zonaInfo->zona ?>
        </th>
      </tr>

    </thead>
  </table>

  <?php foreach ($this->resumenCompleto as $tarjeton) { ?>


    <table style="width: 100%; background-color:#0033a060;  margin-bottom:10px;">
      <thead>
        <tr>
          <th colspan="4" style="padding-top: 10px; padding-bottom: 10px; border:0;color:#222;font-family:HMSans,Arial,sans-serif;font-size:16px;font-weight:400;line-height:20px;margin:0;outline:0;text-decoration:none">
            <?php echo  $tarjeton['tarjeton']->tarjeton_nombre ?>
          </th>
        </tr>

      </thead>
    </table>

    <table style="width: 100%; margin-bottom:30px;">
      <thead>

        <tr>
          <th colspan="2">
            N&uacute;mero
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
        <?php foreach ($tarjeton['candidatos'] as $candidate) { ?>
          <tr>
            <td style="max-width: 30px;">
              <label for="candidate_<?php echo $candidate->id ?>" class="candidate-photo">
                <div style="text-align:center">
                  <?php if ($candidate->foto) { ?>
                    <img src="/images/<?php echo $candidate->foto ?>" alt="" style="width:100px;height:100px">
                  <?php } else { ?>
                    <img src="/skins/page/images/user-solid.png" alt="" style="width:100px;height:100px">
                  <?php } ?>
                </div>
              </label>
            </td>
            <td>
              <span class="number-candidate">
                <?php echo $candidate->numero ?>
              </span>
            </td>
            <td style="text-align:center">
              <span class="name-candidate">
                <?php echo $candidate->nombre ?>
              </span>
            </td>
            <td style="text-align:center">
              <span class="city-candidate">
                <?php echo $candidate->zona ?>
              </span>
            </td>
          </tr>
        <?php } ?>

      </tbody>
    </table>

  <?php } ?>

</div>