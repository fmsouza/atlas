<?php

class InputText extends Element {

	public $name;
	public $value;

	public function __construct($name, $value=''){
		parent::__construct('html');
		$this->name = $name;
		$this->value = $value;
	}

	/**
	 * Este método gera uma string contendo o html referente aos objetos.
	 * @return string 
	 */
	public function toRender() {
		return "<input type='text' name='{$this->name}' value='{$this->value}' />";
	}


}


?>
