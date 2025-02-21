<?php

/**
 * Controlador de Candidatos que permite la  creacion, edicion  y eliminacion de los Candidatos del Sistema
 */
class Administracion_candidatosController extends Administracion_mainController
{
	public $botonpanel = 6;
	/**
	 * $mainModel  instancia del modelo de  base de datos Candidatos
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
	protected $_csrf_section = "administracion_candidatos";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;

	protected $namepageactual;
	protected $votacion;

	protected $tarjeton;
	/**
	 * Inicializa las variables principales del controlador candidatos .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Candidatos();
		$this->namefilter = "parametersfiltercandidatos";
		$this->route = "/administracion/candidatos";
		$this->namepages = "pages_candidatos";
		$this->namepageactual = "page_actual_candidatos";
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
	 * Recibe la informacion y  muestra un listado de  Candidatos con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		$votacion = $this->_getSanitizedParam("votacion");
		$tarjeton = $this->_getSanitizedParam("tarjeton");
		if (!$votacion || !$tarjeton) {
			header('Location: /administracion/candidatos/elecciones');
		}
		$this->_view->votacion = $votacion;
		$this->_view->tarjeton = $tarjeton;

		$title = "Administración de Candidatos";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object)Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();

		$filters = $filters . " AND votacion = " . $votacion . " AND candidato_tarjeton = " . $tarjeton;
		$order = "";
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
		$this->_view->list_zona = $this->getZona($this->votacion);
	}

	public function eleccionesAction()
	{
		$eleccionesModel = new Administracion_Model_DbTable_Configvotacion();



		$title = "Listado de elecciones";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;

		$filters = "";
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "id DESC";
		$list =  $eleccionesModel->getList($filters, $order);
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
		$this->_view->lists = $eleccionesModel->getListPages($filters, $order, $start, $amount);
		$this->_view->csrf_section = $this->_csrf_section;
	}
	public function tarjetonesAction()
	{
		$votacion = $this->_getSanitizedParam("votacion");
		if (!$votacion) {
			header('Location: /administracion/candidatos/elecciones?error=1');
		}
		$this->_view->votacion = $votacion;
		$tarjetonesModel = new Administracion_Model_DbTable_Tarjetones();
		$title = "Administración de tarjet&oacute;n";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object)Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$filters = $filters . " AND tarjeton_elecciones = " . $votacion;

		$order = "orden ASC";
		$list = $tarjetonesModel->getList($filters, $order);
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
		$this->_view->lists = $tarjetonesModel->getListPages($filters, $order, $start, $amount);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->eleccion = $this->_getSanitizedParam("eleccion");
		$this->_view->list_zona = $this->getZona($this->votacion);
	}

	/**
	 * Genera la Informacion necesaria para editar o crear un  Candidatos  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_candidatos_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->list_zona = $this->getZona($this->votacion);

		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if ($content->id) {
				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar Candidatos";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear Candidatos";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear Candidatos";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
	 * Inserta la informacion de un Candidatos  y redirecciona al listado de Candidatos.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$data = $this->getData();
			$uploadImage =  new Core_Model_Upload_Image();
			if ($_FILES['foto']['name'] != '') {
				$data['foto'] = $uploadImage->upload("foto");
			}
			$id = $this->mainModel->insert($data);

			$data['id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'CREAR CANDIDATOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: ' . $this->route . '?votacion=' . $this->votacion . '&tarjeton=' . $this->tarjeton);
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un Candidatos  y redirecciona al listado de Candidatos.
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
				$uploadImage =  new Core_Model_Upload_Image();
				if ($_FILES['foto']['name'] != '') {
					if ($content->foto) {
						$uploadImage->delete($content->foto);
					}
					$data['foto'] = $uploadImage->upload("foto");
				} else {
					$data['foto'] = $content->foto;
				}
				$this->mainModel->update($data, $id);
			}
			$data['id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'EDITAR CANDIDATOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: ' . $this->route . '?votacion=' . $this->votacion . '&tarjeton=' . $this->tarjeton);
	}

	/**
	 * Recibe un identificador  y elimina un Candidatos  y redirecciona al listado de Candidatos.
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
					$uploadImage =  new Core_Model_Upload_Image();
					if (isset($content->foto) && $content->foto != '') {
						$uploadImage->delete($content->foto);
					}
					$this->mainModel->deleteRegister($id);
					$data = (array)$content;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = 'BORRAR CANDIDATOS';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}
		header('Location: ' . $this->route . '?votacion=' . $this->votacion . '&tarjeton=' . $this->tarjeton);
	}

	/**
	 * Genera los valores del campo Zona.
	 *
	 * @return array cadena con los valores del campo Zona.
	 */
	private function getZona($votacion)
	{
		$modelData = new Administracion_Model_DbTable_Zonas();
		$data = $modelData->getList("votacion = " . $votacion, "");
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->id] = $value->zona;
		}
		return $array;
	}


	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Candidatos.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		$data['foto'] = "";
		if ($this->_getSanitizedParam("numero") == '') {
			$data['numero'] = '0';
		} else {
			$data['numero'] = $this->_getSanitizedParam("numero");
		}
		$data['nombre'] = $this->_getSanitizedParam("nombre");
		$data['suplente'] = $this->_getSanitizedParam("suplente");
		if ($this->_getSanitizedParam("zona") == '') {
			$data['zona'] = '0';
		} else {
			$data['zona'] = $this->_getSanitizedParam("zona");
		}
		if ($this->_getSanitizedParam("lista") == '') {
			$data['lista'] = '0';
		} else {
			$data['lista'] = $this->_getSanitizedParam("lista");
		}
		$data['detalle'] = $this->_getSanitizedParam("detalle");
		$data['candidato_tarjeton'] = $this->_getSanitizedParam("candidato_tarjeton");
		$data['votacion'] = $this->_getSanitizedParam("votacion");



		$data['cedula'] = $this->_getSanitizedParam("cedula");
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
			if ($filters->numero != '') {
				$filtros = $filtros . " AND numero LIKE '%" . $filters->numero . "%'";
			}
			if ($filters->nombre != '') {
				$filtros = $filtros . " AND nombre LIKE '%" . $filters->nombre . "%'";
			}
			if ($filters->zona != '') {
				$filtros = $filtros . " AND zona = '" . $filters->zona . "'";
			}
			if ($filters->cedula != '') {
				$filtros = $filtros . " AND cedula LIKE '%" . $filters->cedula . "%'";
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
			$parramsfilter['numero'] =  $this->_getSanitizedParam("numero");
			$parramsfilter['nombre'] =  $this->_getSanitizedParam("nombre");
			$parramsfilter['zona'] =  $this->_getSanitizedParam("zona");
			$parramsfilter['cedula'] =  $this->_getSanitizedParam("cedula");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}
}
