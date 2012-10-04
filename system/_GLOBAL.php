<?php if(!class_exists('_GLOBAL')):

	/**
     * 
     * Classe _GLOBAL
     * 
	 * Este arquivo contém as configurações globais do sistema
     * 
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * 
	 */
	class _GLOBAL{
	    
        public static $DEBUG = TRUE;
        
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
        public static function ALL_PATHS(){
            return array(
                'BASE'      => self::BASE(),
                'SYS_PATH'  => self::SYS_PATH(),
                'ENV_PATH'  => self::ENV_PATH(),
                'CTRL_PATH' => self::CTRL_PATH(),
                'VIEW_PATH' => self::VIEW_PATH()
            );
        }
	}	

endif;

// Fim do arquivo _GLOBAL.php