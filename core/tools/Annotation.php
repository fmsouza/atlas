<?php
namespace core\tools;

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
	 * @var ReflectionClass
	 */
	private $reflection;
	
	/**
	 * Start identifier
	 * @var string
	 */
	private $identifier;
	
	/**
	 * Parameter separator
	 * @var string
	 */
	private $varDelimiter;
	
	/**
	 * End identifier
	 * @var string
	 */
	private $lineDelimiter;
	
	/**
	 * Function 'key:value' separator
	 * @var string
	 */
	private $methodDelimiter;
	
	/**
	 * Function argument separator
	 * @var string
	 */
	private $methodArgSeparator;
	
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
	const PARAML = 'params';
	
	/**
	 * @ignore
	 */
	const METHODL = 'methods';

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
        $reflection = $this->reflection;
        foreach ($reflection->getMethods() as $method) {
            $doc = Util::getInbetweenStrings($this->identifier, $this->lineDelimiter, $method->getDocComment());
            if(!$doc) continue;
            for($i=0; $i<count($doc); $i++){
            	$data = $doc[$i];
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
		$this->annProcessed[$method][self::PARAML][$key] = str_replace('\'', '', $value);
	}

	private function parseMethod($arg, $method){
		$key = Util::getInbetweenStrings('^','\(',$arg)[0];
		$value = Util::getInbetweenStrings('\(','\)',$arg)[0];
		$data = explode($this->methodArgSeparator, $value);
		$tmp = array();
		foreach ($data as $d) {
			list($k, $v) = explode($this->methodDelimiter, $d);
			$tmp[trim($k)] = trim(str_replace('\'', '', $v));
		}
		$this->annProcessed[$method][self::METHODL][$key] = $tmp;
	}
}