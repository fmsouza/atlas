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
     * @method pagina
     * @method array form_fields
     * 
     */
    class Main{
        
        /**
         * Método Index
         * 
         * Método principal da classe Main definido em Config.
         * Apenas escreve 'Hello World' na tela quando é carregado.
         * Apenas um teste.
         */
        public function index(){
            echo 'Hello World!';
        }
        
        /**
         * Método Pagina
         * 
         * Método que pode ser acessado por http://<hostname>/index.php?r=main/pagina
         * Instancia a classe View e a classe Form e gera uma página com o que está configurado
         * na classe view e depois gera e carrega um formulário na página antes de renderizar.
         */
        public function pagina(){
            $view = new View();
            
            $form = new Form();
            
            $campos = $this->form_fields();
    
            $args['content'] = $form->create('teste',$campos,'main/form');
            $view->render($args);
        }
        
        /**
         * Método Form_fields
         * 
         * Por ser private, só pode ser acessado DENTRO DA PRÓPRIA CLASSE.
         * Retorna um array com os parâmetros de todos os campos que o
         * formulário deve ter.
         */
        private function form_fields(){
            return array(
                'name' => array(
                    'title' => 'Nome',
                    'type'  => 'text'
                ),
                'telefone' => array(
                    'title' => 'Telefone',
                    'type'  => 'text'
                ),
                'email' => array(
                    'title' => 'E-mail',
                    'type'  => 'text'
                ),
                'senha' => array(
                    'title' => 'Senha',
                    'type'  => 'pass'
                ),
                'mensagem' => array(
                    'title' => 'Mensagem',
                    'type'  => 'textarea'
                ),
                'botao' => array(
                    'title' => 'Enviar',
                    'type'  => 'submit'
                ));
        }
    }

// Fim do arquivo Main.php