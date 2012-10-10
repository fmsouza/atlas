<?php

abstract class ElementsComposition extends Element {

	private $elements;

	public function add(Element $e) {
		$this->elements[] = $e;
		return $this;
	}
	
	public function getElements(){
		return $this->elements;
	}
	
	/**
	 * Este método infla um arquivo de html criando objetos em seus respectivos tipos.
	 * @param string $layout
	 * @param integer $index
	 */
	abstract static public function layoutInflater($layout,$index);


}


?>