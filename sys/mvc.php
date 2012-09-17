<?php
require(APP_PATH.'/config/config.php'); // Inclui o arquivo de configuração
require(APP_PATH.'/config/route.php'); // Inclui o arquivo de rotas
require(APP_PATH.'/config/database.php'); // Inclui os dados do acesso ao banco
require(SYS_PATH.'/classes/controller.php'); //Inclui a classe Controller
require(SYS_PATH.'/classes/model.php'); //Inclui a classe Model

if(!class_exists('App')):

class App{
	private $control;	// objeto do controlador
	private $main_method = 'index'; //método default
	
	function __construct(){
		if(DEFINED(DEBUG) && DEBUG) error_reporting(E_ALL);
		else error_reporting(0);
	}
	
	public function run(){
		if(!isset($_GET['r'])) // se não houver passagem de endereço por $_GET, carrega-se o controlador principal 
			$this->load_controller(Route::$main);
		else // caso contrário, carrega o indicado pela rota
			$this->load_controller($_GET['r']);
	}
	
	private function load_controller($route){ //recebe um endereço
		if(in_array($route, array_keys(get_object_vars(new Route)))) // se o endereço passar estiver roteado, carrega-se a rota dele
			$route = Route::${$route};
			
		$route = explode("/", $route);
		require_once(APP_PATH.'/controllers/'.$route[0].'.php'); // inclui o controlador especificado
		$this->control = new $route[0]();	// instancia o controlador
		
		if(isset($route[1]))
			$this->control->{$route[1]}(); 		// chama o método desejado, caso seja definido
		else
			$this->control->{$this->main_method}(); 		// chama o método index
	}
}

endif;

$app = new App(); // executa a aplicação