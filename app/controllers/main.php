<?php

/**
 * 
 * Classe Main
 * 
 * Controlador de exemplo definido como principal.
 * 
 * @author Frederico Souza
 * @method index
 * @method teste
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
	
	/**
	 * 
	 * Método acessado por main/teste
	 */
	public function teste(){
		$this->library('form');
		$view = new View();
		$view->load('index');
		
		$args['titulo'] = "MarvelousVC pre-alpha";
		$args['texto'] = "Se você pode ver esta mensagem, significa que as views estão sendo carregadas! ;-P";
		
		$campos = array(
			'name' => array(
				'title' => 'Nome',
				'type'	=> 'text'
			),
			'telefone' => array(
				'title' => 'Telefone',
				'type'	=> 'text'
			),
			'email' => array(
				'title' => 'E-mail',
				'type'	=> 'text'
			),
			'senha' => array(
				'title' => 'Senha',
				'type'	=> 'pass'
			),
			'mensagem' => array(
				'title' => 'Mensagem',
				'type'	=> 'textarea'
			),
			'botao' => array(
				'title' => 'Enviar',
				'type'	=> 'button'
			));
		
		$args['form'] = $this->form->create('teste',$campos,'main/form');
		$view->render($args);
	}
}

//Fim do arquivo main.php