<?php
if(!class_exists('Config')):

/**
 * 
 * Classe Config
 * 
 * Armazena as configurações da aplicação
 * 
 * 
 * @author Frederico Souza
 *
 */
class Config{
	const charset		= 'UTF-8';
	const base_url		= 'http://localhost/';
	const main_method	= 'index';
	const load_database = true;
}

endif;

//Fim do arquivo config.php