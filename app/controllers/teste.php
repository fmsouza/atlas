<?php
/**
 *
 * Classe Teste
 *
 * Controlador de exemplo definido como teste.
 *
 * @author Frederico Souza
 * @method index
 *
 */
class Teste extends Controller{
	/**
	 * 
	 * Método principal do controlador
	 * 
	 */
	public function index(){
		echo "Método index do controlador Teste<br/><br/>";
		$this->model('modelo','model');
		$this->cons = $this->model->get();
		echo "Número de linhas na tabela: ".$this->cons->num_rows;
	}
}

//Fim de arquivo teste.php