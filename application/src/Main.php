<?php
    /**
     * Classe principal controladora da aplicação.<br />
     * <em>SEMPRE DEVE HAVER</em> um método onExecute(). Este sempre será chamado.<br /><br />
     * Um dos pilares do MVC é a ideia de manter o HTML e o PHP bem separados, ou seja, não misturar o
     * conteúdo estático e o dinâmico. Portanto, todo o conteúdo lógico deve ser escrito nas classes controladoras
     * e substituído nas páginas HTML através da classe _HTML e suas aplicações.
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
	 */
	/**
	 * Classe principal controladora da aplicação.<br />
     * <em>SEMPRE DEVE HAVER</em> um método onExecute(). Este sempre será chamado.<br /><br />
     * Um dos pilares do MVC é a ideia de manter o HTML e o PHP bem separados, ou seja, não misturar o
     * conteúdo estático e o dinâmico. Portanto, todo o conteúdo lógico deve ser escrito nas classes controladoras
     * e substituído nas páginas HTML através da classe _HTML e suas aplicações.
     * @package application
	 * @subpackage src
	 */
	class Main extends _APP{
		/**
		 * @ignore
		 */
	   	public $LAYOUT;
		
        /**
         * Instruções para o início do ciclo de vida do sistema.
         * @return void
         */
        public function onStart(){
           	//_USER::$EMAIL_ADMIN="exemplo@email.com";
            //_GLOBAL::$DEBUG=FALSE;
            header("Content-Type: text/html; charset=utf-8");
            $this->LAYOUT = GenericElement::layoutInflater("helloCISI.html");
		}

        /**
         * Instruções para a execução do sistema.
         * @return void
         */
        public function onExecute(){
        	$texto = $this->LAYOUT->getElementById("texto")->getElement(0);
			$texto->setText($texto->getText()." Se você Estiver vendo esta mensagem a instalação foi um sucesso.");
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
