<?php
	
	/**
     * Interface de Driver do Banco de Dados
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
