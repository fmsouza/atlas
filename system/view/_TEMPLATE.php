<?php

    /**
     * 
     * Classe _TEMPLATE
     * 
     * Este arquivo contém ocontrolador de template HTML
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * 
     * @param string $layout: recebe os arquivo carregado
     * @param string $deli: delimitador inicial de template
     * @param string $delf: delimitador final de template
     * 
     * @method __construct
     * @method load
     * @method arg
     * @method css
     * @method script
     * @method render 
     * 
     */
    class _TEMPLATE{
        
        protected $layout;
        private $deli = '::';
        private $delf = '::';
        
        /**
         * Troca os delimitadores caso sejam passados novos
         */
        function __construct($ini='',$fin=''){
            if(!empty($ini)) $this->deli = $ini;
            if(!empty($fin)) $this->delf = $fin;
        }
        
        /**
         * Carrega um arquivo de template HTML
         */
        public function load($file){
            if(empty($this->layout))
                $this->layout = file_get_contents(_USER::VIEW()."/{$file}.html");
            else
                $this->layout .= file_get_contents(_USER::VIEW()."/{$file}.html");
        }
        
        /**
         * Substitui um valor na página
         */
        public function arg($pair){
            foreach($pair as $key => $value)
                $this->layout = str_replace($this->deli.$key.$this->delf, $value, $this->layout);
        }
        
        /**
         * Carrega folhas de estilo
         */
        public function css($args){
            $str = "";
            foreach($args as $file) $str .= "<link rel='stylesheet' type='text/css' href='{$file}' />\n";
            
            $this->layout = str_replace($this->deli.'css'.$this->delf, $str, $this->layout);
        }
        
        /**
         * Carrega scripts Javascript
         */
        public function script($args){
            $str = "";
            foreach($args as $file) $str .= "<script type='text/javascript' src='{$file}'></script>\n";
            
            $this->layout = str_replace($this->deli.'script'.$this->delf, $str, $this->layout);
        }
        
        /**
         * Renderiza a página. Pode ou não carregar mais variáveis na página
         */
        public function render($args=array()){
            if(!empty($args)) $this->arg($args);
            echo $this->layout;
        }
        
    }

// Fim do arquivo _HTML.php