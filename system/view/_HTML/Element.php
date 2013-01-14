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
		 * @var DOMDocument $DOC Document de toda a saída gerada
		 */
		protected static $DOC = NULL;
		/**
		 * @var DOMElement $domElement elemento em padrão dom
		 */
		 protected $domNode;
		
		/**
		 * Constrói um novo elemento
		 */
		public function __construct(){
			if(is_null(self::$DOC))
				self::$DOC = new DOMDocument;
		}
		
		/**
		 * Este método retorna o nome do elemento
		 * @return string
		 */
		public function getElementName(){
			return $this->domNode->nodeName;
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
		 * @ignore
		 */ 
		static protected function constructTextByNode(DOMText $text){
            return new TextElement(NULL,$text);
        }
		
		/**
		 * Este método deverá gerar uma string contendo o html referente aos objetos.
		 * @return string
		 */
		public function toRender(){
			return self::$DOC->saveXML($this->domNode);
		}
	}