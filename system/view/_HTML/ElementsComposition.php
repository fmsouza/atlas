<?php
/**
* Esta classe abstrata representa todos os objetos que são composições html
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
* Esta classe abstrata representa todos os objetos que são composições html
* @package system
* @subpackage view_HTML
*/
abstract class ElementsComposition extends Element implements Inflater{
	/**
	* @var array $elements Array contendo todos os elementos contidos na composição
	*/	
	protected $elements;
	
	/**
	* Este método adiciona um Element na composição
	* @param Element $e
	*/
	public function add(Element $e) {
		$this->elements[] = $e;
		$this->domNode->appendChild($e->domNode);
	}
	
	/**
	* @ignore
	*/
	protected function fill(Element $e){
		$this->elements[] = $e;
	}
	
	/**
	* Este método altera o Element na composição dado o valor do indice
	* @param Element $e
	* @param integer $index
	*/
	public function setElement(Element $e,$index) {
		$this->domNode->replaceChild($e->domNode,$this->getElement($index)->domNode);
		unset($this->elements[$index]);
		$this->elements[$index] = $e;
	}
	
	/**
	* Este método é sinônimo de rm
	* @param integer $index
	*/
	public function rmElement($index) {
		$this->rm($index);
	}
	
	/**
	* Este método remove o Element da composição dado o seu indice
	* @param integer $index
	*/
	public function rm($index) {
		$this->elements[$index]->domNode->parentNode->removeChild($this->elements[$index]->domNode);
		unset($this->elements[$index]);
		$this->elements = array_values($this->elements);
	}
	
	/**
	* Este método retorna o array contendo os elementos da composição
	* @return array
	*/
	public function getElements(){
		return $this->elements;
	}
	
	/**
	* Este método retorna o elemento do correspondente indice da composição
	* @param int $index índice do elemento
	* @return Element
	*/
	public function getElement($index){
		return $this->elements[$index];
	}
	
	/**
	* Este método retorna o elemento com o correspondente id na composição
	* @param int $id identificador do elemento
	* @return GenericElement
	*/
	public function getElementById($id){
		$return = NULL;	
		foreach($this->elements as $element){
			if($element instanceof GenericElement){
				if($element->domNode->getAttribute("id")==$id){
					$return = $element;
					break;
				}
			$return = $element->getElementById($id);
			}
		}
		return $return;
	}
	
	/**
	* Este método retorna o elemento com a correspondente class na composição
	* @param int $class identificador do elemento
	* @return GenericElement
	*/
	public function getElementByClass($class){
		$return = NULL;	
		foreach($this->elements as $element){
			if($element instanceof GenericElement){
				if(strpos($element->domNode->getAttribute("class"),$class) !== false){
					$return = $element;
					break;
				}
			$return = $element->getElementByClass($class);
			}
		}
		return $return;
	}
	
	/**
	* Este método retorna o número elementos da composição
	* @return integer
	*/
	public function getElementCount(){
		return count($this->elements);
	}
}
