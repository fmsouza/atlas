<?php
    /**
     * 
     * Classe Form
     * 
     * Esta classe gera um objeto que representa um formulário em html pronto para ser renderizado no browser
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @method __construct
     * @method getElements
     * @method layoutInflater
     * 
     */
class Form extends GenericElementsComposition{

	public function __construct($method, $action){

        $attributes = array(
                "method" => $method,
		        "action" => $action
		);
		parent::__construct("form",$attributes);
	}
	
	

}
