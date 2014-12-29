<?php
	/**
	 * Implements the ArrayList data type to do the manipulation with every
	 * kind of data in a list.
	 * 
	 * @author Frederico Souza (fredericoamsouza@gmail.com)
	 *
	 * @copyright Copyright 2014 Frederico Souza
	 * Licensed under the Apache License, Version 2.0 (the ÒLicenseÓ);
	 * you may not use this file except in compliance with the License.
	 * You may obtain a copy of the License at
	 * http://www.apache.org/licenses/LICENSE-2.0
	 * Unless required by applicable law or agreed to in writing, software
	 * distributed under the License is distributed on an ÒAS ISÓ BASIS,
	 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	 * See the License for the specific language governing permissions and
	 * limitations under the License.
	 */
    
    namespace system\control\datatypes;
    use system\control\datatypes\JsonObject;
	/**
	 * Implements the ArrayList data type to do the manipulation with every
	 * kind of data in a list.
	 * 
	 * @package system
	 * @subpackage control/datatypes
	 */
    class ArrayList extends \ArrayObject{
        
		/**
		 * @var Uses as standard array
		 */
        const STANDARD_ARRAY = 1;
        
		/**
		 * @var Uses as object
		 */
        const OBJECT_ARRAY = 2;
        
		/**
		 * @var int Value Sort algorithm
		 */
        const VALUE_SORT = 3;
        
		/**
		 * @var int Key Sort algorithm
		 */
        const KEY_SORT = 4;
        
		/**
		 * @var int Natural Case Sensitive Sort algorithm
		 */
        const NATURAL_CASE_SORT = 5;
        
		/**
		 * @var int Natural Sort algorithm
		 */
        const NATURAL_SORT = 6;
        
		/**
		 * @var int Compare Sort algorithm
		 */
        const CMP_SORT = 7;
        
		/**
		 * @var int Key Compare Sort algorithm
		 */
        const KEY_CMP_SORT = 8;
        
		/**
		 * @ignore
		 */
        public function __construct($value=array(), $pattern=\ArrayObject::STD_PROP_LIST){
            parent::__construct($value, $pattern);
        }
		
		/**
		 * Verifies is the index exists
		 * @param int $index
		 * @return boolean
		 */
        public function hasIndex($index){
            return $this->offsetExists($index);
        }
		
		/**
		 * Returns the content set on the index
		 * @param int $index
		 * @return mixed|boolean
		 */
        public function get($index){
            return ($this->hasIndex($index))? $this->offsetGet($index):false;
        }
        
        /**
         * Overrides the value set on the index
         * @param int $index
         * @param mixed $value
         * @return void
         */
        public function set($index, $value){
            $this->offsetSet($index, $value);
        }
        
        /**
         * Overwrite the object with an data array
         * @param array $data
         * return void
         */
        public function overwrite($data){
            $this->exchangeArray($data);
        }
        
        /**
         * Adds the element to the end of the List
         * @param mixed $value
         * return void
         */
        public function push($value){
            $this->append($value);
        }
        
        /**
         * Removes and returns the last element of the List
         * return mixed
         */
        public function pop(){
            $index = $this->size()-1;
            $value = $this->get($index);
            $this->remove($index);
            return $value;
        }
        
        /**
         * Removes the content set on the index
         * @param int $index
         * return void
         */
        public function remove($index){
            if($this->hasIndex($index))
                $this->offsetUnset($index);
        }
        
        /**
         * Returns the List size
         * return int
         */
        public function size(){
            return $this->count();
        }
        
        /**
         * Set the type of the list
         * @param int $pattern List type flag
         * return void
         */
        public function setAccessPattern($pattern){
            $this->setFlags($pattern);
        }
        
        /**
         * Sort the list with the chosen algorithm
         * @param int $type Algorithm selector
         * @param string $callback Callback function name to sort
         * return void
         */
        public function sort($type, $callback=""){
            switch($type){
                case self::VALUE_SORT:
                    $this->asort();
                    break;
                case self::KEY_SORT:
                    $this->ksort();
                    break;
                case self::NATURAL_CASE_SORT:
                    $this->natcasesort();
                    break;
                case self::NATURAL_SORT:
                    $this->natsort();
                    break;
                case self::CMP_SORT:
                    if(!empty($callback)) $this->uasort($callback);
                    else throw new InvalidArgumentException("The selected sort requires a callback function");
                    break;
                case self::KEY_CMP_SORT:
                    if(!empty($callback)) $this->uksort($callback);
                    else throw new InvalidArgumentException("The selected sort requires a callback function");
                    break;
            }
        }
        
		/**
		 * @ignore
		 */
        public function __toString(){
            $return = "";
            $iterator = $this->getIterator();
            if($this->size()>0){
                while($iterator->valid()){
                    $value = $iterator->current();
                    $return .= (is_numeric($value) || $value instanceof ArrayObject || $value instanceof JsonObject)?
                        "$value, ":"\"$value\", ";
                    $iterator->next();
                }
                $return = substr($return, 0, -2);
            }
            return "[$return]";
        }
    }