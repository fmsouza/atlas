<?php
    /**
     * 
     * Classe Text
     * 
     * Esta classe representa um elemento html do tipo p pronta para ser renderizada
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @method __construct
     * @method toRender
     * 
     */
class Text extends Element {
	
	private $value;

	public function __construct($value){
		parent::__construct('html');
		$this->value = $value;
	}

	/**
	 * Este método atribui o valor passado ao texto
	 * @param string $value
	 */
	 public function setText($value){
	 	$this->value = $value;
	 }
	
	/**
	 * Este método gera uma string contendo o html referente aos objetos.
	 * @return string 
	 */
	public function toRender() {
		return "<p>{$this->value}</p>";
	}


}


?>
