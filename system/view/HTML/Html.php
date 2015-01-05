<?php
/**
 * Contains Html class
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
	
	namespace system\view\html;

	use system\view\html\Element;
	use system\view\html\GenericElementsComposition;

	/**
	 * Contains the HTML template controller
	 * @package system\view\html
	 */
	class Html extends GenericElementsComposition {

		/**
		 * @var array $headElements HTML <head> Elements array 
		 */
		private $headElements;
		
		/**
		 * @ignore
		 */
		public function __construct(){
			parent::__construct("html",array());
			$this->headElements = array();
		}
		
		/**
		 * Adds an Element to the HTML header
		 * 
		 * @param Element $e Element to be added
		 * @return void
		 */
		public function addToHeader(Element $e){
			$this->headElements[] = $e;
		}
		
		/**
		 * Adds an Element to the HTML body
		 * 
		 * @param Element $e Element to be added
		 * @return void
		 */	
		public function addToBody(Element $e){
			parent::add($e);
		}
		
		/**
		 * Generates final HTML string to render.
		 * @return string
		 */
		public function toRender(){
			$html = "<html><head>";
			foreach($this->headElements as $headElement) $html .= $headElement->toRender();
			$html .= "</head><body>";
			foreach($this->getElements() as $element) $html .= $element->toRender();
			$html .= "</body></html>";
			return $html;
		}
	}
