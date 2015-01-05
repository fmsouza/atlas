<?php
/**
 * Contains TextElement class
 * 
 * @copyright Copyright 2013 Marvie
 * Licensed under the Apache License, Version 2.0 (the “License”);
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an “AS IS” BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
	
	namespace system\view\html;

	use system\view\html\Element;

	/**
	 * Represents a text string inside of an element as an element
	 * @package system\view\html
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
