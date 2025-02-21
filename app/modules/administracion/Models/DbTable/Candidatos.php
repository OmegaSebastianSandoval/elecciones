<?php

/**
 * clase que genera la insercion y edicion  de Candidatos en la base de datos
 */
class Administracion_Model_DbTable_Candidatos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'candidatos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'id';

	/**
	 * insert recibe la informacion de un Candidatos y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data)
	{
		$foto = $data['foto'];
		$numero = $data['numero'];
		$nombre = $data['nombre'];
		$suplente = $data['suplente'];
		$zona = $data['zona'];
		$lista = $data['lista'];
		$candidato_tarjeton = $data['candidato_tarjeton'];

		$detalle = $data['detalle'];
		$cedula = $data['cedula'];
		$votacion = $data['votacion'];
		$query = "INSERT INTO candidatos( foto, numero, nombre, suplente, zona, lista, candidato_tarjeton, detalle, cedula, votacion) VALUES ( '$foto', '$numero', '$nombre', '$suplente', '$zona', '$lista', '$candidato_tarjeton', '$detalle', '$cedula', '$votacion')";
		$res = $this->_conn->query($query);
		return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Candidatos  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data, $id)
	{

		$foto = $data['foto'];
		$numero = $data['numero'];
		$nombre = $data['nombre'];
		$suplente = $data['suplente'];
		$zona = $data['zona'];
		$lista = $data['lista'];
		$candidato_tarjeton = $data['candidato_tarjeton'];

		$detalle = $data['detalle'];
		$cedula = $data['cedula'];
		$votacion = $data['votacion'];

		$query = "UPDATE candidatos SET  foto = '$foto', numero = '$numero', nombre = '$nombre', suplente = '$suplente', zona = '$zona', lista = '$lista', candidato_tarjeton = '$candidato_tarjeton', detalle = '$detalle', cedula = '$cedula', votacion = '$votacion' WHERE id = '$id'";
		$res = $this->_conn->query($query);
	}
	public function deleteAll()
	{
		$query = "TRUNCATE table candidatos";
		$res = $this->_conn->query($query);
	}
}
