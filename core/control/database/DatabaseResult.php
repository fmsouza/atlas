<?php

namespace core\control\database;

/**
 * Represents the result of a query run by a DatabaseDriver.
 * @package core\control\database
 */
class DatabaseResult{

	/**
	 * Query result array
	 * @var array
	 */
	private $rows;
	/**
	 * Current line position counter
	 * @var int
	 */
	private $cursor = -1;
	/**
	 * Number of rows
	 * @var int
	 */
	private $numRows;
	
	/**
	 * Set a new row to the result
	 * @param array $data Data array
	 * @return boolean
	 */
	public function setRow(array $data){
		if(empty($data)) return FALSE;
		$this->rows[] = (object)$data;
		$this->numRows++;
		return TRUE;
	}
	
	/**
	 * Returns a new data row
	 * @return \stdClass|NULL
	 */
	public function getRow(){
		$this->cursor = ($this->cursor<$this->getNumRows()) ? $this->cursor+1 : $this->cursor; 
		return ($this->cursor==-1 || $this->cursor==$this->getNumRows()) ? NULL : $this->rows[$this->cursor];
	}
	
	/**
	 * Returns the number of lines of the query result
	 * @return int
	 */
	public function getNumRows(){
		return $this->numRows;
	}
	
	/**
	 * Points the cursor to the given line
	 * @param int $i Line index
	 * @return void
	 */
	public function seek($i){
		$this->cursor = ($i>$this->getNumRows()) ? $this->cursor : $i;
	}
}