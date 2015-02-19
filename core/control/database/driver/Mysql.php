<?php

namespace core\control\database\driver;

use core\control\database\DatabaseException;
use core\control\database\Database;
use core\control\database\DatabaseResult;

/**
 * MySQL connection driver
 * @package core\control\database
 */
class Mysql extends \mysqli implements DatabaseDriver{
	
	/**
	 * Configures MySQL connection driver
	 * @param $connInf array Server configuration data
	 * @throws DatabaseException
	 * @return Mysql
	 */
	public function __construct(array $connInf){
		try{
			if(empty($connInf["charset"])) $connInf["charset"] = 'utf8';
			parent::__construct($connInf["host"],$connInf["user"],$connInf["password"]);
			$this->autocommit(TRUE);
			$this->query("SET NAMES '{$connInf["charset"]}'"); 
			$this->query("SET character_set_connection={$connInf["charset"]}");
			$this->query("SET character_set_client={$connInf["charset"]}");
			$this->query("SET character_set_results={$connInf["charset"]}");
			$this->selectDatabase($connInf["dbName"]);
		}catch(\ErrorException $e){
			$db = debug_backtrace()[0];
    		throw new DatabaseException($e->getMessage(), $e->getCode(), 0, $db['file'], $db['line']);
		}
	}
	
	/**
	 * Select a database
	 * @param $dbName Database name
	 * @return bool
	 * @throws DatabaseException
	 */
	public function selectDatabase($dbName){
		if(!$this->select_db($dbName))
			throw new DatabaseException("Database not found");
	}
	
	/**
	 * Executes an instruction
	 * @param string $sql SQL query string
	 * @return bool|DatabaseResult
	 * @throws DatabaseException
	 */
	public function query($sql){
		try{
			$result = parent::query($sql);
			if($result instanceof \mysqli_result){
				$tmp = new DatabaseResult();
				while($tmp->setRow((array)$result->fetch_assoc()));
				unset($result);
				return $tmp;
			} elseif(!$result) throw new \ErrorException("There's an error in your SQL statement.");
		}catch(\ErrorException $e){
			$db = debug_backtrace()[0];
    		throw new DatabaseException($e->getMessage(), $e->getCode(), 0, $db['file'], $db['line']);
		}
	}
	
	/**
	 * Starts a transaction
	 * @return void
	 */
	public function startTransaction(){
		parent::autocommit(FALSE);
	}
	
	/**
	 * closes a transaction
	 * @return void
	 */
	public function closeTransaction(){
		parent::autocommit(TRUE);
	}
	
	/**
	 * Return the number of affected rows
	 * @return int
	 */
	public function affectedRows(){
		return $this->affected_rows;
	}
}