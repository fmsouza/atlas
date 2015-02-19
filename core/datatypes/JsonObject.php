<?php
namespace core\datatypes;

use core\tools\Util;

/**
 * Constructs dynamically a JSON Object
 * @package core\datatypes
 */
class JsonObject{
    
    /**
     * @ignore
     */
    private $data = array();

    /**
     * Creates a JsonObject from a stdClass, string or array
     * @param mixed $json Json data
     * @return JsonObject
     */
    public function __construct(\stdClass $json=null){
        if(!is_null($json)){
            foreach (get_object_vars($json) as $key => $value) {
                if(is_string($value) || is_numeric($value) || is_bool($value)){
                    $this->setKey($key, $value);
                }
                else if(is_object($value)){
                    $this->setKey($key, new JsonObject($value));
                }
                else if(is_array($value)){
                    if(isset($value[0]) && is_string($value[0])){
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
        return ($this->exists($key))? $this->data[$key] : null;
    }

    public function exists($key){
        return isset($this->data[$key]);
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
        return array_keys($this->data);
    }
    
	/**
	 * Returns the number of keys set in the object
	 * @return int
	 */
    public function size(){
        return count($this->data);
    }

    /**
     * @param $key
     * @return mixed
     * @ignore
     */
    public function __get($key){
        return $this->getKey($key);
    }

    /**
     * @param $key
     * @param $value
     * @ignore
     */
    public function __set($key, $value){
        $this->data[$key] = $value;
    }

    /**
     * Gets the JSON data as scalar array
     * @return array
     */
    public function toArray(){
        return $this->data;
    }
    
    /**
     * @ignore
     */
    public function __toString(){
        $return = "";
        if($this->size()>0){
            foreach($this->data as $key => $value){
                $return .= (is_numeric($value) || $value instanceof ArrayList || $value instanceof JsonObject)?
                    "$key: $value, " : "$key: \"$value\", ";
            }
            $return = substr($return, 0, -2);
        }
        return '{'.$return.'}';
    }
}