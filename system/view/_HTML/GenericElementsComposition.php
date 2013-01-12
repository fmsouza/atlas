<?php
	/**
     * Esta classe gera um elemento generico html pronto para ser renderizado no browser
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     */
    /**
	 * Esta classe gera um elemento generico html pronto para ser renderizado no browser
	 * @package system
	 * @subpackage view_HTML
	 */
	class GenericElementsComposition extends ElementsComposition{
		
		/**
		 * Constrói uma composição de elementos genéricos.
		 * @param string $compositionName
		 * @param array $compositionAttributes
		 * @return void
		 */
		public function __construct($compositionName,$compositionAttributes=array()){
			parent::__construct($compositionName,$compositionAttributes);
		}
        
        
        /**
         * @ignore
         */ 
        static protected function inflateNode(DOMElement $root){
            $GEC = new GenericElementsComposition($root->nodeName,self::getAttributesDOMtoArray($root));
            foreach($root->childNodes as $node){
                if($node->firstChild instanceof DOMText OR !$node->hasChildNodes())
                    $GEC->add(new GenericElement($node->nodeName,$node->nodeValue,self::getAttributesDOMtoArray($node)));
                else
                    $GEC->add(self::inflateNode($node));
            }
            return $GEC;
        }
				
		/**
		 * Este método infla um arquivo de html criando objetos em seus respectivos tipos.
		 * @param string $layout
		 * @param integer $index
		 */
        static public function layoutInflater($layout,$index=0){
        	$return = new DOMDocument;
            try{
			    $return->loadXML(preg_replace('~\s*(<([^>]*)>[^<]*</\2>|<[^>]*>)\s*~','$1',file_get_contents(_USER::VIEW()."/".$layout)));
			    $root = $return->firstChild;
			    return self::inflateNode($root);
            }catch(ErrorException $e){
                $db = debug_backtrace();
                throw new ErrorException($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line'] );
            }
        }
	}