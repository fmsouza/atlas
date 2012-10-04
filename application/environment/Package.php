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
                'interface'      => _USER::SRC().'/interface'
            );
        }
    }

// Fim do arquivo Package.php