<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Roboto';
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f4f8; padding: 20px;">
    <div style="max-width: 750px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="background-color: #2377ba; color: #ffffff; padding: 16px; display: flex; align-items: center;">
            <h4 style="margin: 0; font-size: 20px;"><?php echo 'Certificado de votación N° ' . $this->resultados->consecutivo ?></h4>
        </div>
        <div style="padding: 24px;padding-top: 10px">
            <p style="font-size: 16px; margin-bottom: 14px;color: #0d3a58;">Cordial Saludo,</p>
            <div style="background-color: #2377ba; padding: 16px; border-radius: 8px; display: flex; align-items: center;">
                <div style="flex-grow: 1;">
                    <p style="margin: 0; font-size: 15px; color: white;font-weight: 400;">
                      Hola, <?php echo $this->user_info->nombre ?><br>
                      Se notifica que tu voto ha sido registrado con éxito.<br>
                      Agradecemos tu participación en el proceso electoral. Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos.<br>
                      Fecha del voto: <b><?php echo $this->resultados->fecha ?></b>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
