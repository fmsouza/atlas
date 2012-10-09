<?php

abstract class Element {

	protected $type;

	public function __construct($type){
		$this->type = $type;
	}
	abstract public function render();

}


?>
