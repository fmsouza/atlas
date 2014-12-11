<?php

	class RESTful{

		private $resources;
        private $response = "";

        public function __construct($resources=null){
        	if(is_null($resources)) $resources = Path::$config->resources;
        	$this->resources = $this->prepareResources($resources);
        }
        
        private function prepareResources($resources){
            if(!count($resources)) return false;
            $path = explode("/",$resources[0]->handler);
            $handler = array_pop($path);
            Import::package(implode("/",$path));
            $resource = new $handler($resources[0]->route);
            $current = $resource;
            for($i=1; $i<count($resources); $i++){
                $tmp = $resources[$i];
                if(!($tmp instanceof Resource))
                    throw new InvalidArgumentException(Main::$strings->invalid_resource);
                $current->setSuccessor($tmp);
                $current = $tmp;
            }
            return $resource;
        }

		public function serve(){
			Resource::setMethod($_SERVER['REQUEST_METHOD']);
            $request = (isset($_SERVER['PATH_INFO']))? explode("/", substr($_SERVER['PATH_INFO'], 1)) : false;
            $this->response = $this->resources->processRequest($request[0]);
		}

		public function getResponse(){
			return $this->response;
		}
	}