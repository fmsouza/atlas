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
     * @method pre
     * @method execute
     * @method post
     * 
     */
	class Main extends _APP{
	    
        /**
         * Pré-carregamento do sistema. Prepara o ambiente.
         * @return void
         */
        public function pre(){
            //_USER::$EMAIL_ADMIN="exemplo@email.com";
            //_GLOBAL::$DEBUG=FALSE;
			Database::$selectDriver = "Mysql";
			Database::$connInf = array("host"=>"localhost","user"=>"root","password"=>"112233");
			Main::$db = Database::getInstance();
		}

        /**
         * Define a lógica de execução da aplicação
         * @return void
         */
        public function execute(){
			Main::$db->selectDatabase("T");
			try{
				$tmp = Main::$db->query("SELECT * FROM teste WHERE hora LIKE '%6' ");
				while($a = $tmp->getRow()) Main::display("Data: ".$a->data."<br />Hora: ".$a->hora."<br />");
			}catch(DatabaseError $e){
				echo "Ocorreu um erro!",$e->getMessage(),$e->getCode();
			}
			echo "<br />","Linhas afetadas: ",Main::$db->affectedRows(),"<hr/>";
		}

        /**
         * Instruções para encerramento do ciclo de vida do sistema.
         * @return void
         */
		public function post(){

		}
    }
