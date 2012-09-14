<?php
include(APP_PATH.'/config/config.php'); // Inclui o arquivo de configuração
include(APP_PATH.'/config/database.php'); // Inclui os dados do acesso ao banco
require(SYS_PATH.'/classes/controller.php'); //Inclui a classe Controller
require(SYS_PATH.'/classes/model.php'); //Inclui a classe Model

if(!class_exists('App')):

class App{
	public $config;
	public $db;
	public $route;
	private $control;
	
	function __construct($config='',$db='',$route=''){
		$this->config = $config;
		$this->db = $db;
		$this->route = $route;
	}
	
	public function run(){
		if(!isset($_GET['r']))
			$this->load_controller($this->route['main']);
		else
			$this->load_controller($_GET['r']);
	}
	
	private function load_controller($route){
		$route = explode("/", $route);
		require_once(APP_PATH.'/classes/controllers/'.$route[0].'.php');
		$this->control = new $route[0]();
		$this->control->{$route[1]}();
	}
}

endif;

$app = new App($config,$database,$route);