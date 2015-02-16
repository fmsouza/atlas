<?php
namespace core\datatypes;

/**
 * Implements the ArrayList data type to do the manipulation with every
 * kind of data in a list.
 * 
 * @package core\control\datatypes
 */
class ArrayList extends \ArrayObject{
    
	/**
     * Uses as standard array
	 * @var int
	 */
    const STANDARD_ARRAY = 1;
    
	/**
     * Uses as object
	 * @var int
	 */
    const OBJECT_ARRAY = 2;
    
	/**
     * Value Sort algorithm
	 * @var int
	 */
    const VALUE_SORT = 3;
    
	/**
     * Key Sort algorithm
	 * @var int 
	 */
    const KEY_SORT = 4;
    
	/**
     * Natural Case Sensitive Sort algorithm
	 * @var int 
	 */
    const NATURAL_CASE_SORT = 5;
    
	/**
     * Natural Sort algorithm
	 * @var int 
	 */
    const NATURAL_SORT = 6;
    
	/**
     * Compare Sort algorithm
	 * @var int
	 */
    const CMP_SORT = 7;
    
	/**
     * Key Compare Sort algorithm
	 * @var int
	 */
    const KEY_CMP_SORT = 8;
    
    /**
     * Creates an instance of Database
     * @param array $value default PHP array
     * @param int $pattern List output pattern
     * @return ArrayList
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
	 * @return mixed
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
     * @return void
     */
    public function overwrite($data){
        $this->exchangeArray($data);
    }
    
    /**
     * Adds the element to the end of the List
     * @param mixed $value
     * @return void
     */
    public function push($value){
        $this->append($value);
    }
    
    /**
     * Removes and returns the last element of the List
     * @return mixed
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
     * @return void
     */
    public function remove($index){
        if($this->hasIndex($index))
            $this->offsetUnset($index);
    }
    
    /**
     * Returns the List size
     * @return int
     */
    public function size(){
        return $this->count();
    }
    
    /**
     * Set the type of the list
     * @param int $pattern List type flag
     * @return void
     */
    public function setAccessPattern($pattern){
        $this->setFlags($pattern);
    }
    
    /**
     * Sort the list with the chosen algorithm
     * @param int $type Algorithm selector
     * @param string $callback Callback function name to sort
     * @return void
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
                else throw new \InvalidArgumentException("The selected sort requires a callback function");
                break;
            case self::KEY_CMP_SORT:
                if(!empty($callback)) $this->uksort($callback);
                else throw new \InvalidArgumentException("The selected sort requires a callback function");
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
                $return .= (is_numeric($value) || $value instanceof \ArrayObject || $value instanceof JsonObject)?
                    "$value, ":"\"$value\", ";
                $iterator->next();
            }
            $return = substr($return, 0, -2);
        }
        return "[$return]";
    }
}