<?php
    /**
     * Classe que armazena os endereços dos pacotes de classes que poderão ser carregados<br />
     * Utilize esta classe quando for inserir diretórios dentro de <em>application/src</em>
	 * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar da Silva Pereira (julio@cisi.coppe.ufrj.br)
     */
    /**
	 * Classe que armazena os endereços dos pacotes de classes que poderão ser carregados<br />
     * Utilize esta classe quando for inserir diretórios dentro de <em>application/src</em>
     * @package application
	 * @subpackage environment
	 */
    class Package{
        
		/**
		 * Adicione dentro do array de retorno os nomes dos diretórios que estão dentro de application/src
		 * @return array
		 */
        public static function ALL_PACKS(){
            return array();
        }
    }
