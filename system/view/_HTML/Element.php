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
		 * @var DOMDocument $DOC Valor para ajudar
		 */
		protected static $DOC = NULL;
		/**
		 * @var DOMElement $domElement elemento em padrão dom
		 */
		 protected $domNode;
		
		/**
		 * Constrói um novo elemento
		 * @param string $elementName Nome do elemento
		 * @param string $value Valor do elemento
		 * @param array $elementAttributes Atributos do elemento
		 * @param bool $close Define se o elemento possui fechamento ou não
		 */
		public function __construct($elementName,$value='',$elementAttributes=array()){
			if(is_null(self::$DOC))
				self::$DOC = new DOMDocument;
			$this->domNode = self::$DOC->createElement($elementName,$value);
			foreach($elementAttributes as $att=>$value)
				$this->domNode->setAttribute($att,$value);
		}
				
		/**
		 * Este método retorna o nome do elemento
		 * @return string
		 */
		public function getElementName(){
			return $this->domNode->nodeName;
		}
			
		/**
		 * Este método retorna um array contendo os atributos do elemento
		 * @return array
		 */
		public function getAttributes(){
			$return = array();
			foreach($this->domNode->attributes as $att) $return[$att->name]=$att->value;
			return $return;
		}
		
		/**
		 * Este método retorna o valor do atributo dado por parâmetro
		 * @param string $key nome do atributo a ser retornado
		 * @return string
		 */
		public function getAttribute($key){
			return $this->domNode->getAttribute($key);
		}
		
		/**
		 * Este método substitui os atributos pelos passado no array em parâmetro
		 * O formato do array deve ser {"nome_atributo" => "valor do atributo"}
		 * @param array $attributes Novo array de atributos para o elemento
		 */
		public function setAttributes($attributes){
			$this->removeAttributes();
			foreach($attributes as $key=>$value)
				$this->setAttribute($key, $value);
		}
		
		/**
		 * Remove todos os atributos do elemento
		 * @return void
		 */
		 public function removeAttributes(){
		 	while($this->domNode->hasAttributes()) $this->domNode->removeAttributeNode($this->domNode->attributes->item(0));
		 }
		
		/**
		 * Este método substitui ou adiciona um atributo dado o nome do atributo e o seu valor
		 * @param string $key Nome do atributo a ser alterado/inserido
		 * @param string $value Valor do atributo
		 */
		public function setAttribute($key,$value){
			$this->domNode->setAttribute($key,$value);
		}
		
		/**
		 * @ignore
		 */
		 protected static function getAttributesDOMtoArray(DOMElement $node){
			$return = array();
			foreach($node->attributes as $att) $return[$att->name]=$att->value;
			return $return;
		}
		
		/**
		 * Este método deverá gerar uma string contendo o html referente aos objetos.
		 * @return string
		 */
		public function toRender(){
			self::$DOC->appendChild($this->domNode);
			return self::$DOC->saveHTML();
		}
	
	}
