<?php
	/**
	 * Este arquivo contém as configurações globais do sistema
	 */

	class _USER{
		public static function ROOT(){
			return getcwd();
		}

		public static function HOME(){
			return _GLOBAL::ROOT()."/aplication";
		}

		public static function ENV(){
			return _GLOBAL::ROOT()."/aplication/env";
		}

		public static function VIEW(){
			return _GLOBAL::ROOT()."/aplication/view";
		}

		public static function SRC(){
			return _GLOBAL::ROOT()."/aplication/src";
		}
	}	
