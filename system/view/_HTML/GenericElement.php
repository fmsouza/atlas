<?php
/**
* Este arquivo contém uma classe que gera um elemento generico html pronto para ser renderizado no browser
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
* Esta classe gera um elemento generico html pronto para ser renderizado no browser
* @package system
* @subpackage view_HTML
*/
class GenericElement extends ElementsComposition{
    /**
    * Constrói um novo elemento genérico
    * @param string $elementName Nome do elemento
    * @param array $elementAttributes Atributos do elemento
    */
    public function __construct($elementName,$elementAttributes=array(),DOMElement $e=NULL){
	parent::__construct();
	$this->elements = array();
	if($e==NULL){
	    $this->domNode = self::$DOC->createElement($elementName);
	    foreach($elementAttributes as $att=>$value)
	    $this->domNode->setAttribute($att,$value);
	}else{
	    $this->domNode = $e;
	}
    }
    
    /**
    * Este método retorna um array contendo os atributos do elemento
    * @return array
    */
    public function getAttributes(){
	$return = array();
	foreach($this->domNode->attributes as $att) $return[$att->name]=$att->value;
	return $return;
    }
    
    /**
    * Este método retorna o valor do atributo dado por parâmetro
    * @param string $key nome do atributo a ser retornado
    * @return string
    */
    public function getAttribute($key){
	return $this->domNode->getAttribute($key);
    }
    
    /**
    * Este método substitui os atributos pelos passado no array em parâmetro
    * O formato do array deve ser {"nome_atributo" => "valor do atributo"}
    * @param array $attributes Novo array de atributos para o elemento
    */
    public function setAttributes($attributes){
	$this->removeAttributes();
	foreach($attributes as $key=>$value)
	$this->setAttribute($key, $value);
    }
    
    /**
    * Remove todos os atributos do elemento
    * @return void
    */
    public function removeAttributes(){
	while($this->domNode->hasAttributes()) $this->domNode->removeAttributeNode($this->domNode->attributes->item(0));
    }
    
    /**
    * Este método substitui ou adiciona um atributo dado o nome do atributo e o seu valor
    * @param string $key Nome do atributo a ser alterado/inserido
    * @param string $value Valor do atributo
    */
    public function setAttribute($key,$value){
	$this->domNode->setAttribute($key,$value);
    }
    
    /**
    * @ignore
    */
    static private function constructByNode(DOMElement $node){
	$GE = new GenericElement(NULL,NULL,$node);
	foreach($node->childNodes as $child){
	    if($child instanceof DOMElement){
	    $GE->fill(self::constructByNode($child));
	    }
	    elseif($child instanceof DOMText)
		$GE->fill(self::constructTextByNode($child));
	}
	return $GE;
    }
    
    /**
    * Este método infla uma string de html criando objetos em seus respectivos tipos.
    * @param string $layout
    */
    static public function stringInflater($layout){
	$tmp = new DOMDocument;
	if(is_null(self::$DOC))
	    self::$DOC = new DOMDocument;
	try{
	    $tmp->loadXML($layout);
	    $root = self::$DOC->importNode($tmp->firstChild,TRUE);
	    return self::constructByNode($root);
	}catch(ErrorException $e){
	    $db = debug_backtrace();
	    throw new ErrorException($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line'] );
	}
    }
    /**
    * Este método infla um arquivo de html criando objetos em seus respectivos tipos.
    * @param string $layout endereço do arquivo html em view
    * @param integer $index
    */
    static public function layoutInflater($layout,$index=0){
	return self::stringInflater(preg_replace('~\s*(<([^>]*)>[^<]*</\2>|<[^>]*>)\s*~','$1',file_get_contents(_USER::VIEW()."/".$layout)));
    }
}
