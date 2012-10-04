<?php

    class _HTML{
        
        protected $layout;
        public $deli = '::';
        public $delf = '::';
        
        function __construct($ini='',$fin=''){
            if(!empty($ini)) $this->deli = $ini;
            if(!empty($fin)) $this->delf = $fin;
        }
        
        public function load($file){
            if(empty($this->layout))
                $this->layout = file_get_contents(_USER::VIEW()."/{$file}.html");
            else
                $this->layout .= file_get_contents(_USER::VIEW()."/{$file}.html");
        }
        
        public function arg($pair){
            foreach($pair as $key => $value)
                $this->layout = str_replace($this->deli.$key.$this->delf, $value, $this->layout);
        }
        
        public function css($args){
            $str = "";
            foreach($args as $file) $str .= "<link rel='stylesheet' type='text/css' href='{$file}' />\n";
            
            $this->layout = str_replace($this->deli.'css'.$this->delf, $str, $this->layout);
        }
        
        public function script($args){
            $str = "";
            foreach($args as $file) $str .= "<script type='text/javascript' src='{$file}'></script>\n";
            
            $this->layout = str_replace($this->deli.'script'.$this->delf, $str, $this->layout);
        }
        
        public function render($args=array()){
            if(!empty($args)) $this->arg($args);
            echo $this->layout;
        }
        
    }
