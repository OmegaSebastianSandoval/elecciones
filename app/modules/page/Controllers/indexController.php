<?php

/**
 *
 */

class Page_indexController extends Page_mainController
{
  public $header_step = 1;

  public function indexAction()
  {
    $votacionActual = $this->getVotacion();
    $this->_view->votacion = $votacionActual;

    //si existe un usuario activo llevar al paso 1
    if (Session::getInstance()->get('user')) {
      header("Location: /page/step3");
    }
    $this->_view->error = $this->_getSanitizedParam('error');
  }
  public function loginAction()
  {
    // Iniciar sesión

    // Obtener y sanitizar los parámetros del formulario
    $user = $this->_getSanitizedParam('user');
    $pass = $this->_getSanitizedParam('pass');

    // Arreglo para almacenar la respuesta
    $res = array();

    // Modelos de base de datos
    $resultados_model = new Administracion_Model_DbTable_Resultados();
    $users_model = new Administracion_Model_DbTable_Usuarioselecciones();

    // Obtener información del usuario por su cédula
    $user_info = $users_model->getList("cedula = '$user'", "")[0];

    if (!$user_info) {
      // No se encontró al usuario
      $res['status'] = 'user_not_found';
      // Devolver la respuesta como JSON
      die(json_encode($res));
    }

    // Verificar si el usuario está activo
    if ($user_info->activo != 1) {
      // El usuario no está activo
      $res['status'] = 'inactive_user';
      die(json_encode($res));
    }

    // Verificar la contraseña del usuario
    //if ($pass == $user_info->clave) {
    if (!password_verify($pass, $user_info->clave)) {
      // La contraseña es incorrecta
      $res['status'] = 'password_error';
      die(json_encode($res));
    }

    // Verificar si el usuario ya votó
    $verify_resultados = $resultados_model->getList("usuario = '$user_info->id'", "")[0];

    if ($verify_resultados) {
      // El usuario ya votó
      Session::getInstance()->set('user', null);
      $res['voto'] = true;
      $res['status'] = 'success';
      die(json_encode($res));
    }
    // El usuario aún no ha votado

    // Inicializar respuesta para indicar que el usuario no ha votado
    $res['voto'] = false;
    $res['status'] = 'success';

    // Consultar si las votaciones están abiertas
    $votacion = $this->getVotacion();
    $fechaActual = date('Y-m-d H:i:s');


    // Verificar si la votación está cerrada (fecha actual es anterior a la fecha de inicio)
    if ($fechaActual < $votacion->fecha_inicio) {
      // La votación está cerrada
      $res['votacion'] = 'close';
      $res['fechaVotacion'] = $votacion->fecha_inicio;
    } elseif ($fechaActual >= $votacion->fecha_inicio && $fechaActual <= $votacion->fecha_final) {
      // La votación está abierta
      $res['votacion'] = 'open';

      // Establecer la sesión del usuario
      Session::getInstance()->set('user', $user_info);
    } else {
      // La votación está cerrada
      $res['votacion'] = 'close';
      $res['fechaVotacion'] = $votacion->fecha_inicio;
    }
    die(json_encode($res));

  }

  //Cerrar sesión
  public function logoutAction()
  {
    Session::getInstance()->set('user', null);
    Session::getInstance()->set('tarjeton', null);
    Session::getInstance()->set('cantidadtarjetones', null);
    Session::getInstance()->set('tarjetonactual', null);
    Session::getInstance()->set('posicionvotacion', null);
    Session::getInstance()->set('resumen', null);
    header("Location: /");
  }
}
