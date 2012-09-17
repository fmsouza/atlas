<?php
require(APP_PATH.'/config/config.php'); // Inclui o arquivo de configuração
require(APP_PATH.'/config/route.php'); // Inclui o arquivo de rotas
require(APP_PATH.'/config/database.php'); // Inclui os dados do acesso ao banco
require(SYS_PATH.'/classes/controller.php'); //Inclui a classe Controller
require(SYS_PATH.'/classes/model.php'); //Inclui a classe Model

if(!class_exists('App')):

class App{
	public $config; 	// configurações da aplicação
	public $db;			// configurações de banco de dados
	public $route;		// configurações de rotas
	private $control;	// objeto do controlador
	
	function __construct($config='',$db='',$route=''){
		$this->config = $config;
		$this->db = $db;
		$this->route = $route;
		
		if(DEFINED(DEBUG) && DEBUG) error_reporting(E_ALL);
		else error_reporting(0);
	}
	
	public function run(){
		if(!isset($_GET['r'])) // se não houver passagem de endereço por $_GET, carrega-se o controlador principal 
			$this->load_controller($this->route['main']);
		else // caso contrário, carrega o indicado pela rota
			$this->load_controller($_GET['r']);
	}
	
	private function load_controller($route){ //recebe um endereço
		if(in_array($route,array_keys($this->route))) // se o endereço passar estiver roteado, carrega-se a rota dele
			$route = $this->route[$route];
			
		$route = explode("/", $route);
		require_once(APP_PATH.'/controllers/'.$route[0].'.php'); // inclui o controlador especificado
		$this->control = new $route[0]();	// instancia o controlador
		
		if(isset($route[1]))
			$this->control->{$route[1]}(); 		// chama o método desejado, caso seja definido
		else
			$this->control->index(); 		// chama o método index
	}
}

endif;

$app = new App($config,$database,$route); // executa a aplicação