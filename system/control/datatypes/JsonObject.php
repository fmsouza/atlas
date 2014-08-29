<?php
	/**
	 * Contains JsonObject class
	 * @author Frederico Souza (fredericoamsouza@gmail.com)
	 * @author Julio Cesar (thisjulio@gmail.com)
	 * 
	 * @copyright Copyright 2013 Frederico Souza
	 * Licensed under the Apache License, Version 2.0 (the "License");
	 * you may not use this file except in compliance with the License.
	 * You may obtain a copy of the License at
	 * http://www.apache.org/licenses/LICENSE-2.0
	 * Unless required by applicable law or agreed to in writing, software
	 * distributed under the License is distributed on an "AS IS" BASIS,
	 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	 * See the License for the specific language governing permissions and
	 * limitations under the License.
	 */
	/**
	 * Constructs dynamically a JSON Object
	 * @package system
	 * @subpackage control_datatypes
	 */
    class JsonObject{
        
        /**
         * @ignore
         */
        private $data = array();
        
		/**
		 * Returns the key value
		 * @param string $key
		 * @return mixed
		 */
        public function getKey($key){
            return $this->data[$key];
        }
        
		/**
		 * Set the key value
		 * @param string $key
		 * @param mixed $value
		 * @return void
		 */
        public function setKey($key, $value){
            $this->data[$key] = $value;
        }
        
		/**
		 * Unsets the key
		 * @param string $key
		 * @return void
		 */
        public function remove($key){
            unset($this->data[$key]);
        }
        
		/**
		 * Returns an array with the key names set in the object
		 * @return array
		 */
        public function keys(){
            $return = array();
            foreach($this->data as $key => $value){
                $return[] = $key;
            }
            return $return;
        }
        
		/**
		 * Returns the number of keys set in the object
		 * @return int
		 */
        public function size(){
            return count($this->data);
        }
        
        /**
         * @ignore
         */
        public function __toString(){
            $return = "";
            if($this->size()>0){
                foreach($this->data as $key => $value){
                    $return .= (is_numeric($value) || $value instanceof ArrayList || $value instanceof JsonObject)?
                        "$key: $value, ":"$key: \"$value\", ";
                }
                $return = substr($return, 0, -2);
            }
            return "{{$return}}";
        }
    }