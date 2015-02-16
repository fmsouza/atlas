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
    private $response;

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
        if(!count($resources)) return;
        foreach ($resources as $resource){
            $handler = str_replace('.', '\\', $resource);
            $resource = new $handler();
            if(!$resource instanceof Resource)
                throw new \InvalidArgumentException('Invalid resource');

            $this->annotations[] = new RESTfulAnnotation($resource);
        }
    }

    /**
     * Starts to deal to the requests and serves the response
     * @return void
     * @throws WebServiceNotFoundException
     */
	public function serve(){
        $environmentData = System::getEnvironmentData();
        if(!isset($environmentData['PATH_INFO'])) throw new WebServiceNotFoundException('Undefined service');
        RESTfulAnnotation::$urlPath = $environmentData['PATH_INFO'];
        RESTfulAnnotation::$request = $environmentData['REQUEST_METHOD'];
        foreach ($this->annotations as $ann) {
            $response = $ann->process();
            if($response){
                $this->response = $response;
                break;
            }elseif(is_null($this->response)){
                $this->response = $ann->getSourceObject()->error();
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