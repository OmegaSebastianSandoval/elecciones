<?php 
/**
* clase que genera la insercion y edicion  de configlogin en la base de datos
*/
class Administracion_Model_DbTable_Configlogin extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'config_login';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'config_login_id';

	/**
	 * insert recibe la informacion de un configlogin y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$config_login_imagen = $data['config_login_imagen'];
		$config_login_titulo = $data['config_login_titulo'];
		$config_login_subtitulo = $data['config_login_subtitulo'];
		$query = "INSERT INTO config_login( config_login_imagen, config_login_titulo, config_login_subtitulo) VALUES ( '$config_login_imagen', '$config_login_titulo', '$config_login_subtitulo')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un configlogin  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$config_login_imagen = $data['config_login_imagen'];
		$config_login_titulo = $data['config_login_titulo'];
		$config_login_subtitulo = $data['config_login_subtitulo'];
		$query = "UPDATE config_login SET  config_login_imagen = '$config_login_imagen', config_login_titulo = '$config_login_titulo', config_login_subtitulo = '$config_login_subtitulo' WHERE config_login_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}