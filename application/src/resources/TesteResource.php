<?php
/**
 * Contains TesteResource class
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

    namespace application\src\resources;

    use system\control\tools\rest\Resource;

    /**
     * TesteResource class
     * 
     * It's a sample class which handles RESTful requests as
     * described in the config.json file.
     *
     * You don't need to follow a naming pattern to the methods.
     * The only rule still is that you can't name equally more than
     * one method.
     *
     * @package application\src\resources
     */
    class TesteResource extends Resource{
        
        /**
        * Handles the GET request
        * @route(path: 'teste/hello', method: 'GET');
        * @param json $data Data provided
        * @return void
        */
        public function getMethod($data){
            return $this->success('Hello World!');
        }
        
        /**
        * Handles the POST request
        * @route(path: 'teste/post', method: 'POST');
        * @param json $data Data provided
        * @return void
        */
        public function postMethod($data){
            return $this->error('Operation not supported');
        }
        
        /**
        * Handles the PUT request
        * @route(path: 'teste/put', method: 'PUT');
        * @param json $data Data provided
        * @return void
        */
        public function putMethod($data){
            return $this->error('Operation not supported');
        }
        
        /**
        * Handles the DELETE request
        * @route(path: 'teste/delete', method: 'DELETE');
        * @param json $data Data provided
        * @return void
        */
        public function deleteMethod($data){
            return $this->error('Operation not supported');
        }
    }