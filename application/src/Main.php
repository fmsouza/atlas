<?php

    /**
     * 
     * Classe Main
     * 
     * Classe principal controladora da aplicação. Nessa classe que serão escritos todos os métodos principais que
     * serão executados ao carregar uma página dentro do sistema.
     * 
     * SEMPRE DEVE HAVER um método execute(). Este sempre será chamado.
     * 
     * O controlador é a classe responsável pela lógica de toda a aplicação. É o intermédio entre os modelos
     * e as Views. É nos métodos dos controladores que devemos carregar as classes necessárias para a página.
     * Um dos pilares do MVC é a ideia de manter o HTML e o PHP bem separados, ou seja, não misturar o
     * conteúdo estático e o dinâmico. Portanto, todo o conteúdo lógico deve ser escrito nas classes controladoras
     * e substituído nas páginas HTML através da classe _HTML e suas aplicações.
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * @method index
     * 
     */
	class Main extends _APP{
        public function pre(){
            //_USER::$EMAIL_ADMIN="exemplo@email.com";
            //_GLOBAL::$DEBUG=FALSE;
        }

        public function execute(){
			
		}

		public function post(){
		}
    }
