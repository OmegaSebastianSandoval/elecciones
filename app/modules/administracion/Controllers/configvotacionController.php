<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Controlador de Configvotacion que permite la  creacion, edicion  y eliminacion de los Configuraci&oacute;n del Sistema
 */

class Administracion_configvotacionController extends Administracion_mainController
{
  public $botonpanel = 7;
  /**
   * $mainModel  instancia del modelo de  base de datos Configuraci&oacute;n
   * @var modeloContenidos
   */
  public $mainModel;

  /**
   * $route  url del controlador base
   * @var string
   */
  protected $route;

  /**
   * $pages cantidad de registros a mostrar por pagina]
   * @var integer
   */
  protected $pages;

  /**
   * $namefilter nombre de la variable a la fual se le van a guardar los filtros
   * @var string
   */
  protected $namefilter;

  /**
   * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
   * @var string
   */
  protected $_csrf_section = "administracion_configvotacion";

  /**
   * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
   * @var string
   */
  protected $namepages;



  /**
   * Inicializa las variables principales del controlador configvotacion .
   *
   * @return void.
   */
  public function init()
  {
    $this->mainModel = new Administracion_Model_DbTable_Configvotacion();
    $this->namefilter = "parametersfilterconfigvotacion";
    $this->route = "/administracion/configvotacion";
    $this->namepages = "pages_configvotacion";
    $this->namepageactual = "page_actual_configvotacion";
    $this->_view->route = $this->route;
    if (Session::getInstance()->get($this->namepages)) {
      $this->pages = Session::getInstance()->get($this->namepages);
    } else {
      $this->pages = 20;
    }
    parent::init();
  }


  /**
   * Recibe la informacion y  muestra un listado de  Configuraci&oacute;n con sus respectivos filtros.
   *
   * @return void.
   */
  public function indexAction()
  {
    $title = "Administración de Configuraci&oacute;n";
    $this->getLayout()->setTitle($title);
    $this->_view->titlesection = $title;
    $this->filters();
    $this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
    $filters = (object)Session::getInstance()->get($this->namefilter);
    $this->_view->filters = $filters;
    $filters = $this->getFilter();
    $order = "id DESC";
    $list = $this->mainModel->getList($filters, $order);
    $amount = $this->pages;
    $page = $this->_getSanitizedParam("page");
    if (!$page && Session::getInstance()->get($this->namepageactual)) {
      $page = Session::getInstance()->get($this->namepageactual);
      $start = ($page - 1) * $amount;
    } else if (!$page) {
      $start = 0;
      $page = 1;
      Session::getInstance()->set($this->namepageactual, $page);
    } else {
      Session::getInstance()->set($this->namepageactual, $page);
      $start = ($page - 1) * $amount;
    }
    $this->_view->register_number = count($list);
    $this->_view->pages = $this->pages;
    $this->_view->totalpages = ceil(count($list) / $amount);
    $this->_view->page = $page;
    $this->_view->lists = $this->mainModel->getListPages($filters, $order, $start, $amount);
    $this->_view->csrf_section = $this->_csrf_section;

    $this->_view->errors = Session::getInstance()->get('errors');
    $this->_view->errors_warning = Session::getInstance()->get('errors_warning');
    Session::getInstance()->set('errors', '');
    Session::getInstance()->set('errors_warning', '');

    $this->_view->votacion_actual_error = Session::getInstance()->get("votacion_actual_error");
    Session::getInstance()->set("votacion_actual_error", "");
    $this->_view->votacion_actual_tipo = Session::getInstance()->get("votacion_actual_tipo");
    Session::getInstance()->set("votacion_actual_tipo", "");
  }

  /**
   * Genera la Informacion necesaria para editar o crear un  Configuraci&oacute;n  y muestra su formulario
   *
   * @return void.
   */
  public function manageAction()
  {
    $this->_view->route = $this->route;
    $this->_csrf_section = "manage_configvotacion_" . date("YmdHis");
    $this->_csrf->generateCode($this->_csrf_section);
    $this->_view->csrf_section = $this->_csrf_section;
    $this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
    $id = $this->_getSanitizedParam("id");
    if ($id > 0) {
      $content = $this->mainModel->getById($id);
      if ($content->id) {
        $this->_view->content = $content;
        $this->_view->routeform = $this->route . "/update";
        $title = "Actualizar Configuraci&oacute;n";
        $this->getLayout()->setTitle($title);
        $this->_view->titlesection = $title;
      } else {
        $this->_view->routeform = $this->route . "/insert";
        $title = "Crear Configuraci&oacute;n";
        $this->getLayout()->setTitle($title);
        $this->_view->titlesection = $title;
      }
    } else {
      $this->_view->routeform = $this->route . "/insert";
      $title = "Crear Configuraci&oacute;n";
      $this->getLayout()->setTitle($title);
      $this->_view->titlesection = $title;
    }
  }

  /**
   * Inserta la informacion de un Configuraci&oacute;n  y redirecciona al listado de Configuraci&oacute;n.
   *
   * @return void.
   */
  public function insertAction()
  {
    $this->setLayout('blanco');
    $csrf = $this->_getSanitizedParam("csrf");
    if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
      $data = $this->getData();
      $uploadDocument =  new Core_Model_Upload_Document();
      if ($_FILES['archivo']['name'] != '') {
        $data['archivo'] = $uploadDocument->upload("archivo");
      }
      if ($_FILES['archivo2']['name'] != '') {
        $data['archivo2'] = $uploadDocument->upload("archivo2");
      }
      $existeVotacionActual = $this->mainModel->getList("votacion_actual = 1");
      if ($existeVotacionActual && $data['votacion_actual'] == 1) {
        $data['votacion_actual'] = 0;
        Session::getInstance()->set("votacion_actual_tipo", "danger");
        Session::getInstance()->set("votacion_actual_error", "Ya existe una votación actual, por favor desactive la actual para poder activar esta votación.");
      } else {
        Session::getInstance()->set("votacion_actual_tipo", "success");
        Session::getInstance()->set("votacion_actual_error", "Votación actual actualizada correctamente.");
      }
      $id = $this->mainModel->insert($data);

      $data['id'] = $id;
      $data['log_log'] = print_r($data, true);
      $data['log_tipo'] = 'CREAR CONFIGURACI&OACUTE;N';
      $logModel = new Administracion_Model_DbTable_Log();
      $logModel->insert($data);
    }
    header('Location: ' . $this->route . '' . '');
  }

  /**
   * Recibe un identificador  y Actualiza la informacion de un Configuraci&oacute;n  y redirecciona al listado de Configuraci&oacute;n.
   *
   * @return void.
   */
  public function updateAction()
  {
    $this->setLayout('blanco');
    $csrf = $this->_getSanitizedParam("csrf");
    if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
      $id = $this->_getSanitizedParam("id");
      $content = $this->mainModel->getById($id);
      if ($content->id) {
        $data = $this->getData();
        $uploadDocument =  new Core_Model_Upload_Document();
        if ($_FILES['archivo']['name'] != '') {
          if ($content->archivo) {
            $uploadDocument->delete($content->archivo);
          }
          $data['archivo'] = $uploadDocument->upload("archivo");
        } else {
          $data['archivo'] = $content->archivo;
        }

        if ($_FILES['archivo2']['name'] != '') {
          if ($content->archivo2) {
            $uploadDocument->delete($content->archivo2);
          }
          $data['archivo2'] = $uploadDocument->upload("archivo2");
        } else {
          $data['archivo2'] = $content->archivo2;
        }
        $existeVotacionActual = $this->mainModel->getList("votacion_actual = 1");

        if ($existeVotacionActual && $data['votacion_actual'] == 1 && $existeVotacionActual[0]->id != $id) {
          $data['votacion_actual'] = 0;
          Session::getInstance()->set("votacion_actual_tipo", "danger");
          Session::getInstance()->set("votacion_actual_error", "Ya existe una votación actual, por favor desactive la actual para poder activar esta votación.");
        } else {
          Session::getInstance()->set("votacion_actual_tipo", "success");
          Session::getInstance()->set("votacion_actual_error", "Votación actual actualizada correctamente.");
        }
        $this->mainModel->update($data, $id);
      }
      $data['id'] = $id;
      $data['log_log'] = print_r($data, true);
      $data['log_tipo'] = 'EDITAR CONFIGURACI&OACUTE;N';
      $logModel = new Administracion_Model_DbTable_Log();
      $logModel->insert($data);
    }
    header('Location: ' . $this->route . '' . '');
  }

  /**
   * Recibe un identificador  y elimina un Configuraci&oacute;n  y redirecciona al listado de Configuraci&oacute;n.
   *
   * @return void.
   */
  public function deleteAction()
  {
    $this->setLayout('blanco');
    $csrf = $this->_getSanitizedParam("csrf");
    if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf) {
      $id =  $this->_getSanitizedParam("id");
      if (isset($id) && $id > 0) {
        $content = $this->mainModel->getById($id);
        if (isset($content)) {
          $uploadDocument =  new Core_Model_Upload_Document();
          if (isset($content->archivo) && $content->archivo != '') {
            $uploadDocument->delete($content->archivo);
          }

          if (isset($content->archivo2) && $content->archivo2 != '') {
            $uploadDocument->delete($content->archivo2);
          }
          $this->mainModel->deleteRegister($id);
          $data = (array)$content;
          $data['log_log'] = print_r($data, true);
          $data['log_tipo'] = 'BORRAR CONFIGURACI&OACUTE;N';
          $logModel = new Administracion_Model_DbTable_Log();
          $logModel->insert($data);
        }
      }
    }
    header('Location: ' . $this->route . '' . '');
  }

  /**
   * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Configvotacion.
   *
   * @return array con toda la informacion recibida del formulario.
   */
  private function getData()
  {
    $data = array();
    $data['votacion_titulo'] = $this->_getSanitizedParam("votacion_titulo");

    $data['fecha_inicio'] = $this->_getSanitizedParam("fecha_inicio");
    $data['fecha_final'] = $this->_getSanitizedParam("fecha_final");
    // $data['modo_candidatos'] = $this->_getSanitizedParam("modo_candidatos");

    if ($this->_getSanitizedParam("modo_candidatos") == '') {
      $data['modo_candidatos'] = '0';
    } else {
      $data['modo_candidatos'] = $this->_getSanitizedParam("modo_candidatos");
    }

    if ($this->_getSanitizedParam("votacion_mostrar_campo") == '') {
      $data['votacion_mostrar_campo'] = '0';
    } else {
      $data['votacion_mostrar_campo'] = $this->_getSanitizedParam("votacion_mostrar_campo");
    }

    $data['votacion_texto_campo'] = $this->_getSanitizedParam("votacion_texto_campo");


    if ($this->_getSanitizedParam("votacion_pedir_telefono") == '') {
      $data['votacion_pedir_telefono'] = '0';
    } else {
      $data['votacion_pedir_telefono'] = $this->_getSanitizedParam("votacion_pedir_telefono");
    }
    if ($this->_getSanitizedParam("votacion_actual") == '') {
      $data['votacion_actual'] = '0';
    } else {
      $data['votacion_actual'] = $this->_getSanitizedParam("votacion_actual");
    }

    $data['archivo'] = "";
    $data['archivo2'] = "";
    return $data;
  }
  /**
   * Genera la consulta con los filtros de este controlador.
   *
   * @return array cadena con los filtros que se van a asignar a la base de datos
   */
  protected function getFilter()
  {
    $filtros = " 1 = 1 ";
    if (Session::getInstance()->get($this->namefilter) != "") {
      $filters = (object)Session::getInstance()->get($this->namefilter);
      if ($filters->fecha_inicio != '') {
        $filtros = $filtros . " AND fecha_inicio LIKE '%" . $filters->fecha_inicio . "%'";
      }
      if ($filters->fecha_final != '') {
        $filtros = $filtros . " AND fecha_final LIKE '%" . $filters->fecha_final . "%'";
      }
    }
    return $filtros;
  }

  /**
   * Recibe y asigna los filtros de este controlador
   *
   * @return void
   */
  protected function filters()
  {
    if ($this->getRequest()->isPost() == true) {
      Session::getInstance()->set($this->namepageactual, 1);
      $parramsfilter = array();
      $parramsfilter['fecha_inicio'] =  $this->_getSanitizedParam("fecha_inicio");
      $parramsfilter['fecha_final'] =  $this->_getSanitizedParam("fecha_final");
      Session::getInstance()->set($this->namefilter, $parramsfilter);
    }
    if ($this->_getSanitizedParam("cleanfilter") == 1) {
      Session::getInstance()->set($this->namefilter, '');
      Session::getInstance()->set($this->namepageactual, 1);
    }
  }
  public function editarzonasAction()
  {
    $title = "Importar Zonas";
    $this->getLayout()->setTitle($title);
    $this->_view->titlesection = $title;
    $this->_view->votacion = $votacion = $this->_getSanitizedParam("id");
  }
  public function updatezonasAction()
  {
    $uploadDocument =  new Core_Model_Upload_Document();
    if ($_FILES['archivo']['name'] != '') {
      $archivo = $uploadDocument->upload("archivo");
    }
    $votacion = $this->_getSanitizedParam("votacion");
    $inputFileName = FILE_PATH . $archivo;
    $spreadsheet = IOFactory::load($inputFileName);
    $infoexel = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    $zonasModel = new Administracion_Model_DbTable_Zonas();
    $zonasVotacion = $zonasModel->getList("votacion = '$votacion'");
    foreach ($zonasVotacion as $zona) {
      $zonasModel->deleteRegister($zona->id);
    }
    // $zonasModel->deleteAll();

    $zonas = $this->getZonasByName();


    for ($i = 0; $i <= count($infoexel); $i++) {
      $fila = $infoexel[$i];
      $data['zona'] = trim($fila['A']);
      $data['elegidos'] = trim($fila['B']);
      $data['votacion'] = $votacion;


      if (
        $data['zona'] != '' &&
        $data['zona'] != 'ZONA' &&
        $data['elegidos'] != 'ELEGIDOS'
      ) {
        $insert_id = $zonasModel->insert($data);
      }
    }
    if ($insert_id) {
      Session::getInstance()->set("votacion_actual_tipo", "success");
      Session::getInstance()->set("votacion_actual_error", "Zonas actualizadas correctamente.");
      header('Location: /administracion/configvotacion?success=1');
    } else {
      Session::getInstance()->set("votacion_actual_tipo", "danger");
      Session::getInstance()->set("votacion_actual_error", "Error al actualizar las zonas.");
      header('Location: /administracion/configvotacion?error=1');
    }
  }
  public function editardelegadosAction()
  {
    $title = "Lista de Delegados";
    $this->getLayout()->setTitle($title);
    $this->_view->titlesection = $title;
    $this->_view->votacion = $votacion = $this->_getSanitizedParam("id");
  }

  public function updatedelegadosAction()
  {
    $uploadDocument =  new Core_Model_Upload_Document();
    if ($_FILES['archivo']['name'] != '') {
      $archivo = $uploadDocument->upload("archivo");
    }
    $votacion = $this->_getSanitizedParam("votacion");

    $inputFileName = FILE_PATH . $archivo;
    $spreadsheet = IOFactory::load($inputFileName);
    $infoexel = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    $candidatos_model = new Administracion_Model_DbTable_Candidatos();
    // $candidatos_model->deleteAll();

    $zonas = $this->getZonasByName();


    for ($i = 0; $i <= count($infoexel); $i++) {
      $fila = $infoexel[$i];
      $data['numero'] = trim($fila['A']);
      $data['nombre'] = trim($fila['B']);
      $data['suplente'] = trim($fila['C']);
      $data['zona'] =  $zonas[$fila['D']] ?? null;
      // $data['zona'] = trim($fila['D']);
      $data['detalle'] = trim($fila['E']);
      $data['candidato_tarjeton'] = trim($fila['F']);
      $data['votacion'] = $votacion;
      $data['cedula'] = trim($fila['G']);
      $data['foto'] = trim($fila['H']);
      $data['lista'] = trim($fila['I']);

      if (
        $data['numero'] != '' &&
        $data['nombre'] != '' &&
        $data['nombre'] != 'Nombres' &&
        $data['zona'] != 0
      ) {
        $insert_id = $candidatos_model->insert($data);
      }
    }
    if ($insert_id) {
      Session::getInstance()->set("votacion_actual_tipo", "success");
      Session::getInstance()->set("votacion_actual_error", "Candidatos actualizados correctamente.");
      header('Location: /administracion/configvotacion');
    } else {
      Session::getInstance()->set("votacion_actual_tipo", "danger");
      Session::getInstance()->set("votacion_actual_error", "Error al actualizar los candidatos.");
      header('Location: /administracion/configvotacion?error=1');
    }
  }

  public function editarusuariosAction()
  {
    $title = "Lista de Usuarios Habilitados";
    $this->getLayout()->setTitle($title);
    $this->_view->titlesection = $title;
    $this->_view->votacion = $votacion = $this->_getSanitizedParam("id");
    //  session_destroy();

  }


  public function updateusuariosAction()
  {
    // error_reporting(E_ALL);
    // $this->setLayout('blanco');

    $uploadDocument = new Core_Model_Upload_Document();


    $campoinicial = $this->_getSanitizedParam("inicio") ?? 0;

    $this->_view->votacion = $votacion = $this->_getSanitizedParam("votacion");







    if (!empty($_FILES['archivo2']['name']) && ($campoinicial == 0 || $campoinicial == null || $campoinicial == '')) {

      $archivo = $uploadDocument->upload("archivo2");
      $inputFileName = FILE_PATH . $archivo;
      Session::getInstance()->set("inputFileName", $inputFileName);
      $arrayErrors = [];

      $arrayErrorsWarning = [];

      $sessionErrors = Session::getInstance()->get('errors');

      // Asegurarse de que siempre sea un array
      $sessionErrors = is_array($sessionErrors) ? $sessionErrors : [];

      $arrayErrors = array_merge($sessionErrors, $arrayErrors);
      Session::getInstance()->set('errors', $arrayErrors);


      $sessionErrorsWarning = Session::getInstance()->get('errors_warning');
      $sessionErrorsWarning = is_array($sessionErrorsWarning) ? $sessionErrorsWarning : [];

      $arrayErrorsWarning = array_merge($sessionErrorsWarning, $arrayErrorsWarning);
      Session::getInstance()->set('errors_warning', $arrayErrorsWarning);


      try {
        $spreadsheet = IOFactory::load($inputFileName);
        $infoExcel = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        Session::getInstance()->set("infocargaexcel", $infoExcel);
        $usuariosModel = new Administracion_Model_DbTable_Usuarioselecciones();
        $usuariosModel->deleteAllByVotacion($votacion);
      } catch (\Exception $e) {
        $arrayErrors[] = "Error al leer el archivo Excel: " . $e->getMessage();
        Session::getInstance()->set('errors', $arrayErrors);
        header('Location: /administracion/configvotacion');
        exit;
      }
    } else {

      $infoExcel = Session::getInstance()->get("infocargaexcel");
    }

    if (!$infoExcel) {
      $arrayErrors[] = "No hay datos en la sesión para procesar.";
      Session::getInstance()->set('errors', $arrayErrors);
      header('Location: /administracion/configvotacion');
      exit;
    }

    $total = count($infoExcel);
    $campoinicial = intval($campoinicial);
    if ($campoinicial + 100 >= $total) {
			$campofinal = $total;
		} else {
			$campofinal = $campoinicial + 100;
		}
   

    $this->_view->campoinicial = $campoinicial;
    $this->_view->campofinal = $campofinal;

    $zonas = $this->getZonasByName();
    $usuariosModel = new Administracion_Model_DbTable_Usuarioselecciones();
    echo "campoinicial: $campoinicial, campofinal: $campofinal, total: $total <br>";

    for ($i = $campoinicial; $i <= $campofinal; $i++) {
      $fila = $infoExcel[$i];
      $cedula = $this->cleanField(trim($fila['A']));
      $contraseña = trim($fila['B']);

      $nombre = trim($fila['C']);
      $correo = trim($fila['D']);
      $zona = $zonas[trim($fila['E'])] ?? null;
      $activo = trim($fila['F']);
      $estado = trim($fila['G']);

      $celular = trim($fila['H']);

      /*  if (
        empty($cedula) ||
        $cedula == '0'
        ||
         empty($correo) ||
        $correo == '0'
      ) {
        continue;
      }; */
      if (
        empty($cedula) ||
        $cedula == '0'
      ) {
        continue;
      };
      /* if (empty($celular) || !preg_match('/^\d{10}$/', $celular)) {
        $arrayErrorsWarning[] = "El usuario con cédula {$cedula} tiene un número de celular inválido.";
      }
 */

      $usuarioExistCedula = $usuariosModel->getList("cedula = '{$cedula}' AND votacion = '{$votacion}'");
      // $usuarioExistCorreo = $usuariosModel->getList("correo = '{$correo}' AND votacion = '{$votacion}'");
      /* if (
        count($usuarioExistCedula) > 0 ||
        count($usuarioExistCorreo) > 0
      ) */
      if (
        count($usuarioExistCedula) > 0
      ) {
       /*  echo "<pre>";
        print_r($usuarioExistCedula);
        echo "</pre>";

        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo $cedula;
        echo "<br>";
        echo "<br>";
        echo $nombre;


        return; */
        $arrayErrors[] = "Conflicto con cédula para el usuario {$nombre}.";
        continue;
      }



      if ($cedula != '0' || $cedula != '' || $cedula != null) {
        $idUserNew = $usuariosModel->insert([
          'cedula' => $cedula,
          'clave' => "",
          'nombre' => $nombre,
          'correo' => $correo,
          'zona' => $zona,
          'activo' => $activo,
          'estado' => $estado,
          'celular' => $celular,
          'votacion' => $votacion,
          'carga_masiva' => 1
        ]);

        if (!$idUserNew) {
          echo "Error al insertar usuario con cédula: $cedula <br>";
        }
      }
    }


    if (!empty($arrayErrors)) {
      Session::getInstance()->set('errors', $arrayErrors);
      Session::getInstance()->set('errors_warning', $arrayErrorsWarning);
    }

    if ($campoinicial + 100 >= $total) {
      $this->_view->rute = '/administracion/configvotacion?error=';
    } else {
      $this->_view->rute = "/administracion/configvotacion/updateusuarios?inicio=" . ($campofinal + 1);
    }

    /* if ($campofinal < $total) {
      header("Location: /administracion/configvotacion/updateusuarios?inicio=$campofinal");
    } else {
      header('Location: /administracion/configvotacion');
    }
    exit; */
  }

  public function updateusuariosOLDAction()
  {
    error_reporting(E_ALL);
    $uploadDocument = new Core_Model_Upload_Document();
    $arrayErrors = [];
    $arrayErrorsWarning = [];

    // Verifica si se subió un archivo
    if (!empty($_FILES['archivo2']['name'])) {
      $archivo = $uploadDocument->upload("archivo2");
    } else {
      $arrayErrors[] = "No se ha subido ningún archivo.";
      Session::getInstance()->set('errors', $arrayErrors);
      header('Location: /administracion/configvotacion');
      exit;
    }

    $inputFileName = FILE_PATH . $archivo;

    // Carga el archivo Excel
    try {
      $spreadsheet = IOFactory::load($inputFileName);
    } catch (\Exception $e) {
      $arrayErrors[] = "Error al leer el archivo Excel: " . $e->getMessage();
      Session::getInstance()->set('errors', $arrayErrors);
      header('Location: /administracion/configvotacion');
      exit;
    }

    $infoExcel = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    $usuariosModel = new Administracion_Model_DbTable_Usuarioselecciones();
    $usuariosModel->deleteAll();

    $zonas = $this->getZonasByName();

    foreach ($infoExcel as $fila) {
      $cedula = $this->cleanField($fila['A']);
      $nombre = trim($fila['B']);
      $correo = trim($fila['C']);
      $zona = $zonas[$fila['D']] ?? null;
      $celular = trim($fila['E']);

      // Validaciones
      if (empty($cedula) || $cedula == '0') {
        continue; // Si la cédula no es válida, salta esta iteración
      }

      if (empty($correo) || $correo == '0') {
        $arrayErrors[] = "El usuario con cédula {$cedula} y nombre {$nombre} no tiene correo, solucione el problema y vuelva a cargar el archivo.";
        continue;
      }

      if (empty($celular) || !preg_match('/^\d{10}$/', $celular)) {
        $arrayErrorsWarning[] = "El usuario con cédula {$cedula} y nombre {$nombre} tiene un número de celular inválido ({$celular}). Debe contener exactamente 10 dígitos.";
        // continue;
      }

      $usuarioExistCedula = $usuariosModel->getList("cedula = '{$cedula}'");
      $usuarioExistCorreo = $usuariosModel->getList("correo = '{$correo}'");

      if (count($usuarioExistCedula) > 0) {
        $arrayErrors[] = "El usuario con cédula {$cedula} y nombre {$nombre} tiene la misma cédula que {$usuarioExistCedula[0]->nombre} CC {$usuarioExistCedula[0]->cedula}. Solucione el problema y vuelva a cargar el archivo.";
        continue;
      }

      if (count($usuarioExistCorreo) > 0) {
        $arrayErrors[] = "El usuario con cédula {$cedula} y nombre {$nombre} tiene el mismo correo {$correo} que {$usuarioExistCorreo[0]->nombre} CC {$usuarioExistCorreo[0]->cedula}. Solucione el problema y vuelva a cargar el archivo.";
        continue;
      }

      // Insertar usuario si pasa todas las validaciones
      $usuariosModel->insert([
        'cedula' => $cedula,
        'clave' => "", // Puedes cambiar esto según sea necesario
        'nombre' => $nombre,
        'correo' => $correo,
        'zona' => $zona,
        'activo' => 1,
        'estado' => 0, //Sin votar
        'celular' => $celular,
        'carga_masiva' => 1
      ]);
    }

    // Guarda los errores en sesión si existen
    if (!empty($arrayErrors)) {
      Session::getInstance()->set('errors', $arrayErrors);
      Session::getInstance()->set('errors_warning', $arrayErrorsWarning);
    }

    header('Location: /administracion/configvotacion');
    exit;
  }


  function cleanField($field)
  {
    //delete points and commas
    $field = str_replace(".", "", $field);
    $field = str_replace(",", "", $field);
    $field = str_replace(" ", "", $field);
    $field = str_replace("-", "", $field);
    $field  = intval($field);
    return $field;
  }

  function generateRamdonPassword($length = 6)
  {
    $number = "1234567890";
    $password = substr(str_shuffle($number), 0, $length);
    return $password;
  }

  function getZonasByName()
  {
    $zonasModel = new Administracion_Model_DbTable_Zonas();
    $zonas = $zonasModel->getList("");
    $zonasArray = array();
    foreach ($zonas as $zona) {
      $zonasArray[$zona->zona] = $zona->id;
    }
    return $zonasArray;
  }
}
