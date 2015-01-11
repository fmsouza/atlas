<?php
	namespace core\tools\rest;

	use core\tools\Annotation;

	class RESTfulAnnotation extends Annotation{

		private $data;
		private $path;
		public static $urlPath;
		public static $request;

		public function __construct(Resource $obj){
			parent::__construct($obj);
		}

		public function getParams(){
			if(is_null($this->data))
				$this->data = $this->parse();
			return $this->data;
		}

		public function proccess(){
			$this->parse();
			$obj = $this->getSourceObject();
			$ann = $this->getAnnotations();
			$response = false;

			foreach ($ann as $method => $data) {
				if(property_exists($data->methods, 'route')){
					$route = $data->methods->route;
					$args = $obj->answerRequest($route->method);
					if(strpos(self::$urlPath, $route->path)==1 && self::$request==$route->method){
						$response = $obj->$method($args);
					}
				}
			}
			return $response;
		}
	}