<?php

/**
 * Controlador de Tarjetones que permite la  creacion, edicion  y eliminacion de los tarjet&oacute;n del Sistema
 */

use PhpOffice\PhpSpreadsheet\IOFactory;

class Administracion_tarjetonesController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos tarjet&oacute;n
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
	protected $_csrf_section = "administracion_tarjetones";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;

	protected $namepageactual;
	protected $votacion;
	protected $tarjeton;


	/**
	 * Inicializa las variables principales del controlador tarjetones .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Tarjetones();
		$this->namefilter = "parametersfiltertarjetones";
		$this->route = "/administracion/tarjetones";
		$this->namepages = "pages_tarjetones";
		$this->namepageactual = "page_actual_tarjetones";
		$this->_view->route = $this->route;
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		$votacion = $this->_getSanitizedParam("votacion");
		$this->votacion = $votacion;
		$this->_view->votacion = $votacion;
		$tarjeton = $this->_getSanitizedParam("tarjeton");
		$this->tarjeton = $tarjeton;
		$this->_view->tarjeton = $tarjeton;
		parent::init();
	}


	/**
	 * Recibe la informacion y  muestra un listado de  tarjet&oacute;n con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		$title = "Administración de tarjet&oacute;n";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object)Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "orden ASC";
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
		$this->_view->eleccion = $this->_getSanitizedParam("eleccion");
		$this->_view->list_zona = $this->getZona();
		$this->_view->votacion_actual_error = Session::getInstance()->get("votacion_actual_error");
		Session::getInstance()->set("votacion_actual_error", "");
		$this->_view->votacion_actual_tipo = Session::getInstance()->get("votacion_actual_tipo");
		Session::getInstance()->set("votacion_actual_tipo", "");
	}

	/**
	 * Genera la Informacion necesaria para editar o crear un  tarjet&oacute;n  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_tarjetones_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->list_zona = $this->getZona();

		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->eleccion = $this->_getSanitizedParam("eleccion");
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if ($content->tarjeton_id) {
				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar tarjet&oacute;n";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear tarjet&oacute;n";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear tarjet&oacute;n";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
	 * Inserta la informacion de un tarjet&oacute;n  y redirecciona al listado de tarjet&oacute;n.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$data = $this->getData();

			$id = $this->mainModel->insert($data);
			if ($data["tarjeton_voto_blanco"] == 1) {
				$this->crearVotosBlanco($data["tarjeton_elecciones"], $id, $data["tarjeton_zona"]);
			}
			$this->mainModel->changeOrder($id, $id);
			$data['tarjeton_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'CREAR TARJET&OACUTE;N';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$eleccion = $this->_getSanitizedParam("tarjeton_elecciones");
		header('Location: ' . $this->route . '?eleccion=' . $eleccion . '');
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un tarjet&oacute;n  y redirecciona al listado de tarjet&oacute;n.
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
			if ($content->tarjeton_id) {
				$data = $this->getData();

				$this->mainModel->update($data, $id);
				if (
					($data["tarjeton_voto_blanco"] == 1 &&
						$content->tarjeton_voto_blanco == 0) ||
					($data["tarjeton_zona"] !=	$content->tarjeton_zona)
				) {
					$this->crearVotosBlanco($data["tarjeton_elecciones"], $id, $data["tarjeton_zona"]);
				}

				if (
					$data["tarjeton_voto_blanco"] == 0 &&
					$content->tarjeton_voto_blanco == 1
				) {
					$this->deleteVotosBlanco($data["tarjeton_elecciones"], $id);
				}
			}
			$data['tarjeton_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'EDITAR TARJET&OACUTE;N';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$eleccion = $this->_getSanitizedParam("tarjeton_elecciones");
		header('Location: ' . $this->route . '?eleccion=' . $eleccion . '');
	}

	/**
	 * Recibe un identificador  y elimina un tarjet&oacute;n  y redirecciona al listado de tarjet&oacute;n.
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
					$this->mainModel->deleteRegister($id);
					$data = (array)$content;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = 'BORRAR TARJET&OACUTE;N';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}
		$eleccion = $this->_getSanitizedParam("eleccion");
		header('Location: ' . $this->route . '?eleccion=' . $eleccion . '');
	}


	public function crearVotosBlanco($votacion, $tarjeton, $filtroZona)
	{
		$this->deleteVotosBlanco($votacion, $tarjeton);
		$candidatosModel = new Administracion_Model_DbTable_Candidatos();
		$zonasModel = new Administracion_Model_DbTable_Zonas();
		$zonas = $zonasModel->getList("votacion = '$votacion'", "");

		$candidatos = $candidatosModel->getList("candidato_tarjeton = '$tarjeton' AND votacion = '$votacion'", "");

		$numerosCandidatos = [];
		foreach ($candidatos as $candidato) {
			$numerosCandidatos[] = $candidato->numero;
		}

		$numeroParaVotoBlanco = $numeroParaVotoBlanco = (empty($numerosCandidatos)) ? 1 : (max($numerosCandidatos) + 1);

		switch ($filtroZona) {
			case '1':
				foreach ($zonas as $zona) {
					$data['numero'] = $numeroParaVotoBlanco;
					$data['nombre'] = 'VOTO EN BLANCO';
					$data['suplente'] = '';
					$data['zona'] = $zona->id;
					$data['detalle'] = 'VOTO EN BLANCO';
					$data['candidato_tarjeton'] = $tarjeton;
					$data['votacion'] = $votacion;
					$data['cedula'] = '';
					$data['foto'] = '';
					$data['lista'] = '';
					$candidatosModel->insert($data);
					$numeroParaVotoBlanco++;
				}
				break;

			case '0':
				$data['numero'] = $numeroParaVotoBlanco;
				$data['nombre'] = 'VOTO EN BLANCO';
				$data['suplente'] = '';
				$data['zona'] = 0;
				$data['detalle'] = 'VOTO EN BLANCO';
				$data['candidato_tarjeton'] = $tarjeton;
				$data['votacion'] = $votacion;
				$data['cedula'] = '';
				$data['foto'] = '';
				$data['lista'] = '';
				$candidatosModel->insert($data);
				break;
		}
	}


	public function deleteVotosBlanco($votacion, $tarjeton)
	{
		$candidatosModel = new Administracion_Model_DbTable_Candidatos();
		$candidatos = $candidatosModel->getList("candidato_tarjeton = '$tarjeton' AND votacion = '$votacion'", "");
		foreach ($candidatos as $candidato) {
			if ($candidato->nombre == 'VOTO EN BLANCO') {
				$candidatosModel->deleteRegister($candidato->id);
			}
		}
	}
	public function editardelegadosAction()
	{
		$title = "Lista de Delegados";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->_view->votacion = $this->_getSanitizedParam("votacion");
		$this->_view->tarjeton  = $this->_getSanitizedParam("tarjeton");
	}

	public function updatedelegadosAction()
	{
		$uploadDocument =  new Core_Model_Upload_Document();
		$tarjetonModel = new Administracion_Model_DbTable_Tarjetones();
		if ($_FILES['archivo']['name'] != '') {
			$archivo = $uploadDocument->upload("archivo");
		}
		$votacion = $this->_getSanitizedParam("votacion");
		$tarjeton = $this->_getSanitizedParam("tarjeton");

		$tarjetonInfo = $tarjetonModel->getById($tarjeton);

		$inputFileName = FILE_PATH . $archivo;
		$spreadsheet = IOFactory::load($inputFileName);
		$infoexel = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

		$candidatos_model = new Administracion_Model_DbTable_Candidatos();
		$candidatosTarjeton = $candidatos_model->getList("candidato_tarjeton = '$tarjeton' AND votacion = '$votacion'", "");
		if ($candidatosTarjeton) {
			foreach ($candidatosTarjeton as $candidato) {
				$candidatos_model->deleteRegister($candidato->id);
			}
		}
		// $candidatos_model->deleteAll();

		$zonas = $this->getZonasByName($this->votacion);


		for ($i = 0; $i <= count($infoexel); $i++) {
			$fila = $infoexel[$i];
			$data['numero'] = trim($fila['A']);
			$data['nombre'] = trim($fila['B']);
			$data['suplente'] = trim($fila['C']);
			$data['zona'] =  $zonas[$fila['D']] ?? null;
			// $data['zona'] = trim($fila['D']);
			$data['detalle'] = trim($fila['E']);
			// $data['candidato_tarjeton'] = trim($fila['F']);
			$data['candidato_tarjeton'] = $tarjeton;
			$data['votacion'] = $votacion;
			$data['cedula'] = trim($fila['G']);
			$data['foto'] = trim($fila['H']);
			$data['lista'] = trim($fila['I']);
			$candidatoExistente = $candidatos_model->getList(" numero = '" . $data['numero'] . "' AND votacion = '$votacion' AND candidato_tarjeton = '$tarjeton'", "");
			if ($candidatoExistente) {
				Session::getInstance()->set("votacion_actual_tipo", "danger");
				Session::getInstance()->set("votacion_actual_error", "Error al actualizar los candidatos.");
				header('Location: /administracion/tarjetones/index/?eleccion=' . $votacion);
			}
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
			$this->crearVotosBlanco($votacion, $tarjeton, $tarjetonInfo->tarjeton_zona);
			Session::getInstance()->set("votacion_actual_tipo", "success");
			Session::getInstance()->set("votacion_actual_error", "Candidatos actualizados correctamente.");
			header('Location: /administracion/tarjetones/index/?eleccion=' . $votacion);
		} else {
			Session::getInstance()->set("votacion_actual_tipo", "danger");
			Session::getInstance()->set("votacion_actual_error", "Error al actualizar los candidatos.");
			header('Location: /administracion/tarjetones/index/?eleccion=' . $votacion);
		}
	}



	/**
	 * Genera los valores del campo Zona.
	 *
	 * @return array cadena con los valores del campo Zona.
	 */
	private function getZona()
	{
		$modelData = new Administracion_Model_DbTable_Zonas();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->id] = $value->zona;
		}
		return $array;
	}

	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Tarjetones.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		if ($this->_getSanitizedParam("tarjeton_estado") == '') {
			$data['tarjeton_estado'] = '0';
		} else {
			$data['tarjeton_estado'] = $this->_getSanitizedParam("tarjeton_estado");
		}
		$data['tarjeton_nombre'] = $this->_getSanitizedParam("tarjeton_nombre");
		if ($this->_getSanitizedParam("tarjeton_cantidad_votos") == '') {
			$data['tarjeton_cantidad_votos'] = '0';
		} else {
			$data['tarjeton_cantidad_votos'] = $this->_getSanitizedParam("tarjeton_cantidad_votos");
		}
		$data['tarjeton_elecciones'] = $this->_getSanitizedParamHtml("tarjeton_elecciones");
		if ($this->_getSanitizedParam("tarjeton_mostrar_detalle") == '') {
			$data['tarjeton_mostrar_detalle'] = '0';
		} else {
			$data['tarjeton_mostrar_detalle'] = $this->_getSanitizedParam("tarjeton_mostrar_detalle");
		}
		if ($this->_getSanitizedParam("tarjeton_mostrar_suplente") == '') {
			$data['tarjeton_mostrar_suplente'] = '0';
		} else {
			$data['tarjeton_mostrar_suplente'] = $this->_getSanitizedParam("tarjeton_mostrar_suplente");
		}
		if ($this->_getSanitizedParam("tarjeton_mostrar_fotos") == '') {
			$data['tarjeton_mostrar_fotos'] = '0';
		} else {
			$data['tarjeton_mostrar_fotos'] = $this->_getSanitizedParam("tarjeton_mostrar_fotos");
		}
		if ($this->_getSanitizedParam("tarjeton_zona") == '') {
			$data['tarjeton_zona'] = '0';
		} else {
			$data['tarjeton_zona'] = $this->_getSanitizedParam("tarjeton_zona");
		}

		if ($this->_getSanitizedParam("tarjeton_voto_blanco") == '') {
			$data['tarjeton_voto_blanco'] = '0';
		} else {
			$data['tarjeton_voto_blanco'] = $this->_getSanitizedParam("tarjeton_voto_blanco");
		}
		$data['tarjeton_descripcion'] = $this->_getSanitizedParamHtml("tarjeton_descripcion");
		$data['tarjeton_titulo'] = $this->_getSanitizedParam("tarjeton_titulo");

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
		$eleccion = $this->_getSanitizedParam("eleccion");
		$filtros = $filtros . " AND tarjeton_elecciones = '$eleccion' ";
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object)Session::getInstance()->get($this->namefilter);
			if ($filters->tarjeton_estado != '') {
				$filtros = $filtros . " AND tarjeton_estado LIKE '%" . $filters->tarjeton_estado . "%'";
			}
			if ($filters->tarjeton_nombre != '') {
				$filtros = $filtros . " AND tarjeton_nombre LIKE '%" . $filters->tarjeton_nombre . "%'";
			}
			if ($filters->tarjeton_cantidad_votos != '') {
				$filtros = $filtros . " AND tarjeton_cantidad_votos LIKE '%" . $filters->tarjeton_cantidad_votos . "%'";
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
			$parramsfilter['tarjeton_estado'] =  $this->_getSanitizedParam("tarjeton_estado");
			$parramsfilter['tarjeton_nombre'] =  $this->_getSanitizedParam("tarjeton_nombre");
			$parramsfilter['tarjeton_cantidad_votos'] =  $this->_getSanitizedParam("tarjeton_cantidad_votos");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
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

	function getZonasByName($votacion)
	{
		$zonasModel = new Administracion_Model_DbTable_Zonas();
		$zonas = $zonasModel->getList("votacion = '$votacion'", "");
		$zonasArray = array();
		foreach ($zonas as $zona) {
			$zonasArray[$zona->zona] = $zona->id;
		}
		return $zonasArray;
	}
}
