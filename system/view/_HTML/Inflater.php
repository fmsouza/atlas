<?php

	interface Inflater{
		/**
		 * Este método infla um arquivo de html criando objetos em seus respectivos tipos.
		 * @param string $layout
		 * @param integer $index
		 */
		static public function layoutInflater($layout,$index=0);
	}
