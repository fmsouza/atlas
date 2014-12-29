<?php
	/**
	 * Contains MySQL class
	 * @author Frederico Souza (fredericoamsouza@gmail.com)
	 * @author Julio Cesar (thisjulio@gmail.com)
	 * 
	 * @copyright Copyright 2013 Frederico Souza
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
    
    namespace system\control\database;
    
    use system\control\database\DatabaseDriver;
    use system\control\database\DatabaseResult;
    use system\control\error\DatabaseException;
	/**
	 * MySQL connection driver
	 * @package system
	 * @subpackage control_DATABASE
	 */
	class Mysql implements DatabaseDriver{
	
		/**
		 * @var $db Driver instance
		 */
		public $db;
		
		/**
		 * Configures MySQL connection driver
		 * @param array Server configuration data
		 * @throws DatabaseError
		 */
		public function __construct(array $connInf){
			try{
				if(empty($connInf["charset"])) $connInf["charset"] = 'utf8';
				$this->db = new mysqli($connInf["host"],$connInf["user"],$connInf["password"]);
				$this->db->autocommit(TRUE);
				$this->query("SET NAMES '{$connInf["charset"]}'"); 
				$this->query("SET character_set_connection={$connInf["charset"]}");
				$this->query("SET character_set_client={$connInf["charset"]}");
				$this->query("SET character_set_results={$connInf["charset"]}");
				$this->selectDatabase($connInf["dbName"]);
			}catch(ErrorException $e){
				$db = debug_backtrace();
	    		throw new DatabaseException($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line']);
			}
		}
		
		/**
		 * Select a database
		 * @param $dbName Database name
		 * @return bool
		 * @throws DatabaseError
		 */
		public function selectDatabase($dbName){
			if(!$this->db->select_db($dbName))
				throw new ErrorException("Database not found");
		}
		
		/**
		 * Executes an instruction
		 * @param string $sql SQL query string
		 * @return bool|DatabaseResult
		 * @throws DatabaseError
		 */
		public function query($sql){
			try{
				$r = $this->db->query($sql);
				if($r instanceof mysqli_result){
					$tmp = new DatabaseResult();
					while($tmp->setRow((array)$r->fetch_assoc()));
					unset($r);
					return $tmp;
				}
				return $r;
			}catch(ErrorException $e){
				$db = debug_backtrace();
	    		throw new DatabaseException($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line']);
			}
		}
		
		/**
		 * Starts a transaction
		 * @return void
		 */
		public function startTransaction(){
			$this->db->autocommit(FALSE);
		}
		
		/**
		 * closes a transaction
		 * @return void
		 */
		public function closeTransaction(){
			$this->db->autocommit(TRUE);
		}
		
		/**
		 * Commit changes to the database
		 * @return bool
		 */
		public function commit(){
			$this->db->commit();
		}
		
		/**
		 * Do the rollback
		 * @return bool
		 */
		public function rollback(){
			$this->db->rollback();
		}
		
		/**
		 * Return the number of affected rows
		 * @return int
		 */
		public function affectedRows(){
			return $this->db->affected_rows;
		}
	}
