<?php

/**
 * clase que genera la insercion y edicion  de Zonas en la base de datos
 */
class Administracion_Model_DbTable_Zonas extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'zonas';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'id';

	/**
	 * insert recibe la informacion de un Zonas y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data)
	{
		$zona = $data['zona'];
		$elegidos = $data['elegidos'];
		$votacion = $data['votacion'];
		$query = "INSERT INTO zonas( zona, elegidos, votacion) VALUES ( '$zona', '$elegidos', '$votacion')";
		$res = $this->_conn->query($query);
		return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Zonas  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data, $id)
	{

		$zona = $data['zona'];
		$elegidos = $data['elegidos'];
		$votacion = $data['votacion'];

		$query = "UPDATE zonas SET  zona = '$zona', elegidos = '$elegidos', votacion = '$votacion' WHERE id = '$id'";
		$res = $this->_conn->query($query);
	}


	public function getResultados($zonaid)
	{
		$select = "SELECT * FROM (resultados LEFT JOIN candidatos ON resultados.candidato = candidatos.id)  WHERE resultados.zona = '$zonaid'";
		$res = $this->_conn->query($select)->fetchAsObject();
		return $res;
	}


	public function deleteAll()
	{
		$query = "TRUNCATE table zonas";
		$res = $this->_conn->query($query);
	}
}
