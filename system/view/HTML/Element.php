<?php
/**
 * Contains Element class
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

	use system\view\html\TextElement;

	/**
	 * The Element class is the smallest unit on the HTML objects abstraction tree.
	 * @package system\view\html
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