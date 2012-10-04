<?php
    /**
     * 
     * Classe _APP
     * 
     * Este arquivo contém o sistema principal da aplicação. A classe _APP é a responsável por
     * realizar o tratamento de endereços, carregamento de classes e, após uma requisição, chamar
     * a classe certa requerida e executar o método correto.
     * 
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * 
     * @method __construct
     * @method run
     * 
     */
    class _APP{
        
        /**
         * Carrega as classes necessárias e roda a aplicação
         * @param string $route
         */
        function __construct($route){
            //inclui a função autoload()
            include(_GLOBAL::SYS_PATH()."/_AUTOLOAD.php");
            spl_autoload_register('autoload'); //carrega o __autoload com a função autoload()
            
            try{
                $this->run($route); //tenta carregar a rota
            }
            catch(exception $e){
                //caso contrário, lança uma excessão
                if(_GLOBAL::$DEBUG) echo "Ops! {$e->getMessage()} na linha {$e->getLine()} do arquivo {$e->getFile()}";
                else echo "Ocorreu um erro no sistema! Entre em contato com o administrador através do e-mail: "._USER::$EMAIL_ADMIN;
            }
        }
        
        /**
         * Faz o tratamento das rotas, instancia a classe e executa seu método
         * @param string $route
         */
        public function run($route=NULL){
            $controller = Config::$main_controller; //Define a classe acessada como a definida em Config (controlador default)
            $method = Config::$main_method; //Define o método acessado como o definido em Config
            if(!is_null($route)){
                //Caso uma rota tenha sido passada pelo endereço através do elemento 'r' do $_GET, a rota será tratada e redefinida
                $route = explode('/',$route);
                $controller = ucfirst($route[0]);
                if(sizeof($route)>1) $method = $route[1];
            }
            
            // Faz as verificações de existência da rota e, caso não haja erros, a carrega
            if(class_exists($controller)){
                $app = new $controller();
                if(method_exists($app, $method))
                    $app->$method();
                else throw new Exception("Endereço inexistente", 1);
                
            }
            else throw new Exception("Endereço inexistente", 2);
        }
        
    }

// Fim do arquivo _APP.php