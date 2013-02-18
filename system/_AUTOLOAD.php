<?php
	/**
	 * Rotinas e execuções para carregamento automático das classes
	 * 
	 * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * @package system
     * 
     */
    /**
     * É carregada dentro da classe _APP para ser executada como parâmetro da função
     * spl_autoload_register(), que varre todos os endereços passados a procura de um arquivo
     * com o nome igual a {$classname} cujo conteúdo seja uma classe também chamada de {$classname}
     * @param string $classname nome da classe
	 * @return bool
	 */
    function autoload($classname){
        
        // varre todos os diretórios globais definidos na classe _GLOBAL
        foreach (_GLOBAL::ALL_PATHS() as $value){
            if(file_exists("{$value}/{$classname}.php")){
                require_once("{$value}/{$classname}.php");
                return true;
            }
        }
        
        // varre todos os diretórios da aplicação definidos na classe _USER
        foreach (_USER::ALL_PATHS() as $value){
            if(file_exists("{$value}/{$classname}.php")){
                require_once("{$value}/{$classname}.php");
                return true;
            }
        }
        
        // varre todos os diretórios de pacotes definidos na classe Package
        foreach (Package::ALL_PACKS() as $value){
            if(file_exists(_USER::SRC()."/{$value}/{$classname}.php")){
                require_once(_USER::SRC()."/{$value}/{$classname}.php");
                return true;
            }
        }
        
        return false;
    }

    spl_autoload_register('autoload'); //carrega o __autoload com a função autoload()