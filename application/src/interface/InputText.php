<?php

class InputText extends Element {

	public $name;
	public $value;

	public function __construct($name, $value=''){
		parent::__construct('html');
		$this->name = $name;
		$this->value = $value;
	}

	public function render() {
		return "<input type='text' name='{$this->name}' value='{$this->value}' />";
	}


}


?>
