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
    //_GLOBAL::$DEBUG = false; // Muda as respostas de erro do sistema
    new _APP($_GET['r']); // Monta a aplicação carregada no arquivo _APP.php
    
// Fim do arquivo index.php