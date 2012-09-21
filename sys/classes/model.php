<?php if(!class_exists('Model')):

/**
 * 
 * Classe Model
 * 
 * Responsável pela modelagem de dados relacionados às tabelas do banco e
 * pela conexão e operações entre um Controller e um banco de dados.
 * 
 * @author Frederico Souza
 * @method __construct
 *
 */
abstract class Model{
	/**
	 * 
	 * Carrega o driver do banco e cria a conexão caso seja definido na config que o banco deverá ser carregado
	 */
	function __construct(){
		if(Config::load_database){
			$this->driver = Database::driver;
			require_once(SYS_PATH.'/db/drivers/'.$this->driver.'.php');
			$this->db = new $this->driver();
		}
	}
	
}

endif;

//Fim do arquivo model.php