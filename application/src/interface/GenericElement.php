<?php
	
	class GenericElement extends Element{
		
		private $elementName;
		private $elementAttributes;
		private $close;
		private $value;
		
		public function __construct($elementName,$elementAttributes,$close=TRUE,$value=''){
			parent::__construct('html');
			$this->elementName = $elementName;
			$this->elementAttributes = $elementAttributes;
			$this->close = $close;
			$this->value=$value;
		}
		
		public function getElementName(){
			return $this->elementName;
		}
		
		public function getAttributes(){
			return $this->elementAttributes;
		}
		
		public function getAttribute($key){
			return $this->elementAttributes[$key];
		}
		
		public function getValue(){
			return $this->value;
		}
		
		public function setElementName($name){
			$this->elementName = $name;
		}
		
		public function setValue($value){
			$this->value = $value;
		}
		
		public function setAttributes($attributes){
			$this->elementAttributes = $attributes;
		}
		
		public function setAttribute($key,$value){
			$this->elementAttributes[$key] = $value;
		}
		
		private function attributesToString(){
			$return = "";
			foreach($this->getAttributes() as $attributeName => $attribute)
				$return .= "{$attributeName}=\"{$attribute}\" ";
			return $return;
		}
		
		public function toRender(){
			return ($this->close) ? "<{$this->getElementName()} {$this->attributesToString()}>{$this->getValue()}</{$this->getElementName()}>" :
									"<{$this->getElementName()} {$this->attributesToString()}/>" ;
		}
		
	}
