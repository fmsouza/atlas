<?php
	/**
	 * Interface que permite o padrão inflater nos objetos
	 * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
	 * @author Julio Cesar da Silva Pereira (julio@cisi.coppe.ufrj.br)
	 */
	/**
	 * Interface que permite o padrão inflater nos objetos
	 * @package system
	 * @subpackage view_HTML
	 */
	interface Inflater{
		/**
		 * Este método infla um arquivo de html criando objetos em seus respectivos tipos.
		 * @param string $layout
		 * @param integer $index
		 * @return void
		 */
		static public function layoutInflater($layout,$index=0);
	}
