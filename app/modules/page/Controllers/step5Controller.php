<?php

/**
 *
 */

class Page_step5Controller extends Page_mainController
{
  public $header_step = 5;



  public function indexAction()
  {
    $users_model = new Administracion_Model_DbTable_Usuarioselecciones();

    if (Session::getInstance()->get('user')->id) {

      $users_model->editField(Session::getInstance()->get('user')->id, 'estado', 1);
    } else {
      Session::getInstance()->set('user', null);
      header('Location: /');
    }
    // $this->_view->user_info = Session::getInstance()->get('user');
  }
}
