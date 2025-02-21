<?php

/**
 * Modelo del modulo Core que se encarga de inicializar  la clase de envio de correos
 */
class Core_Model_Mail2
{
    /**
     * classe de  phpmailer
     * @var class
     */
    private $mail;

    /**
     * asigna los valores a la clase e instancia el phpMailer
     */
    public function __construct()
    {

        $informacionModel = new Page_Model_DbTable_Informacion();
        $informacion = $informacionModel->getList("", "orden ASC")[0];

        $this->mail = new PHPMailer;
        $this->mail->CharSet = 'UTF-8';
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0;
        $this->mail->SMTPSecure = 'ssl';

        $this->mail->Host = $informacion->info_pagina_host2;
        $this->mail->Port = $informacion->info_pagina_port2;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $informacion->info_pagina_username2;
        $this->mail->Password = $informacion->info_pagina_password2;
        $this->mail->setFrom($informacion->info_pagina_correo_remitente2, $informacion->info_pagina_nombre_remitente2);
    }
    /**
     * retorna la  instancia de email
     * @return class email
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * envia el correo
     * @return bool envia el estado del correo
     */
    public function sed()
    {
        if ($this->mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}
