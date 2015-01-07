<?php

	namespace system\control\tools;

	use system\control\tools\Util;

	class Annotation{

		private $object;
		private $reflection;
		private $identifier;
		private $varDelimiter;
		private $lineDelimiter;
		private $methodDelimiter;
		private $methodArgSeparator;
		private $annProcessed = [];

		public function __construct($obj, $identifier='@', $lineDelimiter=';', $varDelimiter='=', $methodDelimiter=':', $methodArgSeparator=','){
			$this->reflection = new \ReflectionClass(get_class($obj));
			$this->object = $obj;
			$this->identifier = $identifier;
			$this->lineDelimiter = $lineDelimiter;
			$this->varDelimiter = $varDelimiter;
			$this->methodDelimiter = $methodDelimiter;
			$this->methodArgSeparator = $methodArgSeparator;
		}

		public function getSourceClass(){
			return get_class($this->object);
		}

		public function getSourceObject(){
			return $this->object;
		}

		public function getIdentifier(){
			return $this->identifier;
		}

		public function getAnnotations(){
			return Util::listToObject($this->annProcessed);
		}

		protected function parse(){
			/* 
				TODO: 
				Use Util::getInBetweenStrings($start, $end, $string) to clean this code
			*/
            $reflection = $this->reflection;
            $result = array();

            foreach ($reflection->getMethods() as $method) {
            	$doc = $method->getDocComment();
	            if(!strstr($doc, $this->identifier)) continue;
	            $doc = preg_replace(array('/\/\*/', '/\*\//', '/\*/'), '', $doc); // removing the docblock delimiters
	            $doc = explode($this->lineDelimiter, $doc); // splitting the annotations
                for($i=0; $i<count($doc); $i++){
                	if(empty(trim($doc[$i])) || is_null($doc[$i])){
                		continue;
                	}
                	$data = strstr($doc[$i], $this->identifier);
                	$data = preg_replace("/^{$this->identifier}*/", '', $data); // removing the identifier from the query

                	if(strstr($data, $this->varDelimiter)){
                		$this->parseVar($data, $method->name);
                	} elseif (strstr($data, '(')) {
                		$this->parseMethod($data, $method->name);
                	}
                }
            }
		}

		private function parseVar($arg, $method){
    		list($key, $value) = explode($this->varDelimiter, $arg);
    		$this->annProcessed[$method]['vars'][$key] = str_replace('\'', '', $value);
		}

		private function parseMethod($arg, $method){
			list($key, $value) = explode('(', $arg);
			$data = str_replace(')', '', $value);
			$data = explode($this->methodArgSeparator, $data);

			$tmp = array();
			foreach ($data as $d) {
				if(!strstr($d, $this->methodDelimiter)) continue;
				list($k, $v) = explode($this->methodDelimiter, $d);
				$tmp[trim($k)] = trim(str_replace('\'', '', $v));
			}
			$this->annProcessed[$method]['methods'][$key] = $tmp;
		}
	}