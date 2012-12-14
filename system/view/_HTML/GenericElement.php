<?php
	/**
     * 
     * Classe GenericElement
     * 
     * Esta classe gera um elemento generico html pronto para ser renderizado no browser
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @method __construct
	 * @method getElementName
	 * @method getAttribute
	 * @method getAttributes
	 * @method getValue
	 * @method setElementName
	 * @method setAttributes
	 * @method setAttribute
	 * @method attributesToString
	 * @method toRender
     * 
     */
	class GenericElement extends Element{
		
		private $elementName;
		private $elementAttributes;
		private $close;
		private $value;
		
		public function __construct($elementName,$elementAttributes,$value='',$close=TRUE){
			parent::__construct('html');
			$this->elementName = $elementName;
			$this->elementAttributes = $elementAttributes;
			$this->close = $close;
			$this->value=$value;
		}
		
		/**
		 * Este método retorna o tipo de fechamento do elemento
		 * @return boolean
		 */
		 public function getClose(){
		 	return $this->close;
		 }
		
		/**
		 * Este método retorna o nome do elemento
		 * @return string
		 */
		public function getElementName(){
			return $this->elementName;
		}
		
		/**
		 * Este método retorna um array contendo os atributos do elemento
		 * @return array
		 */
		public function getAttributes(){
			return $this->elementAttributes;
		}
		
		/**
		 * Este método retorna o valor do atributo dado por parâmetro
		 * @param string $key nome do atributo a ser retornado
		 * @return string
		 */
		public function getAttribute($key){
			return (array_key_exists($key, $this->getAttributes()))?$this->elementAttributes[$key]:"";
		}
		
		/**
		 * Este método retorna o valor dentro do elemento
		 * @return string
		 */
		public function getValue(){
			return $this->value;
		}
		
		/**
		 * Este método substitui o nome do elemento pelo passado em parâmetro
		 * @param string $name Novo nome para o elemento
		 */
		public function setElementName($name){
			$this->elementName = $name;
		}
		
		/**
		 * Este método substitui o valor do elemento pelo passado em parâmetro
		 * @param string $value Novo valor para o elemento
		 */
		public function setValue($value){
			$this->value = $value;
		}
		
		/**
		 * Este método substitui os atributos pelos passado no array em parâmetro
		 * O formato do array deve ser {"nome_atributo" => "valor do atributo"}
		 * @param array $attributes Novo array de atributos para o elemento
		 */
		public function setAttributes($attributes){
			$this->elementAttributes = $attributes;
		}
		
		/**
		 * Este método substitui ou adiciona um atributo dado o nome do atributo e o seu valor
		 * @param string $key Nome do atributo a ser alterado/inserido
		 * @param string $value Valor do atributo
		 */
		public function setAttribute($key,$value){
			$this->elementAttributes[$key] = $value;
		}
		
		/**
		 * Método auxiliar da classe, utilizada durante a renderização do elemento, gera uma string dos atributos para ser renderizado
		 * @return string
		 */		
		private function attributesToString(){
			$return = "";
			foreach($this->getAttributes() as $attributeName => $attribute)
				$return .= "{$attributeName}=\"{$attribute}\" ";
			return $return;
		}
		
		/**
		 * Este método deverá gerar uma string contendo o html referente aos objetos.
		 * @return string
		 */
		public function toRender(){
			return ($this->close) ? "<{$this->getElementName()} {$this->attributesToString()}>{$this->value}</{$this->getElementName()}>" :
									"<{$this->getElementName()} {$this->attributesToString()}/>" ;
		}
		
	}
