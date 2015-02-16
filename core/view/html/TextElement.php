<?php

namespace core\view\html;

/**
 * Represents a text string inside of an element as an element
 * @package core\view\html
 */

class TextElement extends Element{
	
    /**
     * Generates a new element
     * @param string $text Text value
     * @param \DOMText $t
     * @return TextElement
     */
    public function __construct($text, \DOMText $t=NULL){
		parent::__construct();
        $this->domNode = (is_null($t))? self::$DOC->createTextNode($text) : $t;
    }
    
    /**
     * returns the text content
     * @return string
     */
    public function getText(){
	    return $this->domNode->data;
    }
    
    /**
     * Returns the string length
     * @return int
     */
    public function getLength(){
	    return $this->domNode->length;
    }
    
    /**
     * Changes the text value
     * @param string $text
     * @return void
     */
    public function setText($text){
	    $this->domNode->data = $text;
    }
}