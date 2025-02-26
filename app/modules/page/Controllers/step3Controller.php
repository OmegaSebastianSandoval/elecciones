<?php

/**
 *
 */

class Page_step3Controller extends Page_mainController
{
  public $header_step = 3;

  public function init()
  {
    $this->verifyResult();

    parent::init();
  }
  public function indexAction()
  {


    // Verifica si ya votó el usuario
    $this->verifyResult();

    // Instancias de modelos necesarios
    $config_model = new Administracion_Model_DbTable_Configvotacion();
    $tarjetones_model = new Administracion_Model_DbTable_Tarjetones();
    $zonas_model = new Administracion_Model_DbTable_Zonas();
    $candidatosModel = new Administracion_Model_DbTable_Candidatos();

    // Obtiene la configuración de votación por defecto
    // $configVotacion = $config_model->getById(1);

    $votacionActual = $this->getVotacion();
    $configVotacion = $votacionActual['votacion'];



    //traer ID de la zona que se llama todas
    // $zonaTodas = $zonas_model->getList("zona = 'TODAS'")[0];
    // Obtiene los tarjetones disponibles para el usuario en función de su zona
    $tarjetones = $tarjetones_model->getList(
      " tarjeton_elecciones = '$configVotacion->id' AND tarjeton_estado = '1' ",
      "orden ASC"
    );


    $user = Session::getInstance()->get('user');
    $zonaUser = $user->zona;

    //validar que en todos los tarjetones hayan candidatos
    foreach ($tarjetones as $tarjeton) {
      $tarjetonFiltroPorZona = $tarjeton->tarjeton_zona;
      if ($tarjetonFiltroPorZona == 1) {
        $existenCandidatos = $candidatosModel->getList("candidato_tarjeton = '$tarjeton->tarjeton_id' AND zona = '$zonaUser'");
      } else {
        $existenCandidatos = $candidatosModel->getList("candidato_tarjeton = '$tarjeton->tarjeton_id'");
      }

      // Si no hay candidatos en este tarjetón, redirigir al login con error
      if (empty($existenCandidatos)) {
        Session::getInstance()->set('error_tarjeton', "No hay candidatos en el tarjetón {$tarjeton->tarjeton_nombre}, por favor contacte al administrador.");
        header("Location: /page/index/logout");
        exit;
      }
    }


    if (count($tarjetones) >= 1) {

      // Si hay más de un tarjetón disponible
      // Configura las variables de sesión para el proceso de votación
      Session::getInstance()->set('tarjetones', $tarjetones);
      Session::getInstance()->set('cantidadtarjetones', count($tarjetones));
      Session::getInstance()->set('tarjetonactual', $tarjetones[0]);
      Session::getInstance()->set('posicionvotacion', 0);

      // Inicializa un array de resumen
      $resumen = [];
      Session::getInstance()->set('resumen', $resumen);

      // Redirecciona al usuario a la página de votación
      header("Location: /page/step3/votacion");
    } else {
      // Si no hay tarjetones disponibles
      $this->_view->tarjeton = $this->template->errorTarjeton();
    }
  }



  public function votacionAction()
  {
    $this->_view->list_zonas = $this->getZona();
    $this->_view->posicionvotacion = Session::getInstance()->get('posicionvotacion');
    $this->_view->tarjeton = $this->template->getTarjetonesAll();
    /* $resumen = Session::getInstance()->get('resumen');
    echo "<pre>";
    print_r($resumen);
    echo "</pre>"; */
  }


  public function selectcandidatesAction()
  {

    $this->setLayout('blanco');

    // Instancias de modelos necesarios
    $tarjetonactual = Session::getInstance()->get('tarjetonactual');
    $tarjetonesAll = Session::getInstance()->get('tarjetones');
    $cantidadtarjetones = Session::getInstance()->get('cantidadtarjetones');
    $posicionvotacion = Session::getInstance()->get('posicionvotacion');
    $resumen = Session::getInstance()->get('resumen');


    $voto = $this->_getSanitizedParam('candidate');

    if ($voto && empty($_POST['candidates'])) {
      if (!isset($resumen[$tarjetonactual->tarjeton_id])) {
        $resumen[$tarjetonactual->tarjeton_id] = array();
      }

      // Limpiar el array antes de agregar el candidato al tarjetón
      $resumen[$tarjetonactual->tarjeton_id] = array($voto);
    }


    if (!empty($_POST['candidates']) && !$voto) {
      // Limpiar el array antes de agregar nuevos candidatos al tarjetón
      $resumen[$tarjetonactual->tarjeton_id] = array();

      foreach ($_POST['candidates'] as $cadidate) {
        $resumen[$tarjetonactual->tarjeton_id][] = $cadidate;
      }
    }


    // Actualiza la variable de sesión 'resumen'
    Session::getInstance()->set('resumen', $resumen);


    if (count($resumen) >= $cantidadtarjetones) {
      // Envía al resumen
      header("Location: /page/step4/resumen");
    } else {
      Session::getInstance()->set('posicionvotacion', $posicionvotacion + 1);
      Session::getInstance()->set('tarjetonactual', $tarjetonesAll[($posicionvotacion + 1)]);
      // $this->_view->tarjeton = $this->template->getTarjetonesAll();
      header("Location: /page/step3/votacion");
    }
  }


  // Controlador para retroceder en la selección de candidatos
  public function backselectionAction()
  {
    // Establecer el diseño de la vista
    $this->setLayout('blanco');

    // Obtener variables de sesión necesarias
    $tarjetonesAll = Session::getInstance()->get('tarjetones');
    $posicionvotacion = Session::getInstance()->get('posicionvotacion');
    if ($posicionvotacion != 0) {

      // Retroceder en la posición de votación
      Session::getInstance()->set('posicionvotacion', ($posicionvotacion - 1));

      // Actualizar el tarjetón actual con el anterior
      Session::getInstance()->set('tarjetonactual', $tarjetonesAll[($posicionvotacion - 1)]);

      // Redirigir a la página de votación
      header("Location: /page/step3/votacion");
    } else {
      header("Location: /");
    }
  }
}
