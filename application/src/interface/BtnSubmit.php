<?php

class BtnSubmit extends Element {

	public $value;

	public function __construct($value){
		parent::__construct('html');
		$this->value = $value;
	}

	/**
	 * Este método gera uma string contendo o html referente aos objetos.
	 * @return string 
	 */
	public function toRender() {
		return "<input type='submit' value='{$this->value}' />";
	}


}


?>
