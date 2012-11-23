<?php
	
	/**
     * Configura uma interação com banco de dados implementando a Design Pattern Singleton.
     * 
     * @author Frederico Souza (fmsouza@cisi.cppe.ufrj.br)
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @param DatabaseDriver
     * 
     * @method selectDatabase
     * @method @static getInstance
     * @method query
     * @method startTransacion
     * @method commit
     * @method rollback
     * @method affectedRows
     */
	class Database implements _SINGLETON{
	    
		static public $selectDriver;
		static public $connInf;
		static private $instance;
		private $driver;
        
        /**
         * Recebe as configurações de acesso ao banco e conecta.
         * @param array
         * @return DatabaseDriver
         */
		protected function __construct(DatabaseDriver $d){
			$this->driver = $d;
		}
        
        /**
         * Escolhe um banco no servidor
         * @param $dbName
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
			if(is_null(self::$instance))
				self::$instance = new self::$selectDriver(self::$connInf);
			return self::$instance;
		}
		
		/**
         * Executa uma instrução.
         * @param string
         * @return bool|DatabaseResult
         * @throws DatabaseError
         */
		public function query($sql){
			return $this->driver->__FUNCTION__($sql);
		}
        
        /**
         * Inicia uma transação
         * @return void
         */
		public function startTransaction(){
			$this->driver->__FUNCTION__(); 
		}
        
        /**
         * Faz o commit das instruções para o SGBD.
         * @return bool
         */
		public function commit(){
			return $this->driver->__FUNCTION__();
		}
        
        /**
         * Faz o rollback
         * @return bool
         */
		public function rollback(){
			return $this->driver->__FUNCTION__();
		}
        
        /**
         * Retorna as linhas afetadas
         * @return int
         */
		public function affectedRows(){
			return $this->driver->__FUNCTION__();
		}
	}
