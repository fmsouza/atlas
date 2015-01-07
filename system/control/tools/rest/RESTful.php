<?php
/**
 * Contains RESTful class
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

    use system\control\Core;
    use system\control\tools\rest\Resource;
    use system\control\tools\rest\RESTfulAnnotation;

    /**
     * Contains RESTful class
     * @package system\control\tools\rest
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
         * @ignore
         */
        public function __construct($resources=null){
        	if(is_null($resources))
                $resources = Core::getConfig()->resources;
        	$this->prepareResources($resources);
        }

        /**
         * @ignore
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