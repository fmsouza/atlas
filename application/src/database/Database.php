<?php
	
	class Database implements Singleton{
		static public $selectDriver;
		static public $connInf;
		static private $instance;
		
		private $driver;
		
		protected function __construct(DatabaseDriver $d){
			$this->driver = $d;
		}

		public function selectDatabase($dbName){
			return $this->driver->selectDatabase($dbName);
		}

		static public function getInstance(){
			if(is_null(self::$instance))
				self::$instance = new self::$selectDriver(self::$connInf);
			return self::$instance;
		}
		
		/**
		  * @param string $sql
		  * @return True,False,DatabaseResult
		  * @throw Database
		  */
		public function query($sql){
			return $this->driver->query($sql);
		}

		public function startTransaction(){
			$this->driver->startTransaction(); 
		}

		public function commit(){
			return $this->driver->commit();
		}

		public function rollback(){
			return $this->driver->rollback();
		}

		public function affectedRows(){
			return $this->driver->affectedRows();
		}
	}
