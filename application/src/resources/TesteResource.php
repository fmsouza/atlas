<?php

    namespace application\src\resources;

    use system\control\tools\rest\Resource;

    class TesteResource extends Resource{
        
        protected function get($data){
            $this->success('Hello World!');
        }
        
        protected function post($data){
            return $this->error('Operation not supported');
        }
        
        protected function put($data){
            return $this->error('Operation not supported');
            
        }
        
        protected function delete($data){
            return $this->error('Operation not supported');
        }
    }