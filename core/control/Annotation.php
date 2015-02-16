<?php

namespace core\control;

use core\tools\Util;

/**
 * Implements Annotation support for the application through the DocBlocks.
 * @package core\control\tools
 * @abstract
 */
abstract class Annotation{
	
	/**
	 * Annotated class object
	 * @var mixed
	 */
	private $object;
	
	/**
	 * Reflection of the given object
	 * @var \ReflectionClass
	 */
	private $reflection;
	
	/**
	 * Start identifier
	 * @var string
	 */
	protected $identifier;
	
	/**
	 * End identifier
	 * @var string
	 */
	protected $lineDelimiter;
	
	/**
	 * Function 'key:value' separator
	 * @var string
	 */
	protected $methodDelimiter;
	
	/**
	 * Function argument separator
	 * @var string
	 */
	protected $methodArgSeparator;
	
	/**
	 * Annotations processed
	 * @var string
	 */
	private $annProcessed = [];
	
	/**
	 * @ignore
	 */
	const CLASSL = 'class';
	
	/**
	 * @ignore
	 */
	const PARAML = 'variables';
	
	/**
	 * @ignore
	 */
	const METHODL = 'functions';

	/**
	 * Creates an Annotation instance for some object
	 * @param \stdClass $obj
	 * @param string $identifier
	 * @param string $lineDelimiter
	 * @param string $methodDelimiter
	 * @param string $methodArgSeparator
	 * @return Annotation
	 */
	public function __construct(\stdClass $obj, $identifier='@', $lineDelimiter='\n', $methodDelimiter=':', $methodArgSeparator=','){
		$this->reflection = new \ReflectionClass(get_class($obj));
		$this->object = $obj;
		$this->identifier = $identifier;
		$this->lineDelimiter = $lineDelimiter;
		$this->methodDelimiter = $methodDelimiter;
		$this->methodArgSeparator = $methodArgSeparator;
	}

	/**
	 * Gets the base object class name
	 * @return string
	 */
	public function getSourceClass(){
		return get_class($this->object);
	}

	/**
	 * Gets the base object
	 * @return mixed
	 */
	public function getSourceObject(){
		return $this->object;
	}

	/**
	 * Gets the annotation list
	 * @return mixed
	 */
	public function getAnnotations(){
		return Util::listToObject($this->annProcessed);
	}

	/**
	 * Parses all the annotations on the base class
	 * @return void
	 */
	protected function parse(){
        $reflection = $this->reflection;
        foreach ($reflection->getMethods() as $method) {
            $doc = Util::getInBetweenStrings($this->identifier, $this->lineDelimiter, $method->getDocComment());
            if(!$doc) continue;
			foreach($doc as $data){
				if(strstr($data, '(') && strstr($data, ')')){
					$this->parseFunction($data, $method->name);
				}else{
					$this->parseVar($data, $method->name);
				}
            }
        }
	}

	/**
	 * Parses an annotation simple markup variable
	 * @param string $arg
	 * @param string $method
	 * @return void
	 */
	private function parseVar($arg, $method){
		$this->annProcessed[$method][self::PARAML] = str_replace('\'', '', $arg);
	}

	/**
	 * Parses an annotation function
	 * @param string $arg
	 * @param string $method
	 */
	private function parseFunction($arg, $method){
		$key = lcfirst(Util::getInBetweenStrings('^','\(',$arg)[0]);
		$value = Util::getInBetweenStrings('\(','\)',$arg)[0];
		$data = explode($this->methodArgSeparator, $value);
		$tmp = array();
		foreach ($data as $d) {
			list($k, $v) = explode($this->methodDelimiter, $d);
			$tmp[trim($k)] = trim(str_replace('\'', '', $v));
		}
		$this->annProcessed[$method][self::METHODL][] = array('function'=>$key, 'args'=> $tmp);
	}
}