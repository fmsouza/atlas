<?php
	/**
     * Configura uma interação com banco de dados implementando a Design Pattern Singleton.
     * @author Frederico Souza (fmsouza@cisi.cppe.ufrj.br)
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
	 */
	 /**
	  * Configura uma interação com banco de dados implementando a Design Pattern Singleton.
     * @package system
	 * @subpackage control_DATABASE
	  */
	class Database implements _SINGLETON{
		
	   /** 
	 	* @var string Nome do driver selecionado
	    */ 
		static public $selectDriver;
		/**
	 	 * @var array Array com os dados de conexão
		 */
		static public $connInf;
		/**
		 * @var Database Instância do objeto Database
		 */
		static private $instance;
		/**
		 * @var mixed Instância do driver utilizado
		 */
		private $driver;
        
        /**
         * Recebe as configurações de acesso ao banco e conecta.
         * @param DatabaseDriver $d Instancia de conexão com o banco de dados
         * @return void
         */
		protected function __construct(DatabaseDriver $d){
			$this->driver = $d;
		}
        
        /**
         * Escolhe um banco no servidor
         * @param string $dbName Nome do banco de dados
         * @return bool
         * @throws DatabaseError
         */
        public function selectDatabase($dbName){
			return $this->driver->__FUNCTION__($dbName);
		}

        /**
         * Retorna a instãncia do banco caso exista ou a cria, caso contrário.
         * @return Database
         */
		static public function getInstance(){
		    if(empty(self::$selectDriver)) self::$selectDriver = self::$connInf['driver'];
			if(is_null(self::$instance)){
				self::$instance = new Database(new self::$selectDriver(self::$connInf));
				self::$instance->selectDatabase(self::$connInf['db_name']);
			}
			return self::$instance;
		}
		
		/**
         * Executa uma instrução sql.
         * @param string $sql String de consulta da query
         * @return bool|DatabaseResult
         * @throws DatabaseError
         */
		public function query($sql){
			return $this->driver->query($sql);
		}
        
        /**
         * Inicia uma transação
         * @return void
         */
		public function startTransaction(){
			$this->driver->startTransaction(); 
		}
        
        /**
         * Faz o commit das instruções para o SGBD.
         * @return bool
         */
		public function commit(){
			return $this->driver->commit();
		}
        
        /**
         * Faz o rollback
         * @return bool
         */
		public function rollback(){
			return $this->driver->rollback();
		}
        
        /**
         * Retorna as linhas afetadas
         * @return int
         */
		public function affectedRows(){
			return $this->driver->affectedRows();
		}
	}
