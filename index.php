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
* @copyright Copyright 2012 COPPE
* Licensed under the Apache License, Version 2.0 (the “License”);
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
* http://www.apache.org/licenses/LICENSE-2.0
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an “AS IS” BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
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
	$APPLICATION->onFinish(); // Prepara a aplicação para ser morta}catch(exception $e){
	ob_end_clean();
	ob_start();
	_ERROR::display($e,$typeError);
}
