<?php
/**
* Este arquivo contém o controlador de template HTML
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
* Esta classe contém o controlador de template HTML
* @package system
* @subpackage view_HTML
*/
class _HTML extends GenericElementsComposition {
	/**
	* @var array $headElements Array de Element's do head html 
	*/
	private $headElements;
	
	/**
	* Método construtor, carrega o construtor de ElementsComposition e inicializa o array com os elementos do header
	* @return void
	*/
	public function __construct(){
		parent::__construct("html",array());
		$this->headElements = array();
	}
	
	/**
	* Este método adiciona um Element ao header
	* @param Element $e Elemento a ser adicionado no head
	* @return void
	*/
	public function addToHeader(Element $e){
		$this->headElements[] = $e;
	}
	
	/**
	* Este método adiciona um Element ao body
	* @param Element $e Elemento a ser adicionado no body (É o mesmo que o método add($e))
	* @return void
	*/	
	public function addToBody(Element $e){
		parent::add($e);
	}
	
	/**
	* Este método gera uma string contendo o html referente aos objetos.
	* @return string
	*/
	public function toRender(){
		$html = "<html><head>";
		foreach($this->headElements as $headElement) $html .= $headElement->toRender();
		$html .= "</head><body>";
		foreach($this->getElements() as $element) $html .= $element->toRender();
		$html .= "</body></html>";
		return $html;
	}
}
