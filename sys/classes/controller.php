<?php if(!class_exists('Controller')):

/**
 * Classe Controller
 * 
 * Classe que possui todas as definições e métodos padrões de um controlador
 * 
 * @author Frederico Souza
 * 
 * @method model
 * @method view
 * @method library
 *
 */
abstract class Controller{
	/**
	 * Carrega um modelo
	 * 
	 * @param string $name
	 * @param string $rename
	 */
	public function model($name,$rename=''){
		require(APP_PATH.'/models/'.$name.'.php');
		if(!empty($rename))
			$this->{$rename} = new $name(); //se $rename estiver preenchido, carrega com o nome {$rename}
		else
			$this->{$name} = new $name(); //senão carrega com o nome original da classe
	}
	
	/**
	 * Carrega uma view
	 * 
	 * @param string $name
	 * @TODO modificar o método de carregamento de view para carregar uma classe controladora de view
	 */
	public function view($name){
		require(APP_PATH.'/views/'.$name.'.php');
	}

	/**
	 * Carrega uma biblioteca
	 * 
	 * @param string $name
	 * @param string $rename
	 * @param string $param
	 */
	public function library($name,$rename='',$param=''){
		require(APP_PATH.'/libraries/'.$name.'.php'); //inclui o arquivo da classe
		if(!empty($rename))
			$this->{$rename} = new $name(); //se $rename estiver preenchido, carrega com o nome {$rename}
		else
			$this->{$name} = new $name(); //senão carrega com o nome original da classe
	}
}

endif;

// Fim do arquivo controller.php