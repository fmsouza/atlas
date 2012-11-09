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
    abstract class _APP{

        static private $instance;
		static public $mRequest;
		static public $args;
		static public $db;
		
		abstract public function execute();

        /**
         * Carrega as classes necessárias e roda a aplicação
         * @param string $route
         * @return void
         */
        private function __construct(){
        	$this->construct();
        }

		protected function construct(){
			self::$mRequest = (isset($_GET['r']) && $_GET['r']!="execute") ? $_GET['r'] : "index";
			self::$args = isset($_GET['args']) ? explode("/",$_GET['args']) : array();
		}

		public function pre(){}
        
		public function post(){}
		
		protected function destroy(){
			self::$mRequest = NULL;
			self::$args = NULL;
			self::$instance = NULL;
		}
		      
		public function __destruct(){
			$this->destroy();
		}

		public function __clone(){}

		static public function get(){
			if(is_null(self::$instance))
				self::$instance = new Main();
			return self::$instance;
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
