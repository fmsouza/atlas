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
	 * Set a new row to the result object
	 * @param array $data Data array
	 * @return boolean
	 */
	public function setRow(array $data){
		if(empty($data)) return false;
		$this->rows[] = (object) $data;
		$this->numRows++;
		return true;
	}

	/**
	 * Sets all rows to the result object
	 * @param array $data
	 * @return boolean
	 */
	public function setRows(array $data){
		if(empty($data)) return false;
        $tmp = [];
        foreach($data as $row) $tmp[] = (object) $row;
        $this->rows = $tmp;
        $this->numRows = count($this->rows);
		return true;
	}
	
	/**
	 * Returns a new data row
	 * @return \stdClass
	 */
	public function getRow(){
		$this->cursor = ($this->cursor<$this->getNumRows()) ? $this->cursor+1 : $this->cursor; 
		return ($this->cursor==-1 || $this->cursor==$this->getNumRows()) ? null : $this->rows[$this->cursor];
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