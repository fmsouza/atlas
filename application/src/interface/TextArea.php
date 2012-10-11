<?php
    /**
     * 
     * Classe TextArea
     * 
     * Esta classe representa um elemento html do tipo textarea pronta para ser renderizada
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @method __construct
     * @method toRender
     * 
     */
class TextArea extends Element {

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
		return "<textarea name='{$this->name}'>{$this->value}</textarea>";
	}


}


?>
