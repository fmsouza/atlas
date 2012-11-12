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
     */
    require_once("system/_GLOBAL.php"); // Chama a classe que com os endereços globais da aplicação
    include(_GLOBAL::SYS_PATH()."/_AUTOLOAD.php"); // Inclui o autoload
    //require(_GLOBAL::CTRL_PATH().'/_APP.php'); // Inclui o core da aplicação
 	include(_GLOBAL::SYS_PATH()."/_EXCEPTION_ERROR_HANDLER.php"); // Inclui a captura de erros por exception   
    /* ----------------------------------------------------------------------------------------------
	 * 
	 * Abaixo encontra-se o ciclo de vida da classe  Main, esta está escrita sob o padrão Singleton
	 * Portanto garantimos uma única instancia de Main durante toda a execução;
	 * 
	 * ---------------------------------------------------------------------------------------------- */
    $APPLICATION=Main::getInstance(); // Constroi a Main
    
    $APPLICATION->pre();// Prepara a Main para ser executada
	
	$APPLICATION->execute();// Executa a aplicação 
	
	$APPLICATION->post(); // Prepara a aplicação para ser morta
