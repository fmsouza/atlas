<?php
/**
 * 
 * Driver MySQL
 * 
 * Possui todas as configurações de interação com um banco de dados MySQL
 * 
 * @author Frederico Souza
 * @method __construct
 * @method sql
 * @method query
 * @method fetch_object
 * @method num_rows
 * @method connect
 * @method select_db
 * @method error
 *
 */
class Mysql{
	
	function __construct(){
		if($link = $this->connect(Database::hostname, Database::username, Database::password)){
			if(!$this->select_db(Database::dbname,$link))
				exit("Não foi possível selecionar o banco desejado.");
		}
		else exit("Não foi possível conectar com o banco de dados com as informações fornecidas.");
	}
	/**
	 * 
	 * Recebe uma string de consulta SQL como parâmetro e retorna um objeto com os dados
	 * @param string $query
	 */
	public function sql($query){
		if($this->query = $this->query($query)){
			$this->obj = $this->fetch_object($this->query);
			$this->obj->last_query = $query;
			$this->obj->num_rows = $this->num_rows($this->query);
			return $this->obj;
		}
		else die("Erro na query: ".$this->error());
	}
	/**
	 * 
	 * Recebe uma consulta SQL e retorna a consulta
	 * @param string $sql
	 */
	public function query($sql){
		return mysql_query($sql);
	}
	/**
	 * 
	 * Recebe uma consulta SQL como parâmetro e retorna um objeto com os dados dela
	 * @param $query
	 */
	private function fetch_object($query){
		return mysql_fetch_object($query);
	}
	/**
	 * 
	 * Recebe uma consulta SQL como parâmetro e retorna o seu número de linhas
	 * @param $query
	 */
	public function num_rows($query){
		return mysql_num_rows($query);
	}
	/**
	 * 
	 * Recebe o endereço do servidor, usuário e senha e retorna uma conexão com o banco
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 */
	private function connect($host,$user,$pass){
		return mysql_connect($host,$user,$pass);
	}
	/**
	 * 
	 * Recebe o nome do banco e uma conexão e seleciona um banco
	 * @param string $db
	 * @param $link
	 */
	private function select_db($db,$link){
		return mysql_select_db($db,$link);
	}
	/**
	 * 
	 * Retorna uma mensagem de erro
	 */
	public function error(){
		return mysql_error();
	}
}

//Fim do arquivo mysql.php