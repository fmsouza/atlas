<?php
    /**
     * Classe que representa um resultado de uma consulta realizada por um DatabaseDriver.
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     */
    /**
	 * Classe que representa um resultado de uma consulta realizada por um DatabaseDriver.
     * @package system
	 * @subpackage control_DATABASE
	 */
	class DatabaseResult{
	    
		/**
		 * @var array Array contendo todas as linhas do resultado de uma consulta
		 */
		private $rows;
		/**
		 * @var int Posição atual da linha
		 */
		private $cursor = -1;
		/**
		 * @var int Número de linhas
		 */
		private $numRows;

        /**
         * Adiciona uma nova linha ao resultado.
         * @param array
         * @return boolean
         */
		public function setRow(array $data){
			if(empty($data)) return FALSE;
			$this->rows[] = (object)$data;
			$this->numRows++;
			return TRUE;
		}
		
        /**
         * Retorna uma linha seguindo o percurso na estrutura da classe.
         * @return stdClass|NULL
         */
		public function getRow(){
			$this->cursor = ($this->cursor<$this->getNumRows()) ? $this->cursor+1 : $this->cursor; 
			return ($this->cursor==-1 || $this->cursor==$this->getNumRows()) ? NULL : $this->rows[$this->cursor];
		}

        /**
         * Retorna o número de linhas da consulta.
         * @return int
         */
		public function getNumRows(){
			return $this->numRows;
		}
		
        /**
         * Aponta o cursor para uma linha pelo índice.
         * @param int
         * @return void
         */
		public function seek($i){
			$this->cursor = ($i>$this->getNumRows()) ? $this->cursor : $i;
		}
	}
