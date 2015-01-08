<?php
namespace core\view\html;

use core\view\html\Element;

/**
 * Represents a text string inside of an element as an element
 * @package core\view\html
 */

class TextElement extends Element{
	
    /**
     * Generates a new element
     * @param string $text Text value
     */
    public function __construct($text,\DOMText $t=NULL){
		parent::__construct();
		if($t==NULL)
		    $this->domNode = self::$DOC->createTextNode($text);
		else
		    $this->domNode = $t;
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
     * @return void
     */
    public function setText($text){
	$this->domNode->data = $text;
    }
}