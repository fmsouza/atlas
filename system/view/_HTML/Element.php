<?php
    /**
     * Esta é a classe básica e abstrata de objetos html para serem carregados em view
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     */
     /**
	  * Esta é a classe básica e abstrata de objetos html para serem carregados em view
	  * @package system
	  * @subpackage view_HTML
	  */
	abstract class Element {
		
		/**
		 * @var string $elementName nome do elemento
		 */
		protected $elementName;
		/**
		 * @var string $type tipo do elemento
		 */
		protected $type;
		/**
		 * @var array $elementAttributes atributos do elemento
		 */
		protected $elementAttributes;
		
		/**
		 * Constrói um elemento
		 * @param string $type tipo do elemento
		 * @return void
		 */
		public function __construct($type){
			$this->type = $type;
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
		 * Método auxiliar da classe, utilizada durante a renderização do elemento, gera uma string dos atributos para ser renderizado
		 * @return string
		 */		
		protected function attributesToString(){
			$return = "";
			foreach($this->getAttributes() as $attributeName => $attribute)
				$return .= "{$attributeName}=\"{$attribute}\" ";
			return $return;
		}
		
		/**
		 * Este método deverá gerar uma string contendo o html referente aos objetos.
		 * @return string
		 */
		abstract public function toRender();
	
	}
