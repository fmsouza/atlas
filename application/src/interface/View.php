<?php

    class View extends _HTML{
        
        function __construct(){
            parent::__construct();

            $this->load('layout');
            
            $css[0] = 'nome.css';
            $css[1] = 'nome2.css';
            $css[2] = 'nome3.css';
            
            $this->css($css);
            
            $js[0] = 'nome.js';
            $js[1] = 'nome2.js';
            $js[2] = 'nome3.js';
            
            $this->script($js);
            
            $valores['foo'] = 'alo mundo!!!';
            $valores['bar'] = 'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.';
            
            $this->args->val = 'hey you!';
            $this->args->lav = 'just see!';
            
            $this->arg($valores);
            $this->arg($this->args);
        }
        
    }
