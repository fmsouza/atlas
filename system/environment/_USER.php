<?php
	/**
	 * Este arquivo contém as variáveis de caminho para aplications
	 */

	class _USER{
	    
        public static $EMAIL_ADMIN = 'admin@cisi.coppe.ufrj.br';
        
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
        
        public static function ALL_PATHS(){
            return array(
                'BASE'  => self::BASE(),
                'HOME'  => self::HOME(),
                'ENV'   => self::ENV(),
                'VIEW'  => self::VIEW(),
                'SRC'   => self::SRC()
            );
        }
	}	
