<?php

class ArrayList{
    
    private $data = array();
    
    public function get($index){
        return $this->data[$index];
    }
    
    public function set($index, $value){
        $this->data[$index] = $value;
    }
    
    public function push($value){
        array_push($this->data, $value);
    }
    
    public function pop(){
        array_pop($this->data);
    }
    
    public function remove($index){
        unset($this->data[$index]);
    }
    
    public function size(){
        return count($this->data);
    }
    
    public function __toString(){
        $return = "";
        if($this->size()>0){
            foreach($this->data as $value){
                $return .= (is_numeric($value) || $value instanceof ArrayList || $value instanceof JsonObject)?
                    "$value, ":"'$value', ";
            }
            $return = substr($return, 0, -2);
        }
        return "[$return]";
    }
}