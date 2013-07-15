<?php
/** 
* Este arquivo contém as variáveis de caminho para aplications
* @author Julio Cesar (julio@cisi.coppe.ufrj.br)
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
* Este arquivo contém as variáveis de caminho para aplications
* @package system
* @subpackage environment
*/
class _USER{
	/**
	* @var string Endereço de e-mail do administrador do sistema: a quem serão enviados os e-mails em caso de erro.
	*/
	public static $EMAIL_ADMIN = 'admin@domain.com';
	
	/**
	* Retorna o caminho da base global
	* @return string
	*/
	public static function BASE(){
		return _GLOBAL::BASE();
	}
	
	/**
	* Retorna o endereço do diretório da aplicação
	* @return string
	*/
	public static function HOME(){
		return self::BASE()."/application";
	}
	
	/**
	* Retorna o endereço das classes de configurações do ambiente do usuário
	* @return string
	*/
	public static function ENV(){
		return self::BASE()."/application/environment";
	}
	
	/**
	* Retorna o endereço do diretório dos arquivos de views do sistema
	* @return string
	*/
	public static function VIEW(){
		return self::BASE()."/application/view";
	}
	
	/**
	* Retorna o endereço do diretório de classes principais do sistema
	* @return string
	*/
	public static function SRC(){
		return self::BASE()."/application/src";
	}
	
	/**
	* Array com os caminhos de todas as classes da aplicação
	* @return array
	*/
	public static function ALL_PATHS(){
		return array(
			'BASE'  => self::BASE(),
			'HOME'  => self::HOME(),
			'ENV'   => self::ENV(),
			'VIEW'  => self::VIEW(),
			'SRC'   => self::SRC()
		);
	}
}