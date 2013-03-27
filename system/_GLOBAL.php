<?php
/**
* Este arquivo contém as configurações globais do sistema
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
* Esta classe contém as configurações globais do sistema
* @package system
*/
class _GLOBAL{
	/**
	* @var bool $DEBUG Estado do modo de depuração. Caso esteja true os erros serão exibidos na tela do programador.
	*/
	public static $DEBUG = TRUE;
	
	/**
	* Retorna o endereço base da aplicação
	* @return string
	*/
	public static function BASE(){
		return getcwd();
	}
	
	/**
	* Caminho do diretório system
	* @return string
	*/
	public static function SYS_PATH(){
		return self::BASE()."/system";
	}
	
	/**
	* Caminho das classes do ambiente
	* @return string
	*/
	public static function ENV_PATH(){
		return self::SYS_PATH()."/environment";
	}
	
	/**
	* Caminho das classes de controle
	* @return string
	*/
	public static function CTRL_PATH(){
		return self::SYS_PATH()."/control";
	}
	
	/**
	* Caminho das classes de views
	* @return string
	*/
	public static function VIEW_PATH(){
		return self::SYS_PATH()."/view";
	}
	
	/**
	* Array com os caminhos de todas as classes globais
	* @return array
	*/
	public static function ALL_PATHS(){
		return array(
			'BASE'      		=> self::BASE(),
			'SYS_PATH'  		=> self::SYS_PATH(),
			'ENV_PATH'  		=> self::ENV_PATH(),
			'CTRL_PATH' 		=> self::CTRL_PATH(),
			'DATABASE'		=> self::CTRL_PATH()."/_DATABASE",
			'CTRL_TOOLS'	        => self::CTRL_PATH()."/_TOOLS",
			'TOOL_PHPMailer'	=> self::CTRL_PATH()."/_TOOLS/PHPMailer",
			'TOOL_html2pdf' 	=> self::CTRL_PATH()."/_TOOLS/html2pdf",
			'VIEW_PATH' 		=> self::VIEW_PATH(),
			'_HTML'			=> self::VIEW_PATH()."/_HTML"
		);
	}
}
