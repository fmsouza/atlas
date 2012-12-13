<?php
    /**
     * 
     * Classe _APP
     * 
     * Este arquivo contém a classe principal da aplicação. A classe _APP é a responsável por
     * realizar o tratamento de endereços, carregamento de classes e, após uma requisição, chamar
     * o método certo requerido para executar determinada ação.
     * 
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * 
     * @method __construct
     * @method run
     * @method index
     * @method @static display
     * 
     */
    abstract class _APP implements _SINGLETON{
		
		protected $sessionStatus;
		protected $sessionData;
        static private $instance;
		static public $mRequest;
		static public $args;
		static public $db;
		
		abstract public function onExecute();

        /**
         * Carrega as classes necessárias e roda a aplicação
         * @param string $route
         * @return void
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

		public function onStart(){}
        
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
         * Destrói a aplicação
         * @return void
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
			$className = get_called_class();
			if(is_null(self::$instance))
				self::$instance = new $className();
			return self::$instance;
		}


		public function __clone(){}
		
		/**
		 * Retorna o status da sessão, caso o valor retornado seja 1 ela está aberta caso seja 0 ela está fechada
		 * @return boolean
		 */
		 public function getSessionStatus(){
		 	return (bool)$this->sessionStatus;
		 }
		 
		 public function openSession(){
		 	if(!$this->getSessionStatus()){
				$this->sessionStatus = 1;
				$_SESSION['_APP']['sessionStatus'] = 1;
		 	}
		 }
		 
		 public function closeSession(){
		 	if($this->getSessionStatus()){
		 		session_destroy();
				$this->sessionStatus = 0;
				unset($this->sessionData);
			}
		 }
		 
		 public function getSessionData($key){
		 	if($this->getSessionStatus()){
		 		return base64_decode($this->sessionData[$key]);
			}
		 }
		 
		 private function fillSessionData(){
		 	if($this->getSessionStatus() && isset($_SESSION['_APP']['data'])){
		 		$this->sessionData = $_SESSION['_APP']['data'];
			}
		 }
		 
		 public function addToSessionData($key,$value){
		 	if($this->getSessionStatus()){
				$this->sessionData[$key] = base64_encode($value);
			}
		 }
		 
		 private function recoverSession(){
		 	if(isset($_SESSION['_APP'])){
		 		$this->sessionStatus = 1;
				$this->fillSessionData();
			}else
				$this->sessionStatus = 0;
		 }
		 
		 private function writeSessionData(){
		 	if($this->getSessionStatus()){
		 		$_SESSION['_APP']['data'] = $this->sessionData;
			}
		 }
		 	
        /**
         * Saída de dados
         * @param Element|string $value
         * @return void
         */
        public static function display($value){
			echo ($value instanceof Element) ? $value->toRender() :  $value;
        }
    }
