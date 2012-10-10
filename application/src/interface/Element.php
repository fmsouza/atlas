<?php

    /**
     * 
     * Classe Element
     * 
     * Está é a classe básica de composição de objetos html para serem carregados em view
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @method __construct
     * @method toRender
     */
abstract class Element {

	protected $type;

	public function __construct($type){
		$this->type = $type;
	}
	
	/**
	 * Este método deverá gerar uma string contendo o html referente aos objetos.
	 * 
	 */
	abstract public function toRender();

}


?>
