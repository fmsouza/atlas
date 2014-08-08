<?php

    class JsonObject{
        
        private $data = array();
        
        public function getKey($key){
            return $this->data[$key];
        }
        
        public function setKey($key, $value){
            $this->data[$key] = $value;
        }
        
        public function remove($key){
            unset($this->data[$key]);
        }
        
        public function keys(){
            $return = array();
            foreach($this->data as $key => $value){
                $return[] = $key;
            }
            return $return;
        }
        
        public function size(){
            return count($this->data);
        }
        
        public function __toString(){
            $return = "";
            if($this->size()>0){
                foreach($this->data as $key => $value){
                    $return .= (is_numeric($value) || $value instanceof ArrayList || $value instanceof JsonObject)?
                        "$key: $value, ":"$key: '$value', ";
                }
                $return = substr($return, 0, -2);
            }
            return "{{$return}}";
        }
    }