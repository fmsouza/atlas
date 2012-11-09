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
    }