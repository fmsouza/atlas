<?php
	/**
	 * Este arquivo contém as variáveis de caminho para aplications
	 */

	class _USER{
		public static function BASE(){
			return _GLOBAL::BASE();
		}

		public static function HOME(){
			return self::BASE()."/aplication";
		}

		public static function ENV(){
			return self::BASE()."/aplication/env";
		}

		public static function VIEW(){
			return self::BASE()."/aplication/view";
		}

		public static function SRC(){
			return self::BASE()."/aplication/src";
		}
	}	
