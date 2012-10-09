<?php

class TextArea extends Element {

	public $name;
	public $value;

	public function __construct($name, $value=''){
		parent::__construct('html');
		$this->name = $name;
		$this->value = $value;
	}

	public function render() {
		return "<textarea name='{$this->name}'>{$this->value}</textarea>";
	}


}


?>
