<?php
/**
 * Contains DatabaseResult class
 * 
 * @copyright Copyright 2013 Marvie
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
    
	/**
	 * Represents the result of a query run by a DatabaseDriver.
	 * @package system\control\database
	 */
	class DatabaseResult{
	
		/**
		 * @var array Query result array
		 */
		private $rows;
		/**
		 * @var int Current line position counter
		 */
		private $cursor = -1;
		/**
		 * @var int Number of rows
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
		 * @return stdClass|NULL
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
		 * Points the cursor to the especified line
		 * @param int
		 * @return void
		 */
		public function seek($i){
			$this->cursor = ($i>$this->getNumRows()) ? $this->cursor : $i;
		}
	}
