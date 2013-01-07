<?php
    /**
     * Este arquivo contém a classe principal da aplicação. A classe _APP é a responsável por
     * realizar o tratamento de endereços, carregamento de classes e, após uma requisição, chamar
     * o método certo requerido para executar determinada ação.
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     */
    /**
	 * Este arquivo contém a classe principal da aplicação. A classe _APP é a responsável por
     * realizar o tratamento de endereços, carregamento de classes e, após uma requisição, chamar
     * o método certo requerido para executar determinada ação.
     * @package system
     * @subpackage control
	 * @abstract
	 */
    abstract class _APP implements _SINGLETON{
		
		/**
		 * @var bool Estado da sessão
		 */
		protected $sessionStatus;
		/**
		 * @var array Dados da sessão
		 */
		protected $sessionData;
		/**
		 * @var Main Instância da classe Main
		 */
        static private $instance;
		/**
		 * @var mixed Variável utilizada na implementação default para as requisições por get do campo 'r'
		 */
		static public $mRequest;
		/**
		 * @var mixed Variável utilizada na implementação default para as requisições por get do campo 'args', utilizando o separador '/'
		 */
		static public $args;
		/**
		 * @var mixed Variável utilizada para conexões com o banco de dados
		 */
		static public $db;
		
		/**
         * Instruções para a execução do sistema.
		 * @abstract
		 * @return void
		 */
		abstract public function onExecute();

        /**
		 * @ignore
         */
        private function __construct(){
        	$this->recoverSession();
        	$this->construct();
        }

        /**
         * Constrói a aplicação
         * @return void
         */
		protected function construct(){
			self::$mRequest = (isset($_GET['r']) && $_GET['r']!="onExecute") ? $_GET['r'] : "";
			self::$args = isset($_GET['args']) ? explode("/",$_GET['args']) : array();
		}

		/**
		 * @ignore
		 */
		public function onStart(){}

		/**
		 * @ignore
		 */
		public function onFinish(){}
		
        /**
         * Destrói as referências dos objetos da aplicação.
         * @return void
         */
		protected function destroy(){
			self::$mRequest = NULL;
			self::$args = NULL;
			self::$instance = NULL;
		}
		
        /**
		 * @ignore
         */
		public function __destruct(){
			$this->destroy();
			$this->writeSessionData();
		}
		
        /**
         * Retorna a instância do objeto Main
         * @return Main
         */
		static public function getInstance(){
			
			$className = (function_exists('get_called_class'))?get_called_class():"Main";
			if(is_null(self::$instance))
				self::$instance = new $className();
			return self::$instance;
		}

		/**
		 * @ignore
		 */
		public function __clone(){}
		
		/**
		 * Retorna o status da sessão, caso o valor retornado seja 1 ela está aberta caso seja 0 ela está fechada
		 * @return boolean
		 */
		 public function getSessionStatus(){
		 	return (bool)$this->sessionStatus;
		 }
		 
		 /**
		  * Abre uma sessão, caso não esteja aberta.
		  * @return void
		  */
		 public function openSession(){
		 	if(!$this->getSessionStatus()){
				$this->sessionStatus = 1;
				$_SESSION['_APP']['sessionStatus'] = 1;
		 	}
		 }
		 
		 /**
		  * Encerra a sessão, caso esteja aberta.
		  * @return void
		  */
		 public function closeSession(){
		 	if($this->getSessionStatus()){
		 		session_destroy();
				$this->sessionStatus = 0;
				unset($this->sessionData);
			}
		 }
		 
		 /**
		  * Caso haja uma sessão, retorna o dado especificado pelo parâmetro quando existir.
		  * @param string $key
		  * @return string
		  */
		 public function getSessionData($key){
		 	if($this->getSessionStatus()){
		 		return base64_decode($this->sessionData[$key]);
			}
		 }
		 
		 /**
		  * Infla a sessão do objeto.
		  * @return void
		  */
		 private function fillSessionData(){
		 	if($this->getSessionStatus() && isset($_SESSION['_APP']['data'])){
		 		$this->sessionData = $_SESSION['_APP']['data'];
			}
		 }
		 
		 /**
		  * Caso haja uma sessão, adiciona ou atualiza o valor do campo especificado.
		  * @param string $key nome do campo
		  * @param mixed $value dado a ser armazenado
		  * @return void
		  */
		 public function addToSessionData($key,$value){
		 	if($this->getSessionStatus()){
				$this->sessionData[$key] = base64_encode($value);
			}
		 }
		 
		 /**
		  * Infla a sessão do objeto.
		  * @return void
		  */
		 private function recoverSession(){
		 	if(isset($_SESSION['_APP'])){
		 		$this->sessionStatus = 1;
				$this->fillSessionData();
			}else
				$this->sessionStatus = 0;
		 }
		 
		 /**
		  * Atualiza a sessão com os dados do objeto.
		  * @return void
		  */
		 private function writeSessionData(){
		 	if($this->getSessionStatus()){
		 		$_SESSION['_APP']['data'] = $this->sessionData;
			}
		 }
		 	
        /**
         * Saída de dados. Caso o dado passado seja do tipo Element, o HTML do objeto
		 * será renderizado.
		 * 
         * @param Element|string $value
         * @return void
         */
        public static function display($value){
			echo ($value instanceof Element) ? $value->toRender() :  $value;
        }
    }
