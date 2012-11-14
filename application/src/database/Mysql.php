<?php
	
	/**
     * Driver de conexão com bancos de dados MySQL.
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @method query
     * @method selectDatabase
     * @method startTransaction
     * @method commit
     * @method rollback
     * @method affectedRows
     * @method triggerError
     */
	class Mysql implements DatabaseDriver{
	    
		public $db;
        
		public function __construct(array $connInf){
			try{
				$this->db = new mysqli($connInf["host"],$connInf["user"],$connInf["password"]);
				$this->db->autocommit(TRUE);
			}catch(ErrorException $e){
				throw new DatabaseError($e->getMessage(),$e->getCode());
			}
		}
        
        /**
         * verifica se ocorreu erro em alguma instrução.
         * Deve ser utilizado na implementação de qualquer método query.
         * @return void
         * @throws DatabaseError
         */
		public function triggerError(){
			if($this->db->errno) throw new DatabaseError($this->db->error,$this->db->errno);
		}
        
        /**
         * Escolhe um banco no servidor
         * @param $dbName
         * @return bool
         * @throws DatabaseError
         */
		public function selectDatabase($dbName){
			$r = $this->db->select_db($dbName);
			$this->triggerError();
			return $r;
		}
        
        /**
         * Executa uma instrução.
         * @param string
         * @return bool|DatabaseResult
         * @throws DatabaseError
         */
		public function query($sql){
			$r = $this->db->query($sql);
			$this->triggerError();
			if($r instanceof mysqli_result){
				$tmp = new DatabaseResult();
				while($tmp->setRow((array)$r->fetch_assoc()));
				unset($r);
				return $tmp;
			}
			return $r;
		}
        
        /**
         * Inicia uma transação
         * @return void
         */
		public function startTransaction(){
			$this->db->autocommit(FALSE);
		}
        
        /**
         * Faz o commit das instruções para o SGBD.
         * @return bool
         */
		public function commit(){
			$this->db->commit();
		}
        
        /**
         * Faz o rollback
         * @return bool
         */
		public function rollback(){
			$this->db->rollback();
		}
        
        /**
         * Retorna as linhas afetadas
         * @return int
         */
		public function affectedRows(){
			return $this->db->affected_rows;
		}
	}
