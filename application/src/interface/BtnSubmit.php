<?php
    /**
     * 
     * Classe BtnSubmit
     * 
     * Esta classe representa um elemento html do tipo input submit pronta para ser renderizada
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @method __construct
     * @method toRender
     * 
     */
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
