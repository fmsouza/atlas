<?php  if(!class_exists('Database')):

/**
 * 
 * Classe Database
 * 
 * Armazena as configurações do banco de dados e do
 * servidor ativo.
 * 
 * @author Frederico Souza
 *
 */
class Database{
	const hostname	= 'localhost';
	const username	= 'root';
	const password	= '71553736';
	const dbname	= 'geocart_emprestimos';
	const prefix	= '';
	const driver	= 'mysql';
}

endif;

//Fim do arquivo database.php