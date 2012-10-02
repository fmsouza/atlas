<?php

/**
 * Classe de sistema que carrega pacotes de aplicação
 */

class _PACKAGE{
    
    public function load_package($pkg){
        include_all_php(_USER::HOME()."src/".$pkg);
    }
}
