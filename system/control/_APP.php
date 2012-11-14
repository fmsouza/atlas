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
        protected function __construct(){
        	$this->construct();
        }

        /**
         * Constrói a aplicação
         * @return void
         */
		protected function construct(){
			self::$mRequest = (isset($_GET['r']) && $_GET['r']!="execute") ? $_GET['r'] : "";
			self::$args = isset($_GET['args']) ? explode("/",$_GET['args']) : array();
		}

		public function pre(){}
        
		public function post(){}
		
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
         * Saída de dados
         * @param Element|string $value
         * @return void
         */
        public static function display($value){
			echo ($value instanceof Element) ? $value->toRender() :  $value;
        }
    }
