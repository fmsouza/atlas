<?php

namespace core\control\database;

use core\control\database\driver\DatabaseDriver;
use core\control\System;
use core\tools\designpattern\ISingleton;

/**
 * Configures the database interaction implementing Singleton Design Pattern
 * @package core\control\database
 */
class Database implements ISingleton{

	/** 
	 * Driver name
	 * @var string
	 */ 
	static public $selectDriver;
	/**
	 * Database connection configuration data
	 * @var array
	 */
	static private $connInf;
	/**
	 * Database Instance
	 * @var Database
	 */
	static private $instance;
	/**
	 * Driver instance
	 * @var mixed
	 */
	private $driver;
	
	/**
	 * Creates an instance of Database
	 * @param DatabaseDriver $d DatabaseDriver instance
	 * @return Database
	 */
	protected function __construct(DatabaseDriver $d){
		$this->driver = $d;
	}
	
	/**
	 * Selects a database
	 * @param string $dbName Database name
	 * @return bool
	 * @throws DatabaseException
	 */
	public function selectDatabase($dbName){
		return $this->driver->selectDatabase($dbName);
	}
	
	/**
	 * Returns an instance of Database object
	 * @return Database
	 * @throws DatabaseException
	 */
	static public function getInstance(){
		if(empty(self::$connInf)){
			self::$connInf = System::getConfig()->database->toArray();
		}
		if(empty(self::$selectDriver)){
			if(isset(self::$connInf['driver'])){
				self::$selectDriver = str_replace('.', '\\', self::$connInf['driver']);
			}
			else{
				$db = debug_backtrace()[0];
	    		throw new DatabaseException("Driver name not configured", 1, 0, $db['file'], $db['line']);
			}
		}

		if(is_null(self::$instance)){
			try{
				self::$instance = new Database(new self::$selectDriver(self::$connInf));
			}catch(\ErrorException $e){
				$db = debug_backtrace()[0];
	    		throw new DatabaseException($e->getMessage(), $e->getCode(), 0, $db['file'], $db['line']);
			}
		}
		return self::$instance;
	}
	
	/**
	 * Execute a SQL query
	 * @param string $sql SQL query string
	 * @return bool|DatabaseResult
	 * @throws DatabaseException
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

	/**
	 * @ignore
	 */
	public function __clone(){}
}
