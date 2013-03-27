<?php
/**
 * Este arquivo contém uma classe que gera um elemento de Texto
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
 * Esta classe gera um elemento de Texto
 * @package system
 * @subpackage view_HTML
 */

class TextElement extends Element{
    /**
    * Constroi um novo elemento de texto
    * @param string $text Texto do elemento
    */
    public function __construct($text,DOMText $t=NULL){
	parent::__construct();
	if($t==NULL)
	    $this->domNode = self::$DOC->createTextNode($text);
	else
	    $this->domNode = $t;
    }
    
    /**
     * Retorna o conteúdo do texto
     * @return string
     */
    public function getText(){
	return $this->domNode->data;
    }
    
    /**
     * Retorna o tamanho do texto
     * @return integer
     */
    public function getLength(){
	return $this->domNode->length;
    }
    
    /**
     * Atera o valor do texto
     * @return void
     */
    public function setText($text){
	$this->domNode->data = $text;
    }
}
