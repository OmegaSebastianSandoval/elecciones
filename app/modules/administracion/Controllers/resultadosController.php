<?php

/**
 * Controlador de Resultados que permite la  creacion, edicion  y eliminacion de los Resultados del Sistema
 */
class Administracion_resultadosController extends Administracion_mainController
{

	public $botonpanel = 11;

	/**
	 * $mainModel  instancia del modelo de  base de datos Resultados
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
	protected $_csrf_section = "administracion_resultados";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
	 * Inicializa las variables principales del controlador resultados .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Resultados();
		$this->namefilter = "parametersfilterresultados";
		$this->route = "/administracion/resultados";
		$this->namepages = "pages_resultados";
		$this->namepageactual = "page_actual_resultados";
		$this->_view->route = $this->route;
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
	 * Recibe la informacion y  muestra un listado de  Resultados con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		$title = "Administración de Resultados";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
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
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->votacion = $this->_getSanitizedParam("votacion");
	}

	public function eleccionesAction()
	{
		$title = "Administración de Resultados";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object)Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
		$eleccionesModel = new Administracion_Model_DbTable_Configvotacion();
		$list = $eleccionesModel->getList($filters, $order);
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
	 * Genera la Informacion necesaria para editar o crear un  Resultados  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_resultados_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if ($content->id) {
				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar Resultados";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear Resultados";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear Resultados";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
	 * Inserta la informacion de un Resultados  y redirecciona al listado de Resultados.
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
			$data['log_tipo'] = 'CREAR RESULTADOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: ' . $this->route . '' . '');
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un Resultados  y redirecciona al listado de Resultados.
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
				$this->mainModel->update($data, $id);
			}
			$data['id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'EDITAR RESULTADOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: ' . $this->route . '' . '');
	}

	/**
	 * Recibe un identificador  y elimina un Resultados  y redirecciona al listado de Resultados.
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
					$data['log_tipo'] = 'BORRAR RESULTADOS';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}
		header('Location: ' . $this->route . '' . '');
	}



	public function verAction()
	{
		$title = "Resultados Individuales";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->_view->votacion = $votacion = $this->_getSanitizedParam("votacion");
		$tartetonesModel = new Administracion_Model_DbTable_Tarjetones();

		$tarjetones = $tartetonesModel->getList("tarjeton_elecciones = '$votacion'", "");

		$filtroTarjeton = "";
		$condiciones = [];

		foreach ($tarjetones as $tarjeton) {
			$condiciones[] = "tarjeton = '$tarjeton->tarjeton_id'";
		}

		if (!empty($condiciones)) {
			$filtroTarjeton = " AND (" . implode(" OR ", $condiciones) . ")";
		}else {
			// Si no hay tarjetones, forzar a que la consulta no devuelva resultados
			$filtroTarjeton = " AND 1=0";
	}
		
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object)Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
		$list = $this->mainModel->getList($filters . " " . $filtroTarjeton, $order);
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
		$this->_view->lists = $list;
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->list_zona = $this->getZona();
		$this->_view->list_usuarios = $this->getUsuarios();
		$this->_view->list_candidatos = $this->getCandidatos();
		$this->_view->list_tarjeton = $this->getTarjeton();
	}


	public function verexportarAction()
	{
		$this->setLayout('blanco');
		$title = "Resultados Individuales";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;

		$this->_view->votacion = $votacion = $this->_getSanitizedParam("votacion");
		$tartetonesModel = new Administracion_Model_DbTable_Tarjetones();

		$tarjetones = $tartetonesModel->getList("tarjeton_elecciones = '$votacion'", "");

		$filtroTarjeton = "";
		$condiciones = [];

		foreach ($tarjetones as $tarjeton) {
			$condiciones[] = "tarjeton = '$tarjeton->tarjeton_id'";
		}

		if (!empty($condiciones)) {
			$filtroTarjeton = " AND (" . implode(" OR ", $condiciones) . ")";
		}

		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object)Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
		$list = $this->mainModel->getList($filters . " " . $filtroTarjeton, $order);
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
		$this->_view->lists = $list;
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->list_zona = $this->getZona();
		$this->_view->list_usuarios = $this->getUsuarios();
		$this->_view->list_tarjeton = $this->getTarjeton();

		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");

		if ($excel == 1) {


			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=resultadosindividuales" . $hoy . ".xls");
		}
	}
	public function verexportarvotantesAction()
	{
		$this->setLayout('blanco');
		$title = "Resultados Individuales";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;


		$this->_view->votacion = $votacion = $this->_getSanitizedParam("votacion");
		$tartetonesModel = new Administracion_Model_DbTable_Tarjetones();

		$tarjetones = $tartetonesModel->getList("tarjeton_elecciones = '$votacion'", "");

		$filtroTarjeton = "";
		$condiciones = [];

		foreach ($tarjetones as $tarjeton) {
			$condiciones[] = "tarjeton = '$tarjeton->tarjeton_id'";
		}

		if (!empty($condiciones)) {
			$filtroTarjeton = " AND (" . implode(" OR ", $condiciones) . ")";
		}



		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object)Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
		$list = $this->mainModel->getVotantes($filters . " " . $filtroTarjeton, $order);

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
		$this->_view->lists = $list;
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->list_zona = $this->getZona();
		$this->_view->list_usuarios = $this->getUsuarios();
		$this->_view->list_tarjeton = $this->getTarjeton();

		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");

		if ($excel == 1) {


			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=votantes" . $hoy . ".xls");
		}
	}

	public function verexportarvotanteszonaAction()
	{
		$this->setLayout('blanco');
		$title = "Resultados Individuales";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;

		$this->_view->votacion = $votacion = $this->_getSanitizedParam("votacion");
		$tartetonesModel = new Administracion_Model_DbTable_Tarjetones();

		$tarjetones = $tartetonesModel->getList("tarjeton_elecciones = '$votacion'", "");

		$filtroTarjeton = "";
		$condiciones = [];

		foreach ($tarjetones as $tarjeton) {
			$condiciones[] = "tarjeton = '$tarjeton->tarjeton_id'";
		}

		if (!empty($condiciones)) {
			$filtroTarjeton = " AND (" . implode(" OR ", $condiciones) . ")";
		}

		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object)Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
		$list = $this->mainModel->getVotantesZona($filters . " " . $filtroTarjeton, $order);
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
		$this->_view->lists = $list;
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->list_zona = $this->getZona();
		$this->_view->list_usuarios = $this->getUsuarios();
		$this->_view->list_tarjeton = $this->getTarjeton();

		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");

		if ($excel == 1) {


			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=resultadozona" . $hoy . ".xls");
		}
	}

	public function resultadozonaAction()
	{
		$title = "Resultados Zona";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();

		$zonasModel = new Administracion_Model_DbTable_Zonas();
		$usuariosModel = new Administracion_Model_DbTable_Usuarioselecciones();

		$zonas = $zonasModel->getList("", "zona ASC");

		foreach ($zonas as $zona) {
			$votosPorUsuario = $zonasModel->getResultados($zona->id);
			$usuariosHabilitados = $usuariosModel->getList("zona = '$zona->id'");

			$zona->total = count($votosPorUsuario);
			$zona->totalUsuarios = count($usuariosHabilitados);

			if ($zona->total > 0 && $zona->totalUsuarios > 0) {
				$zona->porcentaje = ($zona->total * 100) / $zona->totalUsuarios;
			} else {
				$zona->porcentaje = 0;
			}
		}

		$this->_view->zonas = $zonas;
	}

	public function resultadozonaexprotarAction()
	{
		$this->setLayout('blanco');


		$zonasModel = new Administracion_Model_DbTable_Zonas();
		$usuariosModel = new Administracion_Model_DbTable_Usuarioselecciones();

		$zonas = $zonasModel->getList("", "zona ASC");

		foreach ($zonas as $zona) {
			$votosPorUsuario = $zonasModel->getResultados($zona->id);
			$usuariosHabilitados = $usuariosModel->getList("zona = '$zona->id'");

			$zona->total = count($votosPorUsuario);
			$zona->totalUsuarios = count($usuariosHabilitados);

			if ($zona->total > 0 && $zona->totalUsuarios > 0) {
				$zona->porcentaje = ($zona->total * 100) / $zona->totalUsuarios;
			} else {
				$zona->porcentaje = 0;
			}
		}

		$this->_view->zonas = $zonas;

		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");

		if ($excel == 1) {
			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=resultadoszona" . $hoy . ".xls");
		}
	}

	public function resultadofinalAction()
	{
		// $this->setLayout('blanco');

		$title = "Resultados Finales";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;

		$this->_view->votacion = $votacion = $this->_getSanitizedParam("votacion");
		/* $tartetonesModel = new Administracion_Model_DbTable_Tarjetones();

		$tarjetones = $tartetonesModel->getList("tarjeton_elecciones = '$votacion'", "");

		$filtroTarjeton = "";
		$condiciones = [];

		foreach ($tarjetones as $tarjeton) {
			$condiciones[] = "tarjeton = '$tarjeton->tarjeton_id'";
		}

		if (!empty($condiciones)) {
			$filtroTarjeton = " AND (" . implode(" OR ", $condiciones) . ")";
		} */

		$this->filters();

		$zonasModel = new Administracion_Model_DbTable_Zonas();
		$resultadosModel = new Administracion_Model_DbTable_Resultados();

		$tarjetonesModel = new Administracion_Model_DbTable_Tarjetones();
		$usuariosEleccionesModel = new Administracion_Model_DbTable_Usuarioselecciones();
		$candidatosModel = new Administracion_Model_DbTable_Candidatos();

		$zonas = $zonasModel->getList("", "zona ASC");
		$tarjetones = $tarjetonesModel->getList("tarjeton_estado = 1 AND tarjeton_elecciones = '$votacion'", "tarjeton_id ASC");
		$totalUsuarios = 0;
		$total = 0;

		$resultado = [];

		foreach ($tarjetones as $tarjeton) {

			$tarjetonInfo = [
				'tarjeton' => $tarjeton,
				'zonas' => [],
			];


			if ($tarjeton->tarjeton_zona == 1) {


				foreach ($zonas as $zona) {
					// Obtener la cantidad de votos posibles en la zona
					$votosPosibles = count($usuariosEleccionesModel->getList("zona = '$zona->id' AND activo = 1 "));

					// Obtener la cantidad de votos registrados en la zona para este tarjetón
					$votosRegistrados = count($resultadosModel->getList("zona = '$zona->id' AND tarjeton = '$tarjeton->tarjeton_id' "));

					// Calcular el porcentaje de votos registrados en relación con los votos posibles
					$promedioZona = ($votosPosibles > 0) ? ($votosRegistrados * 100) / $votosPosibles : 0;

					// Información detallada de la zona
					$zonaInfo = [
						'zona' => $zona,
						'votosPosibles' => $votosPosibles,
						'votosRegistrados' => $votosRegistrados,
						'promedioZona' => $promedioZona,
						'resultados' => $resultadosModel->getResultados($zona->id, $tarjeton->tarjeton_id),
					];

					// Agregar información de la zona al array de zonas en tarjetonInfo
					$tarjetonInfo['zonas'][] = $zonaInfo;
				}
			} else {

				// Obtener la cantidad de votos registrados en la zona para este tarjetón
				$votosRegistrados = count($resultadosModel->getList("tarjeton = '$tarjeton->tarjeton_id' "));



				// Información detallada de la zona
				$zonaInfo = [

					'votosRegistrados' => $votosRegistrados,
					'resultados' => $resultadosModel->getResultadosVariosCandidatos($tarjeton->tarjeton_id),
				];

				// Agregar información de la zona al array de zonas en tarjetonInfo
				$tarjetonInfo['zonas'][] = $zonaInfo;
			}

			// Agregar información del tarjetón al array de resultados
			$resultado[$tarjeton->tarjeton_id] = $tarjetonInfo;
		}



		$this->_view->tarjetones = $tarjetones;

		$this->_view->resultados = $resultado;
	}


	public function resultadofinalimprimirAction()
	{
		$this->setLayout('blanco');

		$this->_view->votacion = $votacion = $this->_getSanitizedParam("votacion");

		$zonasModel = new Administracion_Model_DbTable_Zonas();
		$resultadosModel = new Administracion_Model_DbTable_Resultados();

		$tarjetonesModel = new Administracion_Model_DbTable_Tarjetones();
		$usuariosEleccionesModel = new Administracion_Model_DbTable_Usuarioselecciones();

		$zonas = $zonasModel->getList("", "zona ASC");
		$tarjetones = $tarjetonesModel->getList("tarjeton_estado = 1  AND tarjeton_elecciones = '$votacion' ", "tarjeton_id ASC");

		$resultado = [];

		foreach ($tarjetones as $tarjeton) {

			$tarjetonInfo = [
				'tarjeton' => $tarjeton,
				'zonas' => [],
			];


			if ($tarjeton->tarjeton_zona == 1) {


				foreach ($zonas as $zona) {
					// Obtener la cantidad de votos posibles en la zona
					$votosPosibles = count($usuariosEleccionesModel->getList("zona = '$zona->id' AND activo = 1 "));

					// Obtener la cantidad de votos registrados en la zona para este tarjetón
					$votosRegistrados = count($resultadosModel->getList("zona = '$zona->id' AND tarjeton = '$tarjeton->tarjeton_id' "));

					// Calcular el porcentaje de votos registrados en relación con los votos posibles
					$promedioZona = ($votosPosibles > 0) ? ($votosRegistrados * 100) / $votosPosibles : 0;

					// Información detallada de la zona
					$zonaInfo = [
						'zona' => $zona,
						'votosPosibles' => $votosPosibles,
						'votosRegistrados' => $votosRegistrados,
						'promedioZona' => $promedioZona,
						'resultados' => $resultadosModel->getResultados($zona->id, $tarjeton->tarjeton_id),
					];

					// Agregar información de la zona al array de zonas en tarjetonInfo
					$tarjetonInfo['zonas'][] = $zonaInfo;
				}
			} else {

				// Obtener la cantidad de votos registrados en la zona para este tarjetón
				$votosRegistrados = count($resultadosModel->getList("tarjeton = '$tarjeton->tarjeton_id' "));



				// Información detallada de la zona
				$zonaInfo = [

					'votosRegistrados' => $votosRegistrados,
					'resultados' => $resultadosModel->getResultadosVariosCandidatos($tarjeton->tarjeton_id),
				];

				// Agregar información de la zona al array de zonas en tarjetonInfo
				$tarjetonInfo['zonas'][] = $zonaInfo;
			}

			// Agregar información del tarjetón al array de resultados
			$resultado[$tarjeton->tarjeton_id] = $tarjetonInfo;
		}


		$this->_view->tarjetones = $tarjetones;

		$this->_view->resultados = $resultado;
		$imprimir = $this->_getSanitizedParam("imprimir");


		$this->_view->imprimir = $imprimir;


		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");
		$this->_view->excel = $excel;


		if ($excel == 1) {
			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=resultadofinal" . $hoy . ".xls");
		}
	}
	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Resultados.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		if ($this->_getSanitizedParam("candidato") == '') {
			$data['candidato'] = '0';
		} else {
			$data['candidato'] = $this->_getSanitizedParam("candidato");
		}
		if ($this->_getSanitizedParam("usuario") == '') {
			$data['usuario'] = '0';
		} else {
			$data['usuario'] = $this->_getSanitizedParam("usuario");
		}
		$data['fecha'] = $this->_getSanitizedParam("fecha");
		$data['opinion'] = $this->_getSanitizedParam("opinion");
		$data['ip'] = $this->_getSanitizedParam("ip");
		$data['isp'] = $this->_getSanitizedParam("isp");
		if ($this->_getSanitizedParam("zona") == '') {
			$data['zona'] = '0';
		} else {
			$data['zona'] = $this->_getSanitizedParam("zona");
		}
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
			if ($filters->candidato != '') {
				$filtros = $filtros . " AND candidato LIKE '%" . $filters->candidato . "%'";
			}
			if ($filters->usuario != '') {
				$filtros = $filtros . " AND usuario LIKE '%" . $filters->usuario . "%'";
			}
			if ($filters->fecha != '') {
				$filtros = $filtros . " AND fecha LIKE '%" . $filters->fecha . "%'";
			}
			if ($filters->ip != '') {
				$filtros = $filtros . " AND ip LIKE '%" . $filters->ip . "%'";
			}
			if ($filters->zona != '') {
				$filtros = $filtros . " AND zona LIKE '%" . $filters->zona . "%'";
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
			$parramsfilter['candidato'] =  $this->_getSanitizedParam("candidato");
			$parramsfilter['usuario'] =  $this->_getSanitizedParam("usuario");
			$parramsfilter['fecha'] =  $this->_getSanitizedParam("fecha");
			$parramsfilter['ip'] =  $this->_getSanitizedParam("ip");
			$parramsfilter['zona'] =  $this->_getSanitizedParam("zona");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
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

	private function getUsuarios()
	{
		$modelData = new Administracion_Model_DbTable_Usuarioselecciones();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->id] = $value->nombre;
		}
		return $array;
	}

	private function getCandidatos()
	{
		$candidatosModel = new Administracion_Model_DbTable_Candidatos();
		$data = $candidatosModel->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->id] = $value->nombre;
		}
		return $array;
	}

	private function getTarjeton()
	{
		$tarjetonesModel = new Administracion_Model_DbTable_Tarjetones();
		$data = $tarjetonesModel->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->tarjeton_id] = $value->tarjeton_nombre;
		}
		return $array;
	}
}
