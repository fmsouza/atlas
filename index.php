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
    require(_GLOBAL::CTRL_PATH().'/_APP.php'); // Inclui o core da aplicação
    include(_GLOBAL::SYS_PATH()."/_AUTOLOAD.php"); // Inclui o autoload
 	include(_GLOBAL::SYS_PATH()."/_EXCEPTION_ERROR_HANDLER.php"); // Inclui a captura de erros por exception   
    /* ----------------------------------------------------------------------------------------------
	 * 
	 * BLABLABLA 
	 * 
	 * ---------------------------------------------------------------------------------------------- */
    $APPLICATION = Main::get(); // Constroi a Main
    
    $APPLICATION->pre(); // Prepara a Main para ser executada
	
	$APPLICATION->execute(); // Executa a aplicação 
	
	$APPLICATION->post(); // Prepara a aplicação para ser morta
