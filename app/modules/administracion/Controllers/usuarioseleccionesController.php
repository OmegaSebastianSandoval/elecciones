<?php

/**
 * Controlador de Usuarioselecciones que permite la  creacion, edicion  y eliminacion de los Usuarios Elecciones del Sistema
 */
class Administracion_usuarioseleccionesController extends Administracion_mainController
{
	public $botonpanel;
	/**
	 * $mainModel  instancia del modelo de  base de datos Usuarios Elecciones
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
	protected $_csrf_section = "administracion_usuarioselecciones";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;

	protected $namepageactual;



	/**
	 * Inicializa las variables principales del controlador usuarioselecciones .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Usuarioselecciones();
		$this->namefilter = "parametersfilterusuarioselecciones";
		$this->route = "/administracion/usuarioselecciones";
		$this->namepages = "pages_usuarioselecciones";
		$this->namepageactual = "page_actual_usuarioselecciones";
		$this->_view->route = $this->route;
		// Obtener la URL actual
		$urlActual = $_SERVER['REQUEST_URI'];

		// Palabra que deseas buscar
		$palabraClave = 'generar';

		// Verificar si la URL contiene la palabra "generar"
		if (strpos($urlActual, $palabraClave) !== false) {
			$this->botonpanel = 10;
		} else {
			$this->botonpanel = 5;
		}
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
	 * Recibe la informacion y  muestra un listado de  Usuarios Elecciones con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		$votacion = $this->_getSanitizedParam("votacion");
		if (!$votacion) {
			header('Location: /administracion/usuarioselecciones/elecciones');
		}
		$this->_view->votacion = $votacion;
		$title = "Administración de Usuarios Elecciones";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object)Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$filters = $filters . " AND votacion = " . $votacion;

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
		$this->_view->list_zona = $this->getZona();
		$this->_view->list_estado = $this->getEstado();
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




	/**
	 * Genera la Informacion necesaria para editar o crear un  Usuarios Elecciones  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_usuarioselecciones_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;

		$this->_view->error = $this->_getSanitizedParam("error");

		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_zona = $this->getZona();
		$this->_view->list_estado = $this->getEstado();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if ($content->id) {
				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar Usuarios Elecciones";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear Usuarios Elecciones";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear Usuarios Elecciones";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
	 * Inserta la informacion de un Usuarios Elecciones  y redirecciona al listado de Usuarios Elecciones.
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

			$data['id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'CREAR USUARIOS ELECCIONES';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: ' . $this->route . '' . '');
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un Usuarios Elecciones  y redirecciona al listado de Usuarios Elecciones.
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


				if ($content->estado == 1 && ($content->zona != $data["zona"])) {

					$data["zona"] = $content->zona;
					$data["estado"] = 1;

					$this->mainModel->update($data, $id);
					$data['id'] = $id;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = 'EDITAR USUARIOS ELECCIONES';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);



					header('Location: ' . $this->route . '/manage?id=' . $id . '&error=2');
				} else {
					if ($content->zona != $data["zona"]) {
						$data2 = [];
						$data2['cedula'] = $data["cedula"];
						$data2['valor_anterior'] = $content->zona;
						$data2['valor_nuevo'] = $data["zona"];
						$data2['fecha'] = date("Y-m-d H:i:s");
						$data2['quien'] = Session::getInstance()->get("kt_login_user");
						$logCambiosModel = new Administracion_Model_DbTable_Logcambios();
						$logCambiosModel->insert($data2);
					}
					$this->mainModel->update($data, $id);
					$data['id'] = $id;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = 'EDITAR USUARIOS ELECCIONES';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
					header('Location: ' . $this->route . '' . '');
				}
			}
		}
	}

	/**
	 * Recibe un identificador  y elimina un Usuarios Elecciones  y redirecciona al listado de Usuarios Elecciones.
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
					$data['log_tipo'] = 'BORRAR USUARIOS ELECCIONES';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}
		header('Location: ' . $this->route . '' . '');
	}

	public function exportarcambiosAction()
	{
		$this->setLayout('blanco');
		$cambiosModel = new Administracion_Model_DbTable_Logcambios();
		$this->_view->cambios = $cambiosModel->getList();

		$this->_view->list_zona = $this->getZona();
		$this->_view->list_usuarios = $this->getQuien();
		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");

		if ($excel == 1) {
			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=cambios" . $hoy . ".xls");
		}
	}

	public function exportarusuariosAction()
	{
		$this->setLayout('blanco');
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object)Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
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
		$this->_view->list = $list;
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->list_zona = $this->getZona();
		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");

		if ($excel == 1) {
			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=usuarioselecciones" . $hoy . ".xls");
		}
	}


	public function eleccionesgenerarAction()
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

	public function generarclavesAction()
	{
		$title = "Generar claves de Usuarios Elecciones";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->_view->mostrar = $this->_getSanitizedParam("mostrar");
		$this->_view->votacion = $votacion = $this->_getSanitizedParam("votacion");
		if (!$votacion) {
			header('Location: /administracion/usuarioselecciones/eleccionesgenerar?page=1');
		}
	}
	public function generarAction()
	{
		$this->setLayout('blanco');



		$this->_view->votacion = $votacion = $this->_getSanitizedParam("votacion");
		if (!$votacion) {
			header('Location: /administracion/usuarioselecciones/eleccionesgenerar?page=1');
			exit;
		}

		$campoinicial = $this->_getSanitizedParam("inicio") ?? 0;

		if ($campoinicial == 0 || $campoinicial == '' || $campoinicial == null) {
			Session::getInstance()->set('usuariosUpdate', []);
			$usuarios = $this->mainModel->getList("votacion = " . $votacion);
			Session::getInstance()->set('usuarios', $usuarios);
		} else {
			$usuarios = Session::getInstance()->get('usuarios');
		}
		// Inicializa un array de resumen
		$usuariosUpdate = Session::getInstance()->get('usuariosUpdate') ?? [];

		// Obtener todos los usuarios de la votación

		$total = count($usuarios);
		$campoinicial = intval($campoinicial);
		if ($campoinicial + 100 >= $total) {
			$campofinal = $total;
		} else {
			$campofinal = $campoinicial + 100;
		}

		$this->_view->campoinicial = $campoinicial;
		$this->_view->campofinal = $campofinal;

		// Procesar los usuarios en bloques de 100
		for ($i = $campoinicial; $i < $campofinal; $i++) {
			$usuario = $usuarios[$i];
			$clave = str_pad(rand(100000, 999999), 6, "0", STR_PAD_LEFT);
			$claveHash = password_hash($clave, PASSWORD_DEFAULT);
			$this->mainModel->editField($usuario->id, "clave", $claveHash);

			// Guarda la información del usuario en el array
			$usuariosUpdate[] = [
				'id' => $usuario->id,
				'nombre' => $usuario->nombre,
				'cedula' => $usuario->cedula,
				'correo' => $usuario->correo,
				'zona' => $usuario->zona,
				'activo' => $usuario->activo,
				'estado' => $usuario->estado,
				'clave' => $clave,
			];
		}

		// Guardar el array de usuarios en la sesión
		Session::getInstance()->set('usuariosUpdate', $usuariosUpdate);

		// Redirigir para procesar el siguiente bloque o finalizar
		if ($campoinicial + 100 >= $total) {
			header('Location: ' . $this->route . '/generarclaves?mostrar=1' . '&votacion=' . $votacion);
		} else {
			header('Location: ' . $this->route . '/generar?inicio=' . $campofinal . '&votacion=' . $votacion);
		}
		exit;
	}

	public function exportarclavesAction()
	{
		$this->setLayout('blanco');


		$this->_view->lists = Session::getInstance()->get('usuariosUpdate');
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->list_zona = $this->getZona();
		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");

		if ($excel == 1) {
			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=usuarioselecciones" . $hoy . ".xls");
		}
		Session::getInstance()->set('usuariosUpdate', []);
		Session::getInstance()->set('usuarios', []);
	}
	private function getQuien()
	{
		$modelData = new Administracion_Model_DbTable_Usuario();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->user_user] = $value->user_names;
		}
		return $array;
	}
	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Usuarioselecciones.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		if ($this->_getSanitizedParam("estado") == '') {
			$data['estado'] = '0';
		} else {
			$data['estado'] = $this->_getSanitizedParam("estado");
		}
		$data['cedula'] = $this->_getSanitizedParam("cedula");
		$data['clave'] = $this->_getSanitizedParam("clave");
		$data['nombre'] = $this->_getSanitizedParam("nombre");
		$data['correo'] = $this->_getSanitizedParam("correo");
		$data['celular'] = $this->_getSanitizedParam("celular");
		if ($this->_getSanitizedParam("zona") == '') {
			$data['zona'] = '0';
		} else {
			$data['zona'] = $this->_getSanitizedParam("zona");
		}
		if ($this->_getSanitizedParam("activo") == '') {
			$data['activo'] = '0';
		} else {
			$data['activo'] = $this->_getSanitizedParam("activo");
		}



		return $data;
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
	 * Genera los valores del campo Estado.
	 *
	 * @return array cadena con los valores del campo Estado.
	 */
	private function getEstado()
	{
		$array = array();
		$array['1'] = 'Ya votó';
		$array['0'] = 'No ha votado';

		return $array;
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
			if ($filters->cedula != '') {
				$filtros = $filtros . " AND cedula LIKE '%" . $filters->cedula . "%'";
			}
			if ($filters->nombre != '') {
				$filtros = $filtros . " AND nombre LIKE '%" . $filters->nombre . "%'";
			}
			if ($filters->correo != '') {
				$filtros = $filtros . " AND correo LIKE '%" . $filters->correo . "%'";
			}
			if ($filters->zona != '') {
				$filtros = $filtros . " AND zona ='" . $filters->zona . "'";
			}
			if ($filters->estado != '') {
				$filtros = $filtros . " AND estado ='" . $filters->estado . "'";
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
			$parramsfilter['cedula'] =  $this->_getSanitizedParam("cedula");
			$parramsfilter['nombre'] =  $this->_getSanitizedParam("nombre");
			$parramsfilter['correo'] =  $this->_getSanitizedParam("correo");
			$parramsfilter['zona'] =  $this->_getSanitizedParam("zona");
			$parramsfilter['estado'] =  $this->_getSanitizedParam("estado");

			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}
}
