<?php

abstract class ElementsComposition extends Element {

	public $elements;

	public function add(Element $e) {
		$this->elements[] = $e;
		return $this;
	}


}


?>
