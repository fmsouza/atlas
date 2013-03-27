<?php
/**
* Classe que armazena as configurações do ambiente <br />
* Adicione nesta classe métodos que possam ajudar na parametrização da sua aplicação
* @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
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
* Classe que armazena as configurações do ambiente <br />
* Adicione nesta classe métodos que possam ajudar na parametrização da sua aplicação
* @package application
* @subpackage environment
*/
class Config{
    /**
    * Retorna o endereço base da aplicação na web
    * @return string
    */
    public static function base_url(){
	return "http://{$_SERVER['SERVER_NAME']}/~fmsouza/cisimvc/";
    }
    
    /**
    * Retorna um array com os dados de configuração de acesso ao banco de dados. 
    * Complete este array com os respectivos valores de configuração do seu banco de dados seguindo o padrão:
    * {'chave'=>'valor'}
    * @return array
    */
    public static function db_config(){ // Configurações de acesso ao banco de dados
	return array(
	    'host'       => '',
	    'user'       => '',
	    'password'   => '',
	    'db_name'    => '',
	    'tbl_prefix' => '',
	    'charset'    => '',
	    'driver'     => '',
	);
    }
}