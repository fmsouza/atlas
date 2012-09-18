<?php

/**
 * 
 * Classe Main
 * 
 * Controlador de exemplo definido como principal.
 * 
 * @author Frederico Souza
 * @method index
 * 
 */
class Main extends Controller{
	/**
	 * 
	 * Método principal do controlador
	 * 
	 */
	public function index(){
		$this->library('teste_lib','teste');
		$page = $this->teste->run();
		$this->view($page);
	}
}

//Fim do arquivo main.php