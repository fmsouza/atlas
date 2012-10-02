<?php
    /**
     * Controlador de requisição de rota
     */
    class _APP{
    
        function __construct($route){
            $this->run($route);
        }
        
        public function run($route=NULL){
            $controller = Config::main_controller();
            $method = Config::main_method();
            if(!is_null($route)){
                $route = explode('/',$route);
                $controller = $route[0];
                if(sizeof($route)>1) $method = $route[1];
            }
            
            $app = new $controller();
            $app->$method();
        }
        
    }  