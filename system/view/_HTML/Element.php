<?php
/**
* Esta é a classe básica e abstrata de objetos html para serem carregados em view
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
* Esta é a classe básica e abstrata de objetos html para serem carregados em view
* @package system
* @subpackage view_HTML
*/
abstract class Element {
	/**
	* @var DOMDocument $DOC Document de toda a saída gerada
	*/
	protected static $DOC = NULL;
	/**
	* @var DOMElement $domElement elemento em padrão dom
	*/
	protected $domNode;
	
	/**
	* Constrói um novo elemento
	*/
	public function __construct(){
		if(is_null(self::$DOC))
			self::$DOC = new DOMDocument;
	}
	
	/**
	* Este método retorna o nome do elemento
	* @return string
	*/
	public function getElementName(){
		return $this->domNode->nodeName;
	}
	
	/**
	* @ignore
	*/
	protected static function getAttributesDOMtoArray(DOMElement $node){
		$return = array();
		foreach($node->attributes as $att) $return[$att->name]=$att->value;
		return $return;
	}
	
	/**
	* @ignore
	*/ 
	static protected function constructTextByNode(DOMText $text){
		return new TextElement(NULL,$text);
	}
	
	/**
	* Este método deverá gerar uma string contendo o html referente aos objetos.
	* @return string
	*/
	public function toRender(){
		return self::$DOC->saveXML($this->domNode);
	}
}