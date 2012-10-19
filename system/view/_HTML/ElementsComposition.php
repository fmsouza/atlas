<?php
    /**
     * 
     * Classe ElementsComposition
     * 
     * Esta classe abstrata representa todos os objetos que são composições html
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @method __construct
     * @method add
     * @method getElements
     * @method layoutInflater
     * 
     */
abstract class ElementsComposition extends Element {

	private $elements;
	private $numElements;

	/**
	 * Este método adiciona um Element na composição
	 * @param Element $e
	 */
	public function add(Element $e) {
		$this->elements[] = $e;
		$this->numElements++;
	}
	
	/**
	 * Este método retorna o array contendo os elementos da composição
	 * @return array
	 */
	public function getElements(){
		return $this->elements;
	}
	
	/**
	 * Este método retorna o elemento do correspondente indice da composição
	 * @return string
	 */
	public function getElement($index){
		return $this->elements[$index];
	}
	
	/**
	 * Este método retorna o número elementos da composição
	 * @return integer
	 */
	public function getElementCount(){
		return $this->numElements;
	}
	
	
	/**
	 * Este método infla um arquivo de html criando objetos em seus respectivos tipos.
	 * @param string $layout
	 * @param integer $index
	 */
	abstract static public function layoutInflater($layout,$index);


}


?>
