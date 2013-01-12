<?php
	/**
     * Este arquivo contém uma classe que gera um elemento generico html pronto para ser renderizado no browser
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     */
    /**
	 * Esta classe gera um elemento generico html pronto para ser renderizado no browser
	 * @package system
	 * @subpackage view_HTML
	 */
	class GenericElement extends Element{

		/**
		 * Constrói um novo elemento genérico
		 * @param string $elementName Nome do elemento
		 * @param string $value Valor do elemento
		 * @param array $elementAttributes Atributos do elemento
		 * @param bool $close Define se o elemento possui fechamento ou não
		 */
		public function __construct($elementName,$value='',$elementAttributes=array()){
			parent::__construct($elementName,$value,$elementAttributes);
		}
	
		/**
		 * Este método retorna o valor dentro do elemento
		 * @return string
		 */
		public function getValue(){
			return $this->domNode->nodeValue;
		}
		
		/**
		 * Este método substitui o valor do elemento pelo passado em parâmetro
		 * @param string $value Novo valor para o elemento
		 */
		public function setValue($value){
			$this->domNode->nodeValue = $value;
		}
		
	}
