<?php 
/**
* clase que genera la insercion y edicion  de logcambios en la base de datos
*/
class Administracion_Model_DbTable_Logcambios extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'log_cambios';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'id';

	/**
	 * insert recibe la informacion de un logcambios y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$cedula = $data['cedula'];
		$valor_anterior = $data['valor_anterior'];
		$valor_nuevo = $data['valor_nuevo'];
		$fecha = $data['fecha'];
		$quien = $data['quien'];
		$query = "INSERT INTO log_cambios( cedula, valor_anterior, valor_nuevo, fecha, quien) VALUES ( '$cedula', '$valor_anterior', '$valor_nuevo', '$fecha', '$quien')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un logcambios  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$cedula = $data['cedula'];
		$valor_anterior = $data['valor_anterior'];
		$valor_nuevo = $data['valor_nuevo'];
		$fecha = $data['fecha'];
		$quien = $data['quien'];
		$query = "UPDATE log_cambios SET  cedula = '$cedula', valor_anterior = '$valor_anterior', valor_nuevo = '$valor_nuevo', fecha = '$fecha', quien = '$quien' WHERE id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}