<?php

    class ArrayList extends ArrayObject{
        
        const STANDARD_ARRAY = 1;
        const OBJECT_ARRAY = 2;
        
        const VALUE_SORT = 3;
        const KEY_SORT = 4;
        const NATURAL_CASE_SORT = 5;
        const NATURAL_SORT = 6;
        const CMP_SORT = 7;
        const KEY_CMP_SORT = 8;
        
        public function __construct($value=array(), $pattern=ArrayObject::STD_PROP_LIST){
            parent::__construct($value, $pattern);
        }
        
        public function hasIndex($index){
            return $this->offsetExists($index);
        }
        
        public function get($index){
            return ($this->hasIndex($index))? $this->offsetGet($index):false;
        }
        
        public function set($index, $value){
            $this->offsetSet($index, $value);
        }
        
        public function overwrite($data){
            $this->exchangeArray($data);
        }
        
        public function push($value){
            $this->append($value);
        }
        
        public function pop(){
            $index = $this->size()-1;
            $value = $this->get($index);
            $this->remove($index);
            return $value;
        }
        
        public function remove($index){
            if($this->hasIndex($index))
                $this->offsetUnset($index);
        }
        
        public function size(){
            return $this->count();
        }
        
        public function setAccessPattern($pattern){
            $this->setFlags($pattern);
        }
        
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
        
        public function __toString(){
            $return = "";
            $iterator = $this->getIterator();
            if($this->size()>0){
                while($iterator->valid()){
                    $value = $iterator->current();
                    $return .= (is_numeric($value) || $value instanceof ArrayObject || $value instanceof JsonObject)?
                        "$value, ":"'$value', ";
                    $iterator->next();
                }
                $return = substr($return, 0, -2);
            }
            return "[$return]";
        }
    }