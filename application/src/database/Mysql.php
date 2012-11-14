<?php
	
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

		public function triggerError(){
			if($this->db->errno) throw new DatabaseError($this->db->error,$this->db->errno);
		}

		public function selectDatabase($dbName){
			$r = $this->db->select_db($dbName);
			$this->triggerError();
			return $r;
		}

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
		
		public function startTransaction(){
			$this->db->autocommit(FALSE);
		}

		public function commit(){
			$this->db->commit();
		}

		public function rollback(){
			$this->db->rollback();
		}

		public function affectedRows(){
			return $this->db->affected_rows;
		}
	}
