<?php
namespace core\tools\rest;

use core\control\Annotation;
use core\tools\Util;

class RESTfulAnnotation extends Annotation{

	private $path;
	private $pathVariableIdentifier;
	public static $urlPath;
	public static $request;

	public function __construct(Resource $obj, $pathVariableIdentifier='#'){
		$this->pathVariableIdentifier = $pathVariableIdentifier;
		parent::__construct($obj);
	}

	protected function route($method, $requestMethod, $urlData=array()){
		$obj = $this->getSourceObject();
		$args = $obj->answerRequest($requestMethod);
		return $obj->$method($args, $urlData);
	}

	public function process(){
		$this->parse();
		foreach ($this->getAnnotations() as $method => $annotations) {
			$data = $annotations;
			if(!isset($data->functions)) continue;
			foreach($data->functions as $o){
				if($o->function=='route'){
					$args = $o->args;
					$urlData = array();
					if(strstr($args->path, $this->pathVariableIdentifier)){
						$urlData = $this->getUrlData($args->path);
						$args->path = $this->extractBaseServiceUrl($args->path);
					}
					if(strpos(strtolower(self::$urlPath), strtolower($args->path))==1 && self::$request==$args->method){
						return $this->route($method, $args->method, $urlData);
					}
				}
			}
		}
		return false;
	}

	private function getUrlData($urlVars){
		$labels = Util::getInBetweenStrings($this->pathVariableIdentifier, $this->pathVariableIdentifier, $urlVars);
		$labels = explode('/',$labels[0]);
		$urlData = explode('/',self::$urlPath);
		array_shift($urlData);
		$urlLabelled = explode('/',$urlVars);
		$tmp = array();
		foreach ($labels as $label) {
			for($i=0; $i<count($urlData); $i++){
				if(strstr($urlLabelled[$i], $label) && !empty($urlData[$i])){
					$tmp[$label] = $urlData[$i];
				}
			}
		}
		return $tmp;
	}

	private function extractBaseServiceUrl($url){
		return explode($this->pathVariableIdentifier, $url)[0];
	}
}