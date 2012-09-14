<?php define('ENVIRONMENT', 'development'); //Definição do ambiente atual
	  define('APP_PATH', 'app'); //Caminho (diretório) dos arquivos da aplicação
	  define('SYS_PATH', 'sys'); //Caminho do core do sistema
	  require('sys/mvc.php'); // Inclui o core da aplicação

switch(ENVIRONMENT){ 
	/**
	 *  Verifica qual o ambiente ativo para habilitar ou não a exibição
	 *  de erros do PHP.
	 */ 
	case 'development':
		error_reporting(E_ALL);
		break;
	
	case 'testing':
		error_reporting(E_ALL);
		break;
		
	case 'production':
		error_reporting(0);
		break;
}
$app->run(); // Roda a Aplicação
