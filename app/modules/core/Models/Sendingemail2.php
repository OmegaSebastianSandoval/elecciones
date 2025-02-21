<?php

/**
 * Modelo del modulo Core que se encarga de  enviar todos los correos nesesarios del sistema.
 */
class Core_Model_Sendingemail2
{
  /**
   * Intancia de la calse emmail
   * @var class
   */
  protected $email;

  protected $_view;

  public function __construct($view)
  {
    $this->email = new Core_Model_Mail2();
    $this->_view = $view;
  }

  public function sendConfirmMultipleVote($consecutivo)
  {

    $resultadosModel = new Administracion_Model_DbTable_Resultados();
    $this->_view->resultados  = $resultadosModel->getList("consecutivo = '$consecutivo'")[0];
    $this->_view->user_info = $user_info = Session::getInstance()->get('user');


    $infopageModel = new Page_Model_DbTable_Informacion();
    $this->_view->informacion =  $informacion = $infopageModel->getById(1);

    // $this->email->getMail()->addAddress($user_info->correo);
    $this->email->getMail()->addBCC("desarrollo8@omegawebsystems.com");

    // $this->email->getMail()->addBCC($informacion->info_pagina_correo_oculto);


    $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/confirmvote.php');
    $this->email->getMail()->Subject = 'Confirmación de votación FODUN ';
    $this->email->getMail()->msgHTML($content);
    $this->email->getMail()->AltBody = $content;

    if ($this->email->sed() == true) {
      return 1;
    } else {
      return 2;
    }
  }
}
