<div style="background: #f5f5f5; padding: 20px; font-size: 20px; border-radius: 10px; width: 100%;  max-width: 800px; margin-right: auto; margin-left: auto; ">
  <table style="width: 100%; background-color: #ffffff; max-width: 700px; margin-right: auto; margin-left: auto; border-collapse: collapse;">

    <thead>
      <tr>
        <th style="text-align: left; padding: 10px; ">
          <img src="/images/<?php echo $this->infopage->info_logo_grande ?>" alt="logo empresa" style="width: 100%; max-width: 178px;padding: 30px;">
        </th>

        <th style="text-align: center; padding: 10px; ">
          <h1 style="font-family:Helvetica Neue,sans-serif;font-size:34px;font-weight:bold;line-height:125%;text-align:center;color:#20438dc9"><?php echo 'Certificado de <br> votación N° ' . $this->resultados->consecutivo ?></h1>
        </th>
      </tr>
    </thead>
    
    <tbody>
      <tr style="background-color:#20438dc9">
        <td style="text-align: left; padding: 25px; border:0;color:#FFF;font-size:20px;font-weight:600;line-height:20px;margin:0;outline:0;">
          Documento
        </td>
        <td style="text-align: left; padding: 25px; border:0;color:#FFF;font-size:20px;font-weight:600;line-height:20px;margin:0;outline:0;">
          <?php echo $this->user_info->cedula ?>
        </td>
      </tr>

      <tr style="background-color:#20438dc9">
        <td style="text-align: left; padding: 25px; border:0;color:#FFF;font-size:20px;font-weight:600;line-height:20px;margin:0;outline:0;">
          Nombre
        </td>
        <td style="text-align: left; padding: 25px; border:0;color:#FFF;font-size:20px;font-weight:600;line-height:20px;margin:0;outline:0;">
          <?php echo $this->user_info->nombre ?>
        </td>
      </tr>

      <tr style="background-color:#20438dc9">
        <td style="text-align: left; padding: 25px; border:0;color:#FFF;font-size:20px;font-weight:600;line-height:20px;margin:0;outline:0;">
          Fecha
        </td>
        <td style="text-align: left; padding: 25px; border:0;color:#FFF;font-size:20px;font-weight:600;line-height:20px;margin:0;outline:0;">
          <?php echo $this->resultados->fecha ?>
        </td>
      </tr>
    </tbody>
  </table>
</div>
