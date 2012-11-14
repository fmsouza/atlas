<?php

	class DatabaseResult{
		private $rows;
		private $cursor = -1;
		private $numRows;

		public function setRow(array $data){
			if(empty($data)) return FALSE;
			$this->rows[] = (object)$data;
			$this->numRows++;
			return TRUE;
		}
		
		public function getRow(){
			$this->cursor = ($this->cursor<$this->getNumRows()) ? $this->cursor+1 : $this->cursor; 
			return ($this->cursor==-1 || $this->cursor==$this->getNumRows()) ? NULL : $this->rows[$this->cursor];
		}

		public function getHeader(){
			return $this->header;
		}

		public function getNumRows(){
			return $this->numRows;
		}
		
		public function seek($i){
			$this->cursor = ($i>$this->getNumRows()) ? $this->cursor : $i;
		}
	}
