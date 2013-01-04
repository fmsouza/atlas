<?php
	/**
     * Classe que armazena as configurações do ambiente <br />
	 * Adicione nesta classe métodos que possam ajudar na parametrização da sua aplicação
	 * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * @package application
	 * @subpackage environment
     */
    
    class Config{
    	/**
		 * Retorna o endereço base da aplicação na web
		 * @return string
		 */
        public static function base_url(){
            return "http://{$_SERVER['SERVER_NAME']}/cisimvc/";
        }
        
		/**
		 * Retorna um array com os dados de configuração de acesso ao banco de dados. 
		 * Complete este array com os respectivos valores de configuração do seu banco de dados seguindo o padrão:
		 * {'chave'=>'valor'}
		 * @return array
		 */
        public static function db_config(){ // Configurações de acesso ao banco de dados
            return array(
                'host'       => '',
                'user'       => '',
                'password'   => '',
                'db_name'    => '',
                'tbl_prefix' => '',
                'charset'    => '',
                'driver'     => '',
            );
        }
    }