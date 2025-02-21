<?php

/**
 * Modelo del modulo Core que se encarga de  enviar todos los correos nesesarios del sistema.
 */
class Core_Model_Sendingemail
{
  /**
   * Intancia de la calse emmail
   * @var class
   */
  protected $email;

  protected $_view;

  public function __construct($view)
  {
    $this->email = new Core_Model_Mail();
    $this->_view = $view;
  }


  public function forgotpassword($user)
  {
    if ($user) {
      $code = [];
      $code['user'] = $user->user_id;
      $code['code'] = $user->code;
      $codeEmail = base64_encode(json_encode($code));
      $this->_view->url = "http://" . $_SERVER['HTTP_HOST'] . "/administracion/index/changepassword?code=" . $codeEmail;
      $this->_view->host = "http://" . $_SERVER['HTTP_HOST'] . "/";
      $this->_view->nombre = $user->user_names . " " . $user->user_lastnames;
      $this->_view->usuario = $user->user_user;
      /*fin parametros de la vista */
      //$this->email->getMail()->setFrom("desarrollo4@omegawebsystems.com","Intranet Coopcafam");
      $this->email->getMail()->addAddress($user->user_email,  $user->user_names . " " . $user->user_lastnames);
      $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/forgotpassword.php');
      $this->email->getMail()->Subject = "Recuperación de Contraseña Gestor de Contenidos";
      $this->email->getMail()->msgHTML($content);
      $this->email->getMail()->AltBody = $content;
      if ($this->email->sed() == true) {
        return true;
      } else {
        return false;
      }
    }
  }
  public function sendMailContact($data, $mail)
  {
    $this->_view->data = $data;
    $this->email->getMail()->addAddress($mail, "");
    $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/');
    $this->email->getMail()->Subject = '';
    $this->email->getMail()->msgHTML($content);
    $this->email->getMail()->AltBody = $content;
    // $this->email->getMail()->addBCC($informacion->info_pagina_correo_oculto);
    if ($this->email->sed() == true) {
      return 1;
    } else {
      return 2;
    }
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
  public function sendConfirmMultipleVoteOLD($consecutivo)
  {
    $candidatos_model = new Administracion_Model_DbTable_Candidatos();
    $config_model = new Administracion_Model_DbTable_Configvotacion();
    $zonasModel = new Administracion_Model_DbTable_Zonas();
    $tarjetones_model = new Administracion_Model_DbTable_Tarjetones();



    // Instancias de modelos necesarios
    $tarjetonactual = Session::getInstance()->get('tarjetonactual');

    $resumen = Session::getInstance()->get('resumen');



    $this->_view->config  = $config_model->getById(1);
    $this->_view->user_info = $user_info = Session::getInstance()->get('user');
    $this->_view->tarjeton = $tarjetonactual;
    $this->_view->zonaInfo = $zonasModel->getById($user_info->zona);
    $this->_view->list_zonas = $this->getZona();
    $this->_view->consecutivo = $consecutivo;


    $resumenCompleto = array();

    foreach ($resumen as $tarjetonId => $candidatosIds) {
      // Consultar el tarjetón por el ID
      $tarjeton = $tarjetones_model->getById($tarjetonId);

      // Inicializar un array para almacenar la información del tarjetón y los candidatos
      $infoTarjeton = array(
        'tarjeton' => $tarjeton,
        'candidatos' => array()
      );

      // Recorrer los IDs de candidatos y consultar la información de cada candidato
      foreach ($candidatosIds as $candidatoId) {
        $candidato = $candidatos_model->getById($candidatoId);
        // Agregar la información del candidato al array de candidatos
        $infoTarjeton['candidatos'][] = $candidato;
      }

      // Agregar la información del tarjetón y los candidatos al array completo
      $resumenCompleto[] = $infoTarjeton;
    }
    $this->_view->resumenCompleto = $resumenCompleto;

    $infopageModel = new Page_Model_DbTable_Informacion();
    $this->_view->informacion =  $informacion = $infopageModel->getById(1);

    //$this->email->getMail()->addAddress($user_info->correo);

    $this->email->getMail()->addBCC($informacion->info_pagina_correo_oculto);


    $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/sendmultiplevotes.php');
    $this->email->getMail()->Subject = 'Confirmación de votación Colaborar ';
    $this->email->getMail()->msgHTML($content);
    $this->email->getMail()->AltBody = $content;
    if ($this->email->sed() == true) {
      return 1;
    } else {
      return 2;
    }
  }

  public function getZona()
  {
    $modelData = new Administracion_Model_DbTable_Zonas();
    $data = $modelData->getList();
    $array = array();
    foreach ($data as $key => $value) {
      $array[$value->id] = $value->zona;
    }
    return $array;
  }
}
