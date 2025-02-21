<div class="container-fluid">
  <div class="content-dashboard">
    <div class="content-table">
      <table class=" table table-striped  table-hover table-administrator text-left">
        <thead>
          <tr>
            <td>Zona</td>
            <td>Votos</td>
            <td>Porcentaje</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach($this->resultados as $res): ?>
            <tr>
              <th colspan="3">
                <?php echo $res['nombre']; ?>
              </th>
            </tr>
            <?php foreach($res as $c): ?>
              <?php
                echo $c['candidato'];
              ?>
            <?php endforeach; ?>
          <?php endforeach; ?>
          <tr>
            <td>2018-02-28 06:30:00</td>
            <td>2023-02-28 17:00:00</td>
            <td>2023-02-28 17:00:00</td>
          </tr>
        </tbody>
      </table>
    </div>
    <input type="hidden" id="csrf" value="(OBE3;)TCN-NI852J95T"><input type="hidden" id="page-route" value="/administracion/configvotacion/changepage">
  </div>
  <div align="center">
    <ul class="pagination justify-content-center">
    </ul>
  </div>
</div>