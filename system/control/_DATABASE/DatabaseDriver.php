<?php	
/**
* Interface de Driver do Banco de Dados 
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
* Interface de Driver do Banco de Dados
* @package system
* @subpackage control_DATABASE
*/
interface DatabaseDriver{
    /**
    * Recebe as configurações de acesso ao banco e conecta.
    * @param array
    * @return DatabaseDriver
    */
    public function __construct(array $connInf);
    
    /**
    * Executa uma instrução.
    * @param string
    * @return bool|DatabaseResult
    * @throws DatabaseError
    */
    public function query($sql);
    
    /**
    * Escolhe um banco no servidor
    * @param $dbName
    * @return bool
    * @throws DatabaseError
    */
    public function selectDatabase($dbName);
    
    /**
    * Inicia uma transação
    * @return void
    */
    public function startTransaction();
    
    /**
    * Encerra uma transação
    * @return void
    */
    public function closeTransaction();
    
    /**
    * Faz o commit das instruções para o SGBD.
    * @return bool
    */
    public function commit();
    
    /**
    * Faz o rollback
    * @return bool
    */
    public function rollback();
    
    /**
    * Retorna as linhas afetadas
    * @return int
    */
    public function affectedRows();
    
    /**
    * verifica se ocorreu erro em alguma instrução.
    * Deve ser utilizado na implementação de qualquer método query.
    * @return void
    * @throws DatabaseError
    */
    public function triggerError();
}
