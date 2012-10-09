<?php

class BtnSubmit extends Element {

	public $value;

	public function __construct($value){
		parent::__construct('html');
		$this->value = $value;
	}

	public function render() {
		return "<input type='submit' value='{$this->value}' />";
	}


}


?>
