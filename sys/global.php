<?php
	/**
	 * Este arquivo contém as configurações globais do sistema
	 */
	

	class _GLOBAL{
		public static function BASE(){
			return getcwd();
		}
		public static function SYS_PATH(){
			return self::BASE()."/sys";
		}
		public static function ENV_PATH(){
			return self::SYS_PATH()."/env";
		}
		public static function CTRL_PATH(){
			return self::SYS_PATH()."/ctrl";
		}
		public static function VIEW_PATH(){
			return self::SYS_PATH()."/ctrl";
		}
	}	
