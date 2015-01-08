<?php
namespace core\view\html;

use core\view\html\ElementsComposition;
use core\control\System;

/**
 * Represents a generic element, which can be any HTML element
 * @package core\view\html
 */
class GenericElement extends ElementsComposition{
	
    /**
     * Generates a new element
     * @param string $elementName Element name
     * @param array $elementAttributes Element attributes
     */
    public function __construct($elementName,$elementAttributes=array(),\DOMElement $e=NULL){
		parent::__construct();
		$this->elements = array();
		if($e==NULL){
		    $this->domNode = self::$DOC->createElement($elementName);
		    foreach($elementAttributes as $att=>$value)
		    $this->domNode->setAttribute($att,$value);
		}else{
		    $this->domNode = $e;
		}
    }
    
    /**
     * Returns all the element attributes
     * @return array
     */
    public function getAttributes(){
		$return = array();
		foreach($this->domNode->attributes as $att) $return[$att->name]=$att->value;
		return $return;
    }
    
    /**
     * Returns the given attribute value
     * @param string $key Attribute name
     * @return string
     */
    public function getAttribute($key){
		return $this->domNode->getAttribute($key);
    }
    
    /**
     * Removes all the current attributes for the given
     * @param array $attributes New attributes array
     * @return void
     */
    public function setAttributes($attributes){
		$this->removeAttributes();
		foreach($attributes as $key=>$value)
			$this->setAttribute($key, $value);
    }
    
    /**
     * Removes all the element attributes
     * @return void
     */
    public function removeAttributes(){
		while($this->domNode->hasAttributes()) $this->domNode->removeAttributeNode($this->domNode->attributes->item(0));
    }
    
    /**
     * Add/update the given element attribute
     * @param string $key Attribute name
     * @param mixed $value Attribute value
     * @return void
     */
    public function setAttribute($key,$value){
		$this->domNode->setAttribute($key,$value);
    }
    
    /**
     * @ignore
     */
    static private function constructByNode(\DOMElement $node){
		$GE = new GenericElement(NULL,NULL,$node);
		foreach($node->childNodes as $child){
		    if($child instanceof \DOMElement)
		    	$GE->fill(self::constructByNode($child));
		    elseif($child instanceof \DOMText)
				$GE->fill(self::constructTextByNode($child));
		}
		return $GE;
    }
    
    /**
     * Inflates an Element from a string
     * @param string $layout
     * @return DOMDocument
     */
    static public function stringInflater($layout){
		$tmp = new \DOMDocument;
		$encoding = System::getConfig()->encoding;
		if(is_null(self::$DOC))
		    self::$DOC = new \DOMDocument("1.0",$encoding);
		try{
			// TODO find out the right solution to the problem wih special characters
			$layout = self::replaceCharacters($layout);
		    $tmp->loadXML(mb_convert_encoding($layout, 'HTML-ENTITIES', $encoding));
		    $root = self::$DOC->importNode($tmp->firstChild,TRUE);
		    return self::constructByNode($root);
		}catch(\ErrorException $e){
		    $db = debug_backtrace();
		    throw new \ErrorException($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line'] );
		}
    }
	
    /**
     * Inflates an Element tree from a file
     * @param string $layout HTML file path stored in application/view
     * @return string
     */
    static public function layoutInflater($file, $path=''){
    	if(empty($path)) $path = System::getConfig()->viewPath;
		return self::stringInflater(preg_replace('~\s*(<([^>]*)>[^<]*</\2>|<[^>]*>)\s*~','$1',file_get_contents($path.'/'.$file)));
    }
	
	/**
	 * @ignore
	 */
	static private function specialCharacters(){
		return array(
			//'#' => '&#35;',
			//'$' => '&#36;',
			'%' => '&#37;',
			'&' => '&#38;',
			'@' => '&#64;',
			'£' => '&#163;',
			'¥' => '&#165;',
			'©' => '&#169;',
			'®' => '&#174;',
			'€' => '&#8364;'
		);
	}
	
	/**
	 * @ignore
	 */
	static private function replaceCharacters($string){
		foreach(self::specialCharacters() as $key => $value)
			$string = str_replace($key, $value, $string);
		return $string;
	}
}