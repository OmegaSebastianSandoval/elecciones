<?php

/**
 * clase que genera la insercion y edicion  de Usuarios Elecciones en la base de datos
 */
class Administracion_Model_DbTable_Usuarioselecciones extends Db_Table
{
  /**
   * [ nombre de la tabla actual]
   * @var string
   */
  protected $_name = 'usuarios_elecciones';

  /**
   * [ identificador de la tabla actual en la base de datos]
   * @var string
   */
  protected $_id = 'id';

  /**
   * insert recibe la informacion de un Usuarios Elecciones y la inserta en la base de datos
   * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
   * @return integer      identificador del  registro que se inserto
   */
  public function insert($data)
  {
    $cedula = $data['cedula'];
    $clave = $data['clave'];
    if ($data['carga_masiva'] != 1) {
      $clave = password_hash($clave, PASSWORD_DEFAULT);
    }
    $nombre = $data['nombre'];

    $correo = $data['correo'];
    $celular = $data['celular'];
    $zona = $data['zona'];
    $activo = $data['activo'];
    $estado = $data['estado'];
    $votacion = $data['votacion'];

     $query = "INSERT INTO usuarios_elecciones( cedula, clave, nombre, correo, celular, zona, activo, estado, votacion) VALUES ( '$cedula', '$clave', '$nombre', '$correo', '$celular', '$zona', '$activo', '$estado', '$votacion')";
    $res = $this->_conn->query($query);
    return mysqli_insert_id($this->_conn->getConnection());
  }

  /**
   * update Recibe la informacion de un Usuarios Elecciones  y actualiza la informacion en la base de datos
   * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
   * @param  integer    identificador al cual se le va a realizar la actualizacion
   * @return void
   */
  public function update($data, $id)
  {

    $cedula = $data['cedula'];
    $clave = $data['clave'];
    if ($clave) {
      $clave = ", clave = '" . password_hash($clave, PASSWORD_DEFAULT) . "' ";
    }
    $nombre = $data['nombre'];
    $correo = $data['correo'];
    $celular = $data['celular'];
    $zona = $data['zona'];
    $activo = $data['activo'];
    $estado = $data['estado'];
    $votacion = $data['votacion'];

    $query = "UPDATE usuarios_elecciones SET  cedula = '$cedula' $clave , nombre = '$nombre', correo = '$correo', celular = '$celular', zona = '$zona', activo = '$activo', estado = '$estado', votacion = '$votacion' WHERE id = '$id'";
    $res = $this->_conn->query($query);
  }
  public function updateEmail($email, $id)
  {
    $query = "UPDATE usuarios_elecciones SET correo = '$email' WHERE id = '" . $id . "'";
    $res = $this->_conn->query($query);
  }
  public function deleteAll()
  {
    $query = "TRUNCATE table usuarios_elecciones";
    $res = $this->_conn->query($query);
  }
  public function deleteAllByVotacion($votacion)
  {
    $query = "DELETE FROM usuarios_elecciones WHERE votacion = '" . $votacion . "'";
    $res = $this->_conn->query($query);
  }


}
