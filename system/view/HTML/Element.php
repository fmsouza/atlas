<?php
	/**
	 * Contains Element class
	 * 
	 * @author Frederico Souza (fredericoamsouza@gmail.com)
	 * @author Julio Cesar (thisjulio@gmail.com)
	 * 
	 * @copyright Copyright 2013 Frederico Souza
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
	/**
	 * The Element class is the smallest unit on the HTML objects abstraction tree.
	 * 
	 * @package system
	 * @subpackage viewHtml
	 */
	abstract class Element {
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
				self::$DOC = new DOMDocument;
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
		 * Generates final HTML string to render.
		 * @return string
		 */
		public function toRender(){
			return self::$DOC->saveXML($this->domNode);
		}
	}