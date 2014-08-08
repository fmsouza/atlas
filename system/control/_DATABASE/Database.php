<?php
	/**
	 * Contains Database class
	 * @author Frederico Souza (fredericoamsouza@gmail.com)
	 * @author Julio Cesar (thisjulio@gmail.com)
	 * 
	 * @copyright Copyright 2012 COPPE
	 * Licensed under the Apache License, Version 2.0 (the “License”);
	 * you may not use this file except in compliance with the License.
	 * You may obtain a copy of the License at
	 * http://www.apache.org/licenses/LICENSE-2.0
	 * Unless required by applicable law or agreed to in writing, software
	 * distributed under the License is distributed on an “AS IS” BASIS,
	 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	 * See the License for the specific language governing permissions and
	 * limitations under the License.
	 */
	/**
	 * Configures the database interaction implementing Singleton Design Pattern
	 * @package system
	 * @subpackage control_DATABASE
	 */
	class Database implements _SINGLETON{
	
		/** 
		 * @var string Driver name
		 */ 
		static public $selectDriver;
		/**
		 * @var array Database connection configuration data
		 */
		static public $connInf;
		/**
		 * @var Database Database Instance
		 */
		static private $instance;
		/**
		 * @var mixed Driver instance
		 */
		private $driver;
		
		/**
		 * Creates an instance of Database
		 * @param DatabaseDriver $d DatabaseDriver instance
		 * @return void
		 */
		protected function __construct(DatabaseDriver $d){
			$this->driver = $d;
		}
		
		/**
		 * Selects a database
		 * @param string $dbName Database name
		 * @return bool
		 * @throws DatabaseError
		 */
		public function selectDatabase($dbName){
			return $this->driver->selectDatabase($dbName);
		}
		
		/**
		 * Returns an instance of Database object
		 * @return Database
		 */
		static public function getInstance(){
			if(empty(self::$selectDriver))
				if(isset(self::$connInf['driver'])) self::$selectDriver = self::$connInf['driver'];
				else{
					$db = debug_backtrace();
		    		throw new DatabaseException("Driver name not configured", 1, 0, $db[0]['file'], $db[0]['line']);
				}
				
	
			if(is_null(self::$instance)){
				try{
					self::$instance = new Database(new self::$selectDriver(self::$connInf));
					self::$instance->selectDatabase(self::$connInf['db_name']);
				}catch(ErrorException $e){
					$db = debug_backtrace();
		    		throw new DatabaseException($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line'] );
				}
			}
			return self::$instance;
		}
		
		/**
		 * Execute a SQL query
		 * @param string $sql SQL query string
		 * @return bool|DatabaseResult
		 * @throws DatabaseError
		 */
		public function query($sql){
			return $this->driver->query($sql);
		}
		
		/**
		 * Starts a transaction
		 * @return void
		 */
		public function startTransaction(){
			$this->driver->startTransaction(); 
		}
		
		/**
		 * Closes a transaction
		 * @return void
		 */
		public function closeTransaction(){
			$this->driver->closeTransaction(); 
		}
		
		/**
		 * Commits the transaction queries
		 * @return bool
		 */
		public function commit(){
			return $this->driver->commit();
		}
		
		/**
		 * Do the rollback
		 * @return bool
		 */
		public function rollback(){
			return $this->driver->rollback();
		}
		
		/**
		 * Return the number of affected rows
		 * @return int
		 */
		public function affectedRows(){
			return $this->driver->affectedRows();
		}
	}
