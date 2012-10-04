<?php
    require_once("system/_GLOBAL.php"); // Chama a classe que com os endereços globais da aplicação
    require(_GLOBAL::CTRL_PATH().'/_APP.php'); // Inclui o core da aplicação
    //_GLOBAL::$DEBUG = false; // Muda as respostas de erro do sistema
    new _APP($_GET['r']); // Monta a aplicação carregada no arquivo _APP.php