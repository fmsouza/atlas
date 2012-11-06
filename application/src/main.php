<?php

    /**
     * 
     * Classe Main
     * 
     * Definida na classe Config como a classe principal de entrada no sistema através do
     * parâmetro $main_controller. Isso quer dizer que quando não for passada nenhuma classe pela URL
     * através do parâmetro 'r' do método $_GET essa classe será carregada e o método que será executado
     * será o index() porque também foi definido desta forma através do parâmetro $main_method da classe
     * Config.
     * 
     * O controlador é a classe responsável pela lógica de toda a aplicação. É o intermédio entre os modelos
     * e as Views. É nos métodos dos controladores que devemos carregar as classes necessárias para a página.
     * Um dos pilares do MVC é a ideia de manter o HTML e o PHP bem separados, ou seja, não misturar o
     * conteúdo estático e o dinâmico. Portanto, todo o conteúdo lógico deve ser escrito nas classes controladoras
     * e substituído nas páginas HTML através da classe _HTML e suas aplicações.
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * 
     * @method index
     * 
     */
    class Main extends _APP{
        
        private $html;
        
        public function __construct($route){
            //_USER::$EMAIL_ADMIN="exemplo@email.com";
            //_GLOBAL::$DEBUG=FALSE;
            $this->html = new _HTML();
            
            parent::__construct($route);
        }
        
        /**
         * Método principal da classe Main.
         * @return void
         */
        public function index(){
            $this->html->addToHeader(new GenericElement('title',array(),'Pagina de Teste'));
            $this->html->addToBody(new GenericElement('h1',array(),'Hello World!'));
            Main::display($this->html->toRender());
        }
    }