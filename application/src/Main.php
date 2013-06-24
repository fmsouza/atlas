<?php
/**
* Classe principal controladora da aplicação.<br />
* <em>SEMPRE DEVE HAVER</em> um método onExecute(). Este sempre será chamado.<br /><br />
* Um dos pilares do MVC é a ideia de manter o HTML e o PHP bem separados, ou seja, não misturar o
* conteúdo estático e o dinâmico. Portanto, todo o conteúdo lógico deve ser escrito nas classes controladoras
* e substituído nas páginas HTML através da classe _HTML e suas aplicações.
* @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
* @author Julio Cesar (julio@cisi.coppe.ufrj.br)
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
* Classe principal controladora da aplicação.<br />
* <em>SEMPRE DEVE HAVER</em> um método onExecute(). Este sempre será chamado.<br /><br />
* Um dos pilares do MVC é a ideia de manter o HTML e o PHP bem separados, ou seja, não misturar o
* conteúdo estático e o dinâmico. Portanto, todo o conteúdo lógico deve ser escrito nas classes controladoras
* e substituído nas páginas HTML através da classe _HTML e suas aplicações.
* @package application
* @subpackage src
*/
class Main extends _APP{
	/**
	* @ignore
	*/
	public $LAYOUT;
	
	/**
	* Instruções para o início do ciclo de vida do sistema.
	* @return void
	*/
	public function onStart(){
		//_USER::$EMAIL_ADMIN="exemplo@email.com";
		//_GLOBAL::$DEBUG=FALSE;
		header("Content-Type: text/html; charset=utf-8");
		$this->LAYOUT = GenericElement::layoutInflater("helloMarvie.html");
	}
	
	/**
	* Instruções para a execução do sistema.
	* @return void
	*/
	public function onExecute(){
		$texto = $this->LAYOUT->getElementById("texto")->getElement(0);
		$texto->setText($texto->getText()." Se você Estiver vendo esta mensagem a instalação foi um sucesso.");
	}
	
	/**
	* Instruções para encerramento do ciclo de vida do sistema.
	* @return void
	*/
	public function onFinish(){
		Main::display($this->LAYOUT);
		unset($this->LAYOUT);
	}
}
