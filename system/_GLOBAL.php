<?php

	/**
     * 
     * Classe _GLOBAL
     * 
	 * Este arquivo contém as configurações globais do sistema
     * 
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * 
     * @static @param bool $DEBUG
     * 
     * @static @method string BASE
     * @static @method string SYS_PATH
     * @static @method string ENV_PATH
     * @static @method string CTRL_PATH
     * @static @method string VIEW_PATH
     * @static @method string[] ALL_PATHS 
     * 
	 */
	class _GLOBAL{
	    
        public static $DEBUG = TRUE;
        
        /**
         * Retorna o endereço base da aplicação
         */
		public static function BASE(){
			return getcwd();
		}
        
        /**
         * Caminho do diretório system
         */
		public static function SYS_PATH(){
			return self::BASE()."/system";
		}
        
        /**
         * Caminho das classes do ambiente
         */
		public static function ENV_PATH(){
			return self::SYS_PATH()."/environment";
		}
        
        /**
         * Caminho das classes de controle
         */
		public static function CTRL_PATH(){
			return self::SYS_PATH()."/control";
		}
        
        /**
         * Caminho das classes de views
         */
		public static function VIEW_PATH(){
			return self::SYS_PATH()."/view";
		}
        
        /**
         * Array com os caminhos de todas as classes globais
         */
        public static function ALL_PATHS(){
            return array(
                'BASE'      		=> self::BASE(),
                'SYS_PATH'  		=> self::SYS_PATH(),
                'ENV_PATH'  		=> self::ENV_PATH(),
                'CTRL_PATH' 		=> self::CTRL_PATH(),
                'VIEW_PATH' 		=> self::VIEW_PATH(),
                '_HTML'				=> self::VIEW_PATH()."/_HTML",
                'VIEW_TOOLS'		=> self::VIEW_PATH()."/_TOOLS"
            );
        }
	}