<?php

/**
 * clase que genera la insercion y edicion  de tarjet&oacute;n en la base de datos
 */
class Administracion_Model_DbTable_Tarjetones extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'tarjetones';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'tarjeton_id';

	/**
	 * insert recibe la informacion de un tarjet&oacute;n y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data)
	{
		$tarjeton_estado = $data['tarjeton_estado'];
		$tarjeton_nombre = $data['tarjeton_nombre'];
		$tarjeton_cantidad_votos = $data['tarjeton_cantidad_votos'];
		$tarjeton_elecciones = $data['tarjeton_elecciones'];
		$tarjeton_zona = $data['tarjeton_zona'];
		$tarjeton_mostrar_detalle = $data['tarjeton_mostrar_detalle'];
		$tarjeton_mostrar_suplente = $data['tarjeton_mostrar_suplente'];
		$tarjeton_mostrar_fotos = $data['tarjeton_mostrar_fotos'];
		$tarjeton_descripcion = $data['tarjeton_descripcion'];
		$tarjeton_titulo = $data['tarjeton_titulo'];
		$tarjeton_voto_blanco = $data['tarjeton_voto_blanco'];


		$query = "INSERT INTO tarjetones( tarjeton_estado, tarjeton_nombre, tarjeton_cantidad_votos, tarjeton_elecciones,tarjeton_zona, tarjeton_mostrar_detalle, tarjeton_mostrar_suplente,tarjeton_mostrar_fotos, tarjeton_descripcion, tarjeton_titulo, tarjeton_voto_blanco) VALUES ('$tarjeton_estado', '$tarjeton_nombre', '$tarjeton_cantidad_votos', '$tarjeton_elecciones', '$tarjeton_zona', '$tarjeton_mostrar_detalle', '$tarjeton_mostrar_suplente', '$tarjeton_mostrar_fotos', '$tarjeton_descripcion', '$tarjeton_titulo', '$tarjeton_voto_blanco')";
		$res = $this->_conn->query($query);
		return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un tarjet&oacute;n  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data, $id)
	{

		$tarjeton_estado = $data['tarjeton_estado'];
		$tarjeton_nombre = $data['tarjeton_nombre'];
		$tarjeton_cantidad_votos = $data['tarjeton_cantidad_votos'];
		$tarjeton_elecciones = $data['tarjeton_elecciones'];
		$tarjeton_zona = $data['tarjeton_zona'];

		$tarjeton_mostrar_detalle = $data['tarjeton_mostrar_detalle'];
		$tarjeton_mostrar_suplente = $data['tarjeton_mostrar_suplente'];
		$tarjeton_mostrar_fotos = $data['tarjeton_mostrar_fotos'];

		$tarjeton_descripcion = $data['tarjeton_descripcion'];
		$tarjeton_titulo = $data['tarjeton_titulo'];
		$tarjeton_voto_blanco = $data['tarjeton_voto_blanco'];


		$query = "UPDATE tarjetones SET  tarjeton_estado = '$tarjeton_estado', tarjeton_nombre = '$tarjeton_nombre', tarjeton_cantidad_votos = '$tarjeton_cantidad_votos', tarjeton_elecciones = '$tarjeton_elecciones', tarjeton_zona = '$tarjeton_zona', tarjeton_mostrar_detalle = '$tarjeton_mostrar_detalle', tarjeton_mostrar_suplente = '$tarjeton_mostrar_suplente',tarjeton_mostrar_fotos = '$tarjeton_mostrar_fotos', tarjeton_descripcion = '$tarjeton_descripcion', tarjeton_titulo = '$tarjeton_titulo', tarjeton_voto_blanco = '$tarjeton_voto_blanco' WHERE tarjeton_id = $id";
		$res = $this->_conn->query($query);
	}
}
