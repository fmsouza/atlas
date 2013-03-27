<?php
/**
* Funções para o controle de erros do sistema
* @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
* @author Julio Cesar (julio@cisi.coppe.ufrj.br)
* @package system
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
*/
/**
* Função manipuladora de exceções.
* @param int $errno
* @param string $errstr
* @param string $errfile
* @param $errline
* @throws ErrorException
*/
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}

/**
* Função que possibilita a captura de erros fatais
* @return void
*/
function CatchFatalError() {
    $E = error_get_last();
    $error =  base64_encode(serialize((object)$E));
    if ($E['type'] != 0){ $_SESSION['_ERROR']=$error; header("location: .");}
}

/**
* Lança uma exceção quando algum erro ocorre
* @return void
* @throws ErrorException
*/
function FATAL_ERROR_CALL(){
    $error = unserialize(base64_decode($_SESSION["_ERROR"]));
    unset($_SESSION["_ERROR"]);
    throw new ErrorException($error->message,$error->type,0,"{$error->file}", $error->line);
}
set_error_handler("exception_error_handler");
register_shutdown_function('CatchFatalError');