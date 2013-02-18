<?php
    /**
     * 
     * Sistema de MVC do CISI
     * 
     * Através deste arquivo (index.php) são feitas todas as operações básicas de um sistema
     * MVC. Esse arquivo é conhecido como Controlador Principal, ele funciona como um ponto 
     * de entrada no sistema e gerencia todas as requisições. Portanto, todas os endereços passados
     * devem apontá-lo.
	 * 
	 * @ignore
     */
    session_start(); //Inicializa o serviço de sessão
    require_once("system/_GLOBAL.php"); // Chama a classe que com os endereços globais da aplicação
 	include(_GLOBAL::SYS_PATH()."/_EXCEPTION_ERROR_HANDLER.php"); // Inclui a captura de erros por exception
    include(_GLOBAL::SYS_PATH()."/_AUTOLOAD.php"); // Inclui o autoload
    
    /* ---------------------------------------------------------------------------------------------- */
	/*                                                                                                */
	/* Abaixo encontra-se o ciclo de vida da classe Main, esta está escrita sob o padrão Singleton    */
	/* Portanto garantimos uma única instância de Main durante toda a execução;                       */
	/*                                                                                                */
	/* ---------------------------------------------------------------------------------------------- */
	try{
		ob_start();
		$typeError=0;
		if(isset($_SESSION["_ERROR"])) { $typeError=1; FATAL_ERROR_CALL(); }
	    $APPLICATION=Main::getInstance(); // Constrói a Main
	    $APPLICATION->onStart();// Prepara a Main para ser executada
		$APPLICATION->onExecute();// Executa a aplicação 
		$APPLICATION->onFinish(); // Prepara a aplicação para ser morta	}catch(exception $e){
		ob_end_clean();
		ob_start();
		_ERROR::display($e,$typeError);
	}
