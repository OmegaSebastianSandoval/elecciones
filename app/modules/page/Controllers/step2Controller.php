<?php

/**
 *
 */

class Page_step2Controller extends Page_mainController
{
  public $header_step = 2;

  public function indexAction()
  {
    $this->verifyResult();
    $this->_view->user_info = Session::getInstance()->get('user');
  }
  public function updateemailAction()
  {
    // Crear una instancia del modelo de usuarios
    $users_model = new Administracion_Model_DbTable_Usuarioselecciones();

    // Obtener la configuración de la votación
    $votacion = $this->getVotacion();

    // Si la votación permite solicitar el número de teléfono
    if ($votacion->votacion_pedir_telefono == 1) {
      // Obtener y sanitizar el parámetro del número de celular
      $celular = $this->_getSanitizedParam('celular');

      // Actualizar el campo 'celular' en la base de datos
      $users_model->editField(Session::getInstance()->get('user')->id, 'celular', $celular);
    }

    // Obtener y sanitizar el parámetro del correo electrónico
    $email = $this->_getSanitizedParam('email');

    // Actualizar el correo electrónico en la base de datos
    $users_model->updateEmail($email, Session::getInstance()->get('user')->id);

    // Obtener el usuario actualizado después de la actualización del correo electrónico
    $usuarioAct = $users_model->getById(Session::getInstance()->get('user')->id);

    // Actualizar la sesión con la información del usuario actualizado
    Session::getInstance()->set('user', $usuarioAct);

    // Redirigir a la página step3
    header('Location: /page/step3');
  }
}
