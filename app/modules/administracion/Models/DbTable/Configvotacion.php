<?php

/**
 * clase que genera la insercion y edicion  de Configuraci&oacute;n en la base de datos
 */
class Administracion_Model_DbTable_Configvotacion extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'votacion';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'id';

	/**
	 * insert recibe la informacion de un Configuraci&oacute;n y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data)
	{
		$fecha_inicio = $data['fecha_inicio'];
		$fecha_final = $data['fecha_final'];
		$archivo = $data['archivo'];
		$archivo2 = $data['archivo2'];
		$modo_candidatos = $data['modo_candidatos'];
		$votacion_mostrar_campo = $data['votacion_mostrar_campo'];
		$votacion_texto_campo = $data['votacion_texto_campo'];
		$votacion_pedir_telefono = $data['votacion_pedir_telefono'];
		$votacion_actual = $data['votacion_actual'];
		$votacion_titulo = $data['votacion_titulo'];


		$query = "INSERT INTO votacion( fecha_inicio, fecha_final, archivo, archivo2, modo_candidatos, votacion_mostrar_campo, votacion_texto_campo, votacion_pedir_telefono, votacion_actual, votacion_titulo) VALUES ('$fecha_inicio', '$fecha_final', '$archivo', '$archivo2', '$modo_candidatos', '$votacion_mostrar_campo', '$votacion_texto_campo', '$votacion_pedir_telefono', '$votacion_actual', '$votacion_titulo')";
		$res = $this->_conn->query($query);
		return mysqli_insert_id($this->_conn->getConnection());
	}


	/**
	 * update Recibe la informacion de un Configuraci&oacute;n  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data, $id)
	{

		$fecha_inicio = $data['fecha_inicio'];
		$fecha_final = $data['fecha_final'];
		$modo_candidatos = $data['modo_candidatos'];
		$votacion_mostrar_campo = $data['votacion_mostrar_campo'];
		$votacion_texto_campo = $data['votacion_texto_campo'];
		$votacion_pedir_telefono = $data['votacion_pedir_telefono'];
		$votacion_actual = $data['votacion_actual'];
		$votacion_titulo = $data['votacion_titulo'];

		$query = "UPDATE votacion SET  fecha_inicio = '$fecha_inicio', fecha_final = '$fecha_final', modo_candidatos = '$modo_candidatos', votacion_mostrar_campo = '$votacion_mostrar_campo', votacion_texto_campo = '$votacion_texto_campo', votacion_pedir_telefono = '$votacion_pedir_telefono' , votacion_actual = '$votacion_actual', votacion_titulo = '$votacion_titulo' WHERE id = '" . $id . "'";
		$res = $this->_conn->query($query);
	}
	public function updateDelegados($data, $id)
	{

		$archivo = $data['archivo'];
		$query = "UPDATE votacion SET archivo = '$archivo' WHERE id = '" . $id . "'";
		$res = $this->_conn->query($query);
	}
	public function updateUsuarios($data, $id)
	{

		$archivo2 = $data['archivo2'];
		$query = "UPDATE votacion SET archivo2 = '$archivo2' WHERE id = '" . $id . "'";
		$res = $this->_conn->query($query);
	}
}
