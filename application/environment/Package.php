<?php
    /**
     * 
     * Classe Package
     * 
     * Classe que armazena os endereços dos pacotes de classes que poderão ser carregados
     * 
     * @static @method ALL_PACKS
     * @return String[]
     * 
     */
    
    class Package{
        
        public static function ALL_PACKS(){
            return array(
                'style'          => '/interface/style'
            );
        }
    }

// Fim do arquivo Package.php