<?php

/**
 * 
 */
class Page_Model_Template_Template
{

	protected $_view;

	function __construct($view)
	{
		$this->_view = $view;
	}


	public function getContentseccion($seccion)
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$contenidos = [];
		$rescontenidos = $contenidoModel->getList("contenido_estado='1' AND contenido_seccion = '$seccion' AND contenido_padre = '0' ", "orden ASC");
		foreach ($rescontenidos as $key => $contenido) {
			$contenidos[$key] = [];
			$contenidos[$key]['detalle'] = $contenido;
			$padre = $contenido->contenido_id;
			$hijos = $contenidoModel->getList("contenido_estado='1' AND contenido_padre = '$padre' ", "orden ASC");
			foreach ($hijos as $key2 => $hijo) {
				$padre = $hijo->contenido_id;
				$contenidos[$key]['hijos'][$key2] = [];
				$contenidos[$key]['hijos'][$key2]['detalle'] = $hijo;
				$nietos = $contenidoModel->getList("contenido_padre = '$padre' ", "orden ASC");
				if ($nietos) {
					$contenidos[$key]['hijos'][$key2]['hijos'] = $nietos;
				}
			}
		}
		$this->_view->contenidos = $contenidos;
		return $this->_view->getRoutPHP("modules/page/Views/template/contenedor.php");
	}

	public function banner($seccion)
	{
		$this->_view->seccionbanner = $seccion;
		$publicidadModel = new Page_Model_DbTable_Publicidad();
		$this->_view->banners = $publicidadModel->getList("publicidad_seccion = '$seccion' AND publicidad_estado = '1'", "orden ASC");

		return $this->_view->getRoutPHP("modules/page/Views/template/bannerprincipal.php");
	}

	public function getTarjetonDELETE($tarjeton)
	{

		$candidatos_model = new Administracion_Model_DbTable_Candidatos();
		$config_model = new Administracion_Model_DbTable_Configvotacion();
		$zonasModel = new Administracion_Model_DbTable_Zonas();


		$this->_view->config =  $configVotacion = $config_model->getById(1);
		$this->_view->user_info = $user_info = Session::getInstance()->get('user');
		$this->_view->tarjeton = $tarjeton;
		$this->_view->zonaInfo = $zonaInfo = $zonasModel->getById($user_info->zona);


		//Traer candidatos, si el tarjeton es zonas, trae todos, si no, traer candidatos de la zona del usuario
		if ($tarjeton->tarjeton_zona === 'TODAS') {

			$this->_view->cantidadMaximaVotos = $tarjeton->tarjeton_cantidad_votos;
			$this->_view->candidatos = $candidatos_model->getList("candidato_tarjeton = '$tarjeton->tarjeton_id'", " CASE WHEN nombre = 'VOTO EN BLANCO' THEN 1 ELSE 0 END, numero ");
		} else {
			$this->_view->cantidadMaximaVotos = $zonaInfo->elegidos;
			$this->_view->candidatos = $candidatos_model->getList("zona = '$user_info->zona' AND candidato_tarjeton = '$tarjeton->tarjeton_id' ", " CASE WHEN nombre = 'VOTO EN BLANCO' THEN 1 ELSE 0 END, numero ");
		}


		// Llamar a la función para dividir la frase
		$partes = $this->dividirEnDosPartes($tarjeton->tarjeton_nombre);
		// Mostrar las partes
		$this->_view->parte1 = $partes['parte1'];
		$this->_view->parte2 = $partes['parte2'];


		//Traer info de la zona
		if ($tarjeton->tarjeton_mostrar_fotos == 1) {
			$template = ($tarjeton->tarjeton_cantidad_votos == 1)
				? "tarjetonfotos.php"
				: "tarjetonfotosvarios.php";
		} else {
			$template = ($tarjeton->tarjeton_cantidad_votos == 1)
				? "tarjeton.php"
				: "tarjetonvarios.php";
		}

		return $this->_view->getRoutPHP("modules/page/Views/template/$template");
	}

	public function getTarjetonesAll()
	{

		/* $tarjetones = Session::getInstance()->get('tarjetones');
		print_r($tarjetones); */
		$tarjetonactual = Session::getInstance()->get('tarjetonactual');

		$posicionvotacion = Session::getInstance()->get('posicionvotacion');
		$resumen = Session::getInstance()->get('resumen');

		$candidatos_model = new Administracion_Model_DbTable_Candidatos();
		$config_model = new Administracion_Model_DbTable_Configvotacion();
		$zonasModel = new Administracion_Model_DbTable_Zonas();


		$this->_view->config =  $configVotacion = $config_model->getById(1);
		$this->_view->user_info = $user_info = Session::getInstance()->get('user');
		$this->_view->tarjeton = $tarjetonactual;
		$this->_view->zonaInfo = $zonaInfo = $zonasModel->getById($user_info->zona);
		$list_zonas = $this->getZona();



		//Traer candidatos, si la zona es 1 o sea se filtra los candidatos y la cantidad de votos por la zona del usuario logueado
		if ($tarjetonactual->tarjeton_zona == 1) {
			$this->_view->cantidadMaximaVotos  = $zonaInfo->elegidos;
			$this->_view->candidatos = $candidatos_model->getList("candidato_tarjeton = '$tarjetonactual->tarjeton_id' AND zona = '$user_info->zona'", " CASE WHEN nombre = 'VOTO EN BLANCO' THEN 1 ELSE 0 END, numero ");
		} else {
			$this->_view->cantidadMaximaVotos =  $tarjetonactual->tarjeton_cantidad_votos;
			$this->_view->candidatos = $candidatos_model->getList(" candidato_tarjeton = '$tarjetonactual->tarjeton_id' ", " CASE WHEN nombre = 'VOTO EN BLANCO' THEN 1 ELSE 0 END, numero ");
		}


		// Llamar a la función para dividir la frase para el titulo del tarjeton
		$partes = $this->dividirEnDosPartes($tarjetonactual->tarjeton_nombre);
		// Mostrar las partes
		$this->_view->parte1 = $partes['parte1'];
		$this->_view->parte2 = $partes['parte2'];



		if ($tarjetonactual->tarjeton_mostrar_fotos == 1) {
			$template =  "tarjetonfotos.php";
		} else {
			$template = "tarjeton.php";
		}
		return $this->_view->getRoutPHP("modules/page/Views/template/$template");
	}



	public function errorTarjeton()
	{
		return $this->_view->getRoutPHP("modules/page/Views/template/errortarjeton.php");
	}

	function dividirEnDosPartes($texto)
	{
		// Dividir el texto en palabras
		$palabras = explode(' ', $texto, 3);

		if (count($palabras) >= 2) {
			// Tomar las dos primeras palabras como criterio de división
			$parte1 = $palabras[0] . ' ' . $palabras[1];
			$parte2 = isset($palabras[2]) ? $palabras[2] : '';

			// Retornar las dos partes en un array
			return array('parte1' => $parte1, 'parte2' => $parte2);
		} else {
			// Si no hay suficientes palabras, retornar un mensaje de error o manejar según sea necesario
			return array('error' => 'No hay suficientes palabras para dividir la frase.');
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
