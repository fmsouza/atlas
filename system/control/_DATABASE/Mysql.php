<?php	
/**
* Driver de conexão com bancos de dados MySQL. 
* @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
* @author Julio Cesar (julio@cisi.coppe.ufrj.br)
* 
* @copyright Copyright 2012 COPPE
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
/**
* Driver de conexão com bancos de dados MySQL.
* @package system
* @subpackage control_DATABASE
*/
class Mysql implements DatabaseDriver{

	/**
	* @var mysqli Instância de mysqli
	*/
	public $db;
	
	/**
	* Construtor do driver Mysql
	* @param array Array de configurações de acesso ao banco MySQL
	* @throws DatabaseError
	*/
	public function __construct(array $connInf){
		try{
			if(empty($connInf["charset"])) $connInf["charset"] = 'utf8';
			$this->db = new mysqli($connInf["host"],$connInf["user"],$connInf["password"]);
			$this->db->autocommit(TRUE);
			$this->query("SET NAMES '{$connInf["charset"]}'"); 
			$this->query("SET character_set_connection={$connInf["charset"]}"); 
			$this->query("SET character_set_client={$connInf["charset"]}"); 
			$this->query("SET character_set_results={$connInf["charset"]}"); 
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
	* Encerra uma transação
	* @return void
	*/
	public function closeTransaction(){
		$this->db->autocommit(TRUE);
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
