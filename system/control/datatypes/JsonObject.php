<?php
/**
 * Contains JsonObject class
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @author Julio Cesar (thisjulio@gmail.com)
 * 
 * @copyright Copyright 2014 Frederico Souza
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
    
    namespace system\control\datatypes;

    use system\control\datatypes\ArrayList;
    use system\control\tools\Util;

	/**
	 * Constructs dynamically a JSON Object
	 * @package system\control\datatypes
	 */
    class JsonObject{
        
        /**
         * @ignore
         */
        private $data = array();

        public function __construct(\stdClass $json=null){
            if(!is_null($json)){
                foreach (get_object_vars($json) as $key => $value) {
                    if(is_string($value)){
                        $this->setKey($key, $value);
                    }
                    else if(is_object($value)){
                        $this->setKey($key, new JsonObject($value));
                    }
                    else if(is_array($value)){
                        if(is_string($value[0])){
                            $this->setKey($key, new ArrayList($value));
                        }
                        else{
                            $this->setKey($key, Util::parseJsonList($value));
                        }
                    }
                }
            }
        }
        
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