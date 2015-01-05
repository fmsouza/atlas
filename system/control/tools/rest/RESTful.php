<?php
/**
 * Contains RESTful class
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * 
 * @copyright Copyright 2014 Marvie
 * Licensed under the Apache License, Version 2.0 (the “License”);
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an “AS IS” BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

    namespace system\control\tools\rest;

    use system\control\tools\rest\Resource;
    use system\control\Core;

    /**
     * Contains RESTful class
     * @package system\control\tools\rest
     */
	class RESTful{

        /**
         * @ignore
         */
		private $resources;

        /**
         * @ignore
         */
        private $response = "";

        /**
         * @ignore
         */
        public function __construct($resources=null){
        	if(is_null($resources)) $resources = Core::getConfig()->resources;
        	$this->resources = $this->prepareResources($resources);
        }

        /**
         * @ignore
         */
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

        /**
         * Starts to deal to the requests and serves the response
         * @return void
         */
		public function serve(){
			Resource::setMethod($_SERVER['REQUEST_METHOD']);
            $request = (isset($_SERVER['PATH_INFO']))? explode("/", substr($_SERVER['PATH_INFO'], 1)) : false;
            $this->response = $this->resources->processRequest($request[0]);
		}

        /**
         * Returns the request response
         * @return string
         */
		public function getResponse(){
			return $this->response;
		}
	}