<?php
	/** 
     * Este arquivo contém as variáveis de caminho para aplications
     * 
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * 
     * @package system
     * @subpackage environment
     * 
	 */
	class _USER{
	    
        /**
         * @var string Endereço de e-mail do administrador do sistema: a quem serão enviados os e-mails em caso de erro.
         */
        public static $EMAIL_ADMIN = 'admin@cisi.coppe.ufrj.br';
        
        /**
         * Retorna o caminho da base global
         * @return string
         */
		public static function BASE(){
			return _GLOBAL::BASE();
		}

        /**
         * Retorna o endereço do diretório da aplicação
         * @return string
         */
		public static function HOME(){
			return self::BASE()."/application";
		}

        /**
         * Retorna o endereço das classes de configurações do ambiente do usuário
         * @return string
         */
		public static function ENV(){
			return self::BASE()."/application/environment";
		}

        /**
         * Retorna o endereço do diretório dos arquivos de views do sistema
         * @return string
         */
		public static function VIEW(){
			return self::BASE()."/application/view";
		}

        /**
         * Retorna o endereço do diretório de classes principais do sistema
         * @return string
         */
		public static function SRC(){
			return self::BASE()."/application/src";
		}

        /**
         * Array com os caminhos de todas as classes da aplicação
         * @return array
         */
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