<?php

/**
 *
 */

class Page_step4Controller extends Page_mainController
{
  public $header_step = 4;

  public function init()
  {
    $this->verifyResult();

    parent::init();
  }

  public function indexAction()
  {
    // Verifica que no haya votado
    $this->verifyResult();


    // Instancia de modelos necesarios
    $candidatos_model = new Administracion_Model_DbTable_Candidatos();
    // $config_model = new Administracion_Model_DbTable_Configvotacion();
    $zonasModel = new Administracion_Model_DbTable_Zonas();

    // Obtiene la información del usuario de la sesión
    $this->_view->user_info = $user_info = Session::getInstance()->get('user');
    $this->_view->tarjeton = $tarjeton = Session::getInstance()->get('tarjeton');
    $this->_view->list_zonas = $this->getZona();
    // $this->_view->config = $config_model->getById(1);
    $votacionActual = $this->getVotacion();

    $this->_view->config = $votacionActual['votacion'];





    // Obtiene el ID del candidato de la solicitud
    $candidate_id = $this->_getSanitizedParam('c');

    // Si hay un ID de candidato y no hay selecciones en el formulario
    if ($candidate_id && empty($_POST['candidates'])) {
      // Configura la vista con la información del candidato y la configuración
      $this->_view->candidate_id = $candidate_id;
      $this->_view->candidate = $candidatos_model->getById($candidate_id);
    }

    // Si hay selecciones en el formulario y no hay un ID de candidato
    if (!empty($_POST['candidates']) && !$candidate_id) {
      // Recorre las selecciones y obtiene la información de cada candidato
      foreach ($_POST['candidates'] as $check) {
        $candidates[$check] = $candidatos_model->getById($check);
      }

      // Configura la vista con la información de los candidatos y la opción de mostrar fotos en el tarjetón
      $this->_view->tarjetonForma = $this->_getSanitizedParam('mostrar-fotos');
      $this->_view->candidates = $candidates;
    }

    // Obtiene la información de la zona del usuario y la configura en la vista
    $this->_view->zonaInfo = $zonasModel->getById($user_info->zona);
  }


  public function copiaAction()
  {
    $this->setLayout('blanco');
    $resultadosModel = new Administracion_Model_DbTable_Resultados();
    $this->_view->resultados  = $resultadosModel->getList("consecutivo = '11'")[0];
    $this->_view->user_info = $user_info = Session::getInstance()->get('user');
  }

  public function resumenAction()
  {
    // Verifica que no haya votado
    $this->verifyResult();
    $candidatos_model = new Administracion_Model_DbTable_Candidatos();
    // $config_model = new Administracion_Model_DbTable_Configvotacion();
    $zonasModel = new Administracion_Model_DbTable_Zonas();
    $tarjetones_model = new Administracion_Model_DbTable_Tarjetones();



    // Instancias de modelos necesarios
    $tarjetonactual = Session::getInstance()->get('tarjetonactual');
    $resumen = Session::getInstance()->get('resumen');
    $this->_view->list_zonas = $this->getZona();
    // $this->_view->config = $config_model->getById(1);
    $votacionActual = $this->getVotacion();

    $this->_view->config = $votacionActual['votacion'];





    $this->_view->user_info = $user_info = Session::getInstance()->get('user');
    $this->_view->tarjeton = $tarjetonactual;
    $this->_view->zonaInfo = $zonasModel->getById($user_info->zona);
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
  }
  public function saveselectionmultipleAction()
  {
    $this->setLayout('blanco');

    // Verifica que no haya votado
    $this->verifyResult();
    // Arreglo para almacenar los datos
    $data = array();

    // Instancia del modelo de resultados
    $resultados_model = new Administracion_Model_DbTable_Resultados();
    $candidatos_model = new Administracion_Model_DbTable_Candidatos();
    $tarjetones_model = new Administracion_Model_DbTable_Tarjetones();
    $votacionActual = $this->getVotacion();

    $votacionId = $votacionActual['votacion']->id;



    // Verifica si ya hay resultados para el usuario actual
    $verify_resultados = $resultados_model->getList("usuario = '" . Session::getInstance()->get('user')->id . "'", "")[0];

    if (!$verify_resultados) {
      $resumen = Session::getInstance()->get('resumen');
      $data['consecutivo'] = $this->getConsecutivo();

      foreach ($resumen as $tarjetonId => $candidatosIds) {

        foreach ($candidatosIds as $candidatoId) {
          $candidato = $candidatos_model->getById($candidatoId);
          // Agregar la información del candidato al array de candidatos
          $infoTarjeton['candidatos'][] = $candidato;

          $data['candidato'] = $candidatoId;
          $data['tarjeton'] = $tarjetonId;
          $data['votacion	'] = $votacionId;


          $data['usuario'] = Session::getInstance()->get('user')->id;
          $data['fecha'] = date('Y-m-d H:i:s');
          $data['ip'] = $_SERVER['REMOTE_ADDR'];
          $data['isp'] = $_SERVER['HTTP_USER_AGENT'];
          $data['zona'] =  Session::getInstance()->get('user')->zona;
          $data['opinion'] = $this->_getSanitizedParam('comentarios');


          // Inserta los datos en la tabla de resultados
          if ($data['usuario']) {
            $resultados_model->insert($data);
          }
        }
      }
    }


    $res['status'] = 'error'; // Establecer el valor predeterminado como 'error'

    $mailModel = new Core_Model_Sendingemail($this->_view);
    $mailModelRespaldo = new Core_Model_Sendingemail2($this->_view);

    $resEmail = $mailModel->sendConfirmMultipleVote($data['consecutivo']);

    if ($resEmail == 1) {
      $res['status'] = 'ok';
      header('Location: /page/step5/?res=' . $res['status']);
      return;
    }

    if ($mailModelRespaldo->sendConfirmMultipleVote($data['consecutivo']) == 1) {
      $res['status'] = 'ok';
    } else {
      $res['status'] = 'error';
    }

    header('Location: /page/step5/?res=' . $res['status']);
    // Puedes eliminar la segunda asignación $res['status'] = 'error'; ya que es redundante.


    // Redirecciona a la página de la siguiente etapa del proceso

  }


  /*   public function correoDELETEAction()
  {

    $this->setLayout('blanco');

    $candidatos_model = new Administracion_Model_DbTable_Candidatos();
    $config_model = new Administracion_Model_DbTable_Configvotacion();
    $zonasModel = new Administracion_Model_DbTable_Zonas();
    $tarjetones_model = new Administracion_Model_DbTable_Tarjetones();



    // Instancias de modelos necesarios
    $tarjetonactual = Session::getInstance()->get('tarjetonactual');
    $tarjetonesAll = Session::getInstance()->get('tarjetones');
    $cantidadtarjetones = Session::getInstance()->get('cantidadtarjetones');
    $posicionvotacion = Session::getInstance()->get('posicionvotacion');
    $resumen = Session::getInstance()->get('resumen');



    $this->_view->config = $config_model->getById(1);
    $this->_view->user_info = $user_info = Session::getInstance()->get('user');
    $this->_view->tarjeton = $tarjetonactual;
    $this->_view->zonaInfo = $zonasModel->getById($user_info->zona);
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
  } */

  /**
   * Obtiene y devuelve el siguiente consecutivo a utilizar.
   *
   * @return int El siguiente consecutivo.
   */
  public function getConsecutivo()
  {
    // Crear una instancia del modelo de resultados
    $resultados_model = new Administracion_Model_DbTable_Resultados();

    // Obtener el último registro de la lista de resultados
    $ultimoRegistro = $resultados_model->getList("", "id DESC")[0];

    // Obtener el valor del consecutivo del último registro
    $consecutivo = $ultimoRegistro->consecutivo ?? 0;

    // Incrementar el consecutivo si existe, de lo contrario, establecerlo en 0
    $consecutivo = $consecutivo + 1;

    // Devolver el consecutivo obtenido
    return $consecutivo;
  }
}
