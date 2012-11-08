<?php
    /**
     * 
     * Classe _APP
     * 
     * Este arquivo contém a classe principal da aplicação. A classe _APP é a responsável por
     * realizar o tratamento de endereços, carregamento de classes e, após uma requisição, chamar
     * o método certo requerido para executar determinada ação.
     * 
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * 
     * @method __construct
     * @method run
     * @method index
     * @method @static display
     * 
     */
    abstract class _APP{
        
        /**
         * Carrega as classes necessárias e roda a aplicação
         * @param string $route
         * @return void
         */
        public function __construct($route){
            try{
                $this->run($route); //tenta carregar a rota
            }
            catch(exception $e){
                //caso contrário, lança uma excessão
                if(_GLOBAL::$DEBUG) self::display($e->getMessage());
                else exit("Ocorreu um erro no sistema! Entre em contato com o administrador através do e-mail: "._USER::$EMAIL_ADMIN);
            }
        }
        
        /**
         * Faz o tratamento das rotas, instancia a classe e executa seu método
         * @param string $route
         * @return Exception
         */
        private function run($method){
            // Faz as verificações de existência da rota e, caso não haja erros, a carrega
            if(method_exists($this, $method))
                $this->$method();
            else throw new Exception("Ação {$method} não existente na aplicação", 1);
        }
        
        /**
         * Lança uma mensagem de erro caso o usuário não crie um método Index para entrar no sistema
         * @return Exception
         */
        protected function index(){
            throw new Exception("Ação index não implementada na aplicação.", 666);
        }

        /**
         * Saída de dados
         * @param string $value
         * @return void
         */
        public static function display($value){
            echo $value;
        }
    }