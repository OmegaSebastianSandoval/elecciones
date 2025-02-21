<?php

/**
 *
 */

class Page_mainController extends Controllers_Abstract
{

	public $template;

	public function init()
	{

		$this->_view->header_step = $this->header_step;
		$this->setLayout('page_page');
		$this->template = new Page_Model_Template_Template($this->_view);
		$infopageModel = new Page_Model_DbTable_Informacion();
		$configVotacionModel = new Administracion_Model_DbTable_Configvotacion();

		$configLogin	= new Administracion_Model_DbTable_Configlogin();




		$informacion = $infopageModel->getById(1);
		$this->_view->infopage = $informacion;

		/* $votacion = $configVotacionModel->getById(1);
		$this->_view->votacion = $votacion; */

		$login = $configLogin->getById(1);
		$this->_view->login = $login;


		$this->getLayout()->setData("meta_description", "$informacion->info_pagina_descripcion");
		$this->getLayout()->setData("meta_keywords", "$informacion->info_pagina_tags");
		$this->getLayout()->setData("scripts", "$informacion->info_pagina_scripts");
		$botonesModel = new Page_Model_DbTable_Publicidad();
		$this->_view->botones = $botonesModel->getList("publicidad_seccion='3' AND publicidad_estado='1'", "orden ASC");

		$header = $this->_view->getRoutPHP('modules/page/Views/partials/header.php');
		$this->getLayout()->setData("header", $header);
		$enlaceModel = new Page_Model_DbTable_Enlace();
		$this->_view->enlaces = $enlaceModel->getList("", "orden ASC");
		$footer = $this->_view->getRoutPHP('modules/page/Views/partials/footer.php');
		$this->getLayout()->setData("footer", $footer);
		$adicionales = $this->_view->getRoutPHP('modules/page/Views/partials/adicionales.php');
		$this->getLayout()->setData("adicionales", $adicionales);
		$this->usuario();
	}


	public function usuario()
	{
		$userModel = new Core_Model_DbTable_User();
		$user = $userModel->getById(Session::getInstance()->get("kt_login_id"));
		if ($user->user_id == 1) {
			$this->editarpage = 1;
		}
	}

	public function verifyResult()
	{
		if (!Session::getInstance()->get('user')) {
			header("Location: /");
		}
		// Consultar si las votaciones están abiertas
		$votacion = $this->getVotacion();
		$fechaActual = date('Y-m-d H:i:s');

		// Verificar si la votación está cerrada (fecha actual es anterior a la fecha de inicio)
		if ($fechaActual > $votacion->fecha_final && $this->header_step != 1) {
			// La votación está cerrada
			Session::getInstance()->set('user', null);
			header('Location: /page/index?error=2');
		}
		$resultados_model = new Administracion_Model_DbTable_Resultados();
		$verify_resultados = $resultados_model->getList("usuario = '" . Session::getInstance()->get('user')->id . "'", "")[0];
		if ($verify_resultados && $this->header_step != 1) {
			Session::getInstance()->set('user', null);
			header('Location: /page/index?error=1');
		}
	}

	public function getVotacion()
	{
		$configVotacionModel = new Administracion_Model_DbTable_Configvotacion();

		return $configVotacionModel->getList("votacion_actual = 1", "")[0];
	}
	/**
	 * Genera los valores del campo Zona.
	 *
	 * @return array cadena con los valores del campo Zona.
	 */
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
