<?php
namespace core\view\html;

use core\view\html\TextElement;

/**
 * The Element class is the smallest unit on the HTML objects abstraction tree.
 * @package core\view\html
 */
abstract class Element{
	
	/**
	 * @var DOMDocument $DOC Stores the output
	 */
	protected static $DOC = NULL;
	/**
	 * @var DOMElement $domElement DOM default element
	 */
	protected $domNode;
	
	/**
	 * @ignore
	 */
	public function __construct(){
		if(is_null(self::$DOC))
			self::$DOC = new \DOMDocument;
	}
	
	/**
	 * Returns the current element name
	 * @return string
	 */
	public function getElementName(){
		return $this->domNode->nodeName;
	}
	
	/**
	 * @ignore
	 */
	protected static function getAttributesDOMtoArray(\DOMElement $node){
		$return = array();
		foreach($node->attributes as $att) $return[$att->name]=$att->value;
		return $return;
	}
	
	/**
	 * @ignore
	 */ 
	static protected function constructTextByNode(\DOMText $text){
		return new TextElement(NULL,$text);
	}
	
	/**
	 * @ignore
	 */
	public function __toString(){
		return self::$DOC->saveXML($this->domNode);
	}
}