<?php

/**
 * clase que genera la insercion y edicion  de Resultados en la base de datos
 */
class Administracion_Model_DbTable_Resultados extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'resultados';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'id';

	/**
	 * insert recibe la informacion de un Resultados y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data)
	{
		$candidato = $data['candidato'];
		$usuario = $data['usuario'];
		$fecha = $data['fecha'];
		$opinion = $data['opinion'];
		$ip = $data['ip'];
		$isp = $data['isp'];
		$zona = $data['zona'];
		$tarjeton = $data['tarjeton'];

		$consecutivo = $data['consecutivo'];
		$votacion = $data['votacion'];

		$query = "INSERT INTO resultados( candidato, usuario, fecha, opinion, ip, isp, zona, tarjeton, consecutivo, votacion) VALUES ( '$candidato', '$usuario', '$fecha', '$opinion', '$ip', '$isp', '$zona', '$tarjeton', '$consecutivo', '$votacion')";
		$res = $this->_conn->query($query);
		return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Resultados  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data, $id)
	{

		$candidato = $data['candidato'];
		$usuario = $data['usuario'];
		$fecha = $data['fecha'];
		$opinion = $data['opinion'];
		$ip = $data['ip'];
		$isp = $data['isp'];
		$zona = $data['zona'];
		$tarjeton = $data['tarjeton'];
		$consecutivo = $data['consecutivo'];
		$votacion = $data['votacion'];


		$query = "UPDATE resultados SET  candidato = '$candidato', usuario = '$usuario', fecha = '$fecha', opinion = '$opinion', ip = '$ip', isp = '$isp', zona = '$zona' , tarjeton = '$tarjeton' , consecutivo = '$consecutivo' , votacion = '$votacion' WHERE id = $id";
		$res = $this->_conn->query($query);
	}


	public function getResultados($zona, $tarjeton)
	{

		$select = 'SELECT 
		resultados.zona,
		resultados.candidato,
		candidatos.nombre AS nombre_candidato,
		COUNT(DISTINCT resultados.id) AS total_votos,
		(SELECT COUNT(DISTINCT usuarios_elecciones.id) FROM usuarios_elecciones WHERE zona = ' . $zona . ') AS total_usuarios_zona,
		(SELECT COUNT(*) FROM resultados WHERE zona = ' . $zona . ' AND tarjeton = ' . $tarjeton . ') AS total_registros_zona,
		COUNT(DISTINCT resultados.id) / (SELECT COUNT(DISTINCT usuarios_elecciones.id) FROM usuarios_elecciones WHERE zona = ' . $zona . ' ) * 100 AS porcentaje_votos,
		COUNT(DISTINCT resultados.id) / (SELECT COUNT(*) FROM resultados WHERE zona = ' . $zona . ' AND tarjeton = ' . $tarjeton . ') * 100 AS porcentaje_votos_total
		FROM resultados
		LEFT JOIN candidatos ON resultados.candidato = candidatos.id
		LEFT JOIN usuarios_elecciones ON resultados.zona = usuarios_elecciones.zona
		WHERE resultados.zona = ' . $zona . ' AND resultados.tarjeton = ' . $tarjeton . '
		GROUP BY candidatos.id, candidatos.nombre
		ORDER BY total_votos DESC';
		$res = $this->_conn->query($select)->fetchAsObject();
		return $res;
	}

	public function getResultadosVariosCandidatos($zona)
	{

		$select = 'SELECT 
		candidatos.nombre AS nombre_candidato,
		COUNT(DISTINCT resultados.id) AS total_votos
		FROM resultados
		LEFT JOIN candidatos ON resultados.candidato = candidatos.id
		WHERE resultados.tarjeton = ' . $zona . '
		GROUP BY candidatos.id, candidatos.nombre
		ORDER BY total_votos DESC';
		$res = $this->_conn->query($select)->fetchAsObject();
		return $res;
	}

	public function getVotantes($filters = '', $order = '')
	{
		$filter = '';
		if ($filters != '') {
			$filter = ' WHERE ' . $filters;
		}
		$orders = "";
		if ($order != '') {
			$orders = ' ORDER BY ' . $order;
		}
			$select = 'SELECT * FROM ' . $this->_name . ' ' . $filter . ' ' . $orders . 'GROUP BY consecutivo';
		 $res = $this->_conn->query($select)->fetchAsObject();
		return $res;
	}
	public function getVotantesZona($filters = '', $order = '')
	{
		$filter = '';
		if ($filters != '') {
			$filter = ' WHERE ' . $filters;
		}
		$orders = "";
		if ($order != '') {
			$orders = ' ORDER BY ' . $order;
		}
		$select = 'SELECT zona, COUNT(DISTINCT usuario) AS total_usuarios FROM ' . $this->_name . ' ' . $filter . ' ' . $orders . 'GROUP BY zona';
		$res = $this->_conn->query($select)->fetchAsObject();
		return $res;
	}
}
