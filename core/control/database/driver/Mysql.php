<?php

namespace core\control\database\driver;

use core\control\database\DatabaseException;
use core\control\database\Database;
use core\control\database\DatabaseResult;

/**
 * MySQL connection driver
 * @package core\control\database
 */
class Mysql implements DatabaseDriver{

	/**
	 * Driver instance
	 * @var $db
	 */
	public $db;
	
	/**
	 * Configures MySQL connection driver
	 * @param $connInf array Server configuration data
	 * @throws DatabaseException
	 * @return Mysql
	 */
	public function __construct(array $connInf){
		try{
			if(empty($connInf["charset"])) $connInf["charset"] = 'utf8';
			$this->db = new \mysqli($connInf["host"],$connInf["user"],$connInf["password"]);
			$this->db->autocommit(TRUE);
			$this->query("SET NAMES '{$connInf["charset"]}'"); 
			$this->query("SET character_set_connection={$connInf["charset"]}");
			$this->query("SET character_set_client={$connInf["charset"]}");
			$this->query("SET character_set_results={$connInf["charset"]}");
			$this->selectDatabase($connInf["dbName"]);
		}catch(\ErrorException $e){
			$db = debug_backtrace();
    		throw new DatabaseException($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line']);
		}
	}
	
	/**
	 * Select a database
	 * @param $dbName Database name
	 * @return bool
	 * @throws DatabaseException
	 */
	public function selectDatabase($dbName){
		if(!$this->db->select_db($dbName))
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
			$r = $this->db->query($sql);
			// TODO: this is weird. If it's not \mysqli_result you just return? Check it later.
			if($r instanceof \mysqli_result){
				$tmp = new DatabaseResult();
				while($tmp->setRow((array)$r->fetch_assoc()));
				unset($r);
				return $tmp;
			}
			return $r;
		}catch(\ErrorException $e){
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