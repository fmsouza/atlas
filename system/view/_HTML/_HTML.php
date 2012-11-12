<?php
    /**
     * 
     * Classe _HTML
     * 
     * Este arquivo contém ocontrolador de template HTML
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @method __construct
     * @method addToHeader
     * @method addToBody
     * @method toRender
     * @method layoutInflater
     * 
     */
class _HTML extends GenericElementsComposition {
	
	private $headElements;
	
	/**
	 * Método construtor, carrega o construtor de ElementsComposition e inicializa o array com os elementos do header
	 */
	public function __construct(){
		parent::__construct("html",array());
		$this->headElements = array();
	}
	
	/**
	 * Este método adiciona um Element ao header
	 * @param Element $e
	 */
	public function addToHeader(Element $e){
		$this->headElements[] = $e;
	}
	
	/**
	 * Este método adiciona um Element ao body
	 * @param Element $e
	 */	
	public function addToBody(Element $e){
		parent::add($e);
	}
	
	/**
	 * Este método gera uma string contendo o html referente aos objetos.
	 * @return string
	 */
	public function toRender(){
		$html = "<html><head>";
		foreach($this->headElements as $headElement) $html .= $headElement->toRender();
		$html .= "</head><body>";
		foreach($this->getElements() as $element) $html .= $element->toRender();
		$html .= "</body></html>";
		return $html;
	}
}
