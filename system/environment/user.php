<?php
	/**
	 * Este arquivo contém as variáveis de caminho para aplications
	 */

	class _USER{
		public static function BASE(){
			return _GLOBAL::BASE();
		}

		public static function HOME(){
			return self::BASE()."/application";
		}

		public static function ENV(){
			return self::BASE()."/application/environment";
		}

		public static function VIEW(){
			return self::BASE()."/application/view";
		}

		public static function SRC(){
			return self::BASE()."/application/src";
		}
	}	
