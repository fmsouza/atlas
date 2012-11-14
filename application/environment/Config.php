<?php
    /**
     * 
     * Classe Config
     * 
     * Classe que armazena as configurações do ambiente
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * 
     * @static @param string $main_method
     * 
     * @method @static base_url
     * 
     */
    
    class Config{
        public static function base_url(){
            return "http://{$_SERVER['SERVER_NAME']}/cisimvc/";
        }
        
        public static function db_config(){ // Configurações de acesso ao banco de dados
            return array(
                'host'       => '146.164.63.23',
                'user'       => 'usuario_sbdi',
                'password'   => 'cisi2012',
                'db_name'    => 'coppe11',
                'tbl_prefix' => 'sbdi_',
                'charset'    => 'utf8',
                'driver'     => 'mysqli',
            );
        }
    }