<?php
namespace core\tools\rest;

use core\control\System;

/**
 * Contains RESTful class
 * @package core\control\tools\rest
 */
class RESTful{

    /**
     * @ignore
     */
    private $annotations = [];

    /**
     * @ignore
     */
    private $response = "";

    /**
     * Creates a RESTful service
     * @param array Resource classes list
     * @return RESTful
     */
    public function __construct($resources=null){
    	if(is_null($resources))
            $resources = System::getConfig()->resources;
    	$this->prepareResources($resources);
    }

    /**
     * Prepare the resources to be loaded and handle the requests
     * @param array $resources Resource classes list
     * @return void
     */
    private function prepareResources($resources){
        if(!count($resources)) return false;
        $last = NULL;
        $current = NULL;
        foreach ($resources as $resource){
            $handler = str_replace('.', '\\', $resource);
            $annotation = new RESTfulAnnotation(new $handler(''));
            if(!($annotation->getSourceObject() instanceof Resource))
                throw new \InvalidArgumentException('Invalid resource');
            $this->annotations[] = $annotation;
        }
    }

    /**
     * Starts to deal to the requests and serves the response
     * @return void
     */
	public function serve(){
        RESTfulAnnotation::$urlPath = $_SERVER['PATH_INFO'];
        RESTfulAnnotation::$request = $_SERVER['REQUEST_METHOD'];
        $this->response = $this->annotations[0]->getSourceObject()->error();
        foreach ($this->annotations as $ann) {
            $response = $ann->proccess();
            if($response){
                $this->response = $response;
                break;
            }
        }
	}

    /**
     * Returns the request response
     * @return string
     */
	public function getResponse(){
		return $this->response;
	}
}