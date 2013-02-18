<?php
    /**
     * Este arquivo contém uma classe que gera um elemento de Texto
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     */
    /**
     * Esta classe gera um elemento de Texto
     * @package system
     * @subpackage view_HTML
     */
    
    class TextElement extends Element{
    	/**
		 * Constroi um novo elemento de texto
		 * @param string $text Texto do elemento
		 */
        public function __construct($text,DOMText $t=NULL){
            parent::__construct();
            if($t==NULL)
                $this->domNode = self::$DOC->createTextNode($text);
            else
                $this->domNode = $t;
        }
        
		/**
		 * Retorna o conteúdo do texto
		 * @return string
		 */
        public function getText(){
            return $this->domNode->data;
        }
        
		/**
		 * Retorna o tamanho do texto
		 * @return integer
		 */
        public function getLength(){
            return $this->domNode->length;
        }
        
		/**
		 * Atera o valor do texto
		 * @return void
		 */
        public function setText($text){
            $this->domNode->data = $text;
        }
        
    }
