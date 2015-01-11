<?php
namespace core\view\html;

use core\tools\designpattern\Inflater;

/**
 * This is a representation of the HTML trees and compositions. This is the type of those
 * elements which holds other elements.
 * @package core\view\html
 */
abstract class ElementsComposition extends Element implements Inflater{
	
	/**
	 * @var array $elements Contains the child elements
	 */	
	protected $elements;
	
	/**
	 * Adds a new child Element
	 * @param Element $e New Element
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
	 * Exchange the Element on the especified index for a new one
	 * @param Element $e New Element
	 * @param int $index Element index
	 */
	public function setElement(Element $e,$index) {
		$this->domNode->replaceChild($e->domNode,$this->getElement($index)->domNode);
		unset($this->elements[$index]);
		$this->elements[$index] = $e;
	}
	
	/**
	 * Removes the child element in the especified position
	 * @param int $index Element index
	 */
	public function rmElement($index) {
		$this->rm($index);
	}
	
	/**
	 * Removes the child element in the especified position
	 * @param int $index Element index
	 */
	public function rm($index){
		$this->elements[$index]->domNode->parentNode->removeChild($this->elements[$index]->domNode);
		unset($this->elements[$index]);
		$this->elements = array_values($this->elements);
	}
	
	/**
	 * Returns all child elements
	 * @return array
	 */
	public function getElements(){
		return $this->elements;
	}
	
	/**
	 * Returns a child element in the especified position
	 * @param int $index Element index
	 * @return Element
	 */
	public function getElement($index){
		return $this->elements[$index];
	}
	
	/**
	 * Returns the child element with certain id
	 * @param string $id Element id
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
	 * Removes the child element which has certain id
	 * @param string $id Element id
	 * @return void
	 */
	public function removeElementById($id){	
		foreach($this->elements as $element){
			if($element instanceof GenericElement){
				if($element->domNode->getAttribute("id")==$id){
					$element->domNode->parentNode->removeChild($element->domNode);
					unset($element);
					$this->elements = array_values($this->elements);
					break;
				}
				else $element->removeElementById($id);
			}
		}
	}
	
	/**
	 * Returns all the Elements which has certain class
	 * @param string $class Element class
	 * @return GenericElement
	 * 
	 * TODO Fix it. Actually it is working equal to getElementById()
	 */
	public function getElementByClass($class,$return = array()){
		foreach($this->elements as $element){
			if($element instanceof GenericElement){
				if(strpos($element->domNode->getAttribute("class"),$class) !== false)
					$return[] = &$element;
				$element->getElementByClass($class,$return);
			}
		}
		return $return;
	}
	
	/**
	 * Returns the count of child elements
	 * @return integer
	 */
	public function getElementCount(){
		return count($this->elements);
	}
}