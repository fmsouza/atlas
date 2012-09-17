<?php define('DEGUB', true); //Definição do ambiente atual
	  define('APP_PATH', 'app'); //Caminho (diretório) dos arquivos da aplicação
	  define('SYS_PATH', 'sys'); //Caminho do core do sistema
	  require(SYS_PATH.'/mvc.php'); // Inclui o core da aplicação

$app->run(); // Roda a Aplicação
