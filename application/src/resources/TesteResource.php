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
     * described in the config.json file to '/hello' route.
     *
     * @package application\src\resources
     */
    class TesteResource extends Resource{
        
        /**
        * Handles the GET request
        * @param json $data Data provided
        * @return void
        */
        protected function get($data){
            $this->success('Hello World!');
        }
        
        /**
        * Handles the POST request
        * @param json $data Data provided
        * @return void
        */
        protected function post($data){
            return $this->error('Operation not supported');
        }
        
        /**
        * Handles the PUT request
        * @param json $data Data provided
        * @return void
        */
        protected function put($data){
            return $this->error('Operation not supported');
        }
        
        /**
        * Handles the DELETE request
        * @param json $data Data provided
        * @return void
        */
        protected function delete($data){
            return $this->error('Operation not supported');
        }
    }