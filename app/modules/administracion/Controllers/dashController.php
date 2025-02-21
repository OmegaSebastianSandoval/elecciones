<?php

/**
*
*/
class Administracion_dashController extends Administracion_mainController
{
	public $botonpanel = 34;

	public function indexAction()
	{
		$this->getLayout()->setTitle("Dash Administrativo");
	}

}