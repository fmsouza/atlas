<?php
    /**
     * Controlador de requisição de rota
     */
    class _APP{
    
        function __construct($route){
            include(_GLOBAL::SYS_PATH()."/_AUTOLOAD.php");
            spl_autoload_register('autoload');
            
            try{
                $this->run($route);
            }
            catch(exception $e){
                if(_GLOBAL::$DEBUG) echo "Ops! {$e->getMessage()} na linha {$e->getLine()} do arquivo {$e->getFile()}";
                else echo "Ocorreu um erro no sistema! Entre em contato com o administrador através do e-mail: "._USER::$EMAIL_ADMIN;
            }
        }
        
        public function run($route=NULL){
            $controller = Config::$main_controller;
            $method = Config::$main_method;
            if(!is_null($route)){
                $route = explode('/',$route);
                $controller = ucfirst($route[0]);
                if(sizeof($route)>1) $method = $route[1];
            }
            
            if(class_exists($controller)){
                $app = new $controller();
                if(method_exists($app, $method))
                    $app->$method();
                else throw new Exception("Endereço inexistente", 1);
                
            }
            else throw new Exception("Endereço inexistente", 2);
        }
        
    }  