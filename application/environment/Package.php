<?php if(!class_exists('Package')):
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

endif;

// Fim do arquivo Package.php