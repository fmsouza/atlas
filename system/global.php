<?php
	/**
	 * Este arquivo contém as configurações globais do sistema
	 */
	

	class _GLOBAL{
		public static function BASE(){
			return getcwd();
		}
		public static function SYS_PATH(){
			return self::BASE()."/system";
		}
		public static function ENV_PATH(){
			return self::SYS_PATH()."/environment";
		}
		public static function CTRL_PATH(){
			return self::SYS_PATH()."/control";
		}
		public static function VIEW_PATH(){
			return self::SYS_PATH()."/view";
		}
	}	
