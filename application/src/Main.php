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
     * @method onStart
     * @method onExecute
     * @method onFinish
     * 
     */
	class Main extends _APP{
	   	public $LAYOUT;
		
        /**
         * Pré-carregamento do sistema. Prepara o ambiente.
         * @return void
         */
        public function onStart(){
           	//_USER::$EMAIL_ADMIN="exemplo@email.com";
            //_GLOBAL::$DEBUG=FALSE;
            header("Content-Type: text/html; charset=utf-8");
            $this->LAYOUT = GenericElementsComposition::layoutInflater("helloCISI.html");
		}

        /**
         * Define a lógica de execução da aplicação
         * @return void
         */
        public function onExecute(){
        	$texto = $this->LAYOUT->getElementById("texto");
			$texto->setValue($texto->getValue()." Se você Estiver vendo esta mensagem a instalação foi um sucesso.");
		}

        /**
         * Instruções para encerramento do ciclo de vida do sistema.
         * @return void
         */
		public function onFinish(){
			Main::display($this->LAYOUT);
			unset($this->LAYOUT);
		}
    }
