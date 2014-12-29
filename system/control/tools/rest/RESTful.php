<?php

    namespace system\control\tools\rest;

    use system\control\tools\rest\Resource;
    use system\control\Core;

	class RESTful{

		private $resources;
        private $response = "";

        public function __construct($resources=null){
        	if(is_null($resources)) $resources = Core::getConfig()->resources;
        	$this->resources = $this->prepareResources($resources);
        }
        
        private function prepareResources($resources){
            if(!count($resources)) return false;
            $last = NULL;
            $current = NULL;
            foreach ($resources as $resource){
                $handler = str_replace('.', '\\', $resource->handler);
                $current = new $handler($resource->route);
                if(!($current instanceof Resource))
                    throw new \InvalidArgumentException('Invalid resource');
                if(!is_null($last)) $current->setSuccessor($last);
                $last = $current;
            }
            return $current;
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