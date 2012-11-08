<?php

    /**
     * 
     * Classe Main
     * 
     * Classe principal controladora da aplicação. Nessa classe que serão escritos todos os métodos principais que
     * serão executados ao carregar uma página dentro do sistema.
     * 
     * SEMPRE DEVE HAVER um método index que será o método de entrada no sistema. Este sempre será chamado caso não
     * haja nenhum endereço de outro método sendo indicado através do $_GET['r'].
     * 
     * O controlador é a classe responsável pela lógica de toda a aplicação. É o intermédio entre os modelos
     * e as Views. É nos métodos dos controladores que devemos carregar as classes necessárias para a página.
     * Um dos pilares do MVC é a ideia de manter o HTML e o PHP bem separados, ou seja, não misturar o
     * conteúdo estático e o dinâmico. Portanto, todo o conteúdo lógico deve ser escrito nas classes controladoras
     * e substituído nas páginas HTML através da classe _HTML e suas aplicações.
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @param $route
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
         * 
         * SUA IMPLEMENTAÇÃO É INDISPENSÁVEL
         * 
         * @return void
         */
        public function index(){
            $this->html->addToHeader(new GenericElement('title',array(),'Pagina de Teste'));
            $this->html->addToBody(new GenericElement('h1',array(),'Hello World!'));
            Main::display($this->html->toRender());
        }
    }