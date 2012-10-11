<?php

    /**
     * 
     * Classe InputSubmit
     * 
     * Esta classe representa um elemento html do tipo generico pronta para ser renderizada
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @method __construct
	 * @method getElementName
	 * @method getAttributes()
	 * @method getAttribute
	 * @method getValue
	 * @method setElementName
	 * @method setValue
	 * @method setAttributes
	 * @method setAttribute
	 * @method attributesToString
	 * @method toRender
     * @method toRender
     * 
     */	
	class GenericElement extends Element{
		
		private $elementName;
		private $elementAttributes;
		private $close;
		private $value;
		
		public function __construct($elementName,$elementAttributes,$close=TRUE,$value=''){
			parent::__construct('html');
			$this->elementName = $elementName;
			$this->elementAttributes = $elementAttributes;
			$this->close = $close;
			$this->value=$value;
		}
		
		/**
		 * Retorna o nome do elemento, que será o nome da tag html
		 * @return string
		 */
		public function getElementName(){
			return $this->elementName;
		}
		
		/**
		 * Retorna um array contendo os atributos do elemento
		 * @return array
		 */
		public function getAttributes(){
			return $this->elementAttributes;
		}
		
		/**
		 * Retorna o atributo referente ao $key passado como parâmetro
		 * @param string $key
		 * @return string
		 */
		public function getAttribute($key){
			return $this->elementAttributes[$key];
		}
		
		/**
		 * Retorna o valor do elemento - caso ele tenha fechamento.
		 * @return string ou NULL
		 */
		public function getValue(){
			return $this->value;
		}
		
		/**
		 * Altera o nome do elemento pelo valor passado em $name
		 * @param string $name
		 */
		public function setElementName($name){
			$this->elementName = $name;
		}

		/**
		 * Altera o valor do elemento pelo valor passado em $value
		 * @param string $value
		 */		
		public function setValue($value){
			$this->value = $value;
		}
		
		/**
		 * Altera os atributos do elemento pelo passado em $attributes
		 * @param array $attributes
		 */		
		public function setAttributes($attributes){
			$this->elementAttributes = $attributes;
		}
		
		/**
		 * Altera ou insere o valor do atributo passado em $key pelo valor passado em $value
		 * @param string $key
		 * @param string $value
		 */
		public function setAttribute($key,$value){
			$this->elementAttributes[$key] = $value;
		}
		
		/**
		 * Retorna uma string já preparada dos atributos do elemento
		 * @return string
		 */
		private function attributesToString(){
			$return = "";
			foreach($this->getAttributes() as $attributeName => $attribute)
				$return .= "{$attributeName}=\"{$attribute}\" ";
			return $return;
		}
		
		/**
		 * Este método gera uma string contendo o html referente aos objetos.
		 * @return string 
		 */		
		public function toRender(){
			return ($this->close) ? "<{$this->getElementName()} {$this->attributesToString()}>{$this->getValue()}</{$this->getElementName()}>" :
									"<{$this->getElementName()} {$this->attributesToString()}/>" ;
		}
		
	}
