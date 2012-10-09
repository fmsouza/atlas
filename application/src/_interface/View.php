<?php
    
    /**
     * 
     * Classe View
     * 
     * Exemplo de aplicação geral da classe _HTML
     * Como, geralmente, uma mesma interface é utilizada para um site inteiro, não há necessidade de
     * escrever todo o seu código de carregamento em todas as classes. Por esse motivo há esse exemplo de
     * classe de carregamento de view, que utiliza as propriedades da classe _HTML para montar a estrutura
     * principal da interface do site. O que for próprio de cada página deve ser carregado na mesma e passado
     * para cá como parâmetro ao criar um objeto dessa classe.
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * 
     */
    class View extends _HTML{
        
        function __construct(){
            parent::__construct(); // Importa o construtor da superclasse (a quem a classe estende, no caso _HTML)

            $this->load('layout'); // carrega um arquivo de layout chamado 'layout.html' que se encontra no diretório application/view
            
            $css[0] = 'nome.css';
            $css[1] = 'nome2.css';
            $css[2] = 'nome3.css';
            
            $this->css($css); // Carrega um array de folhas de estilo CSS
            
            $js[0] = 'nome.js';
            $js[1] = 'nome2.js';
            $js[2] = 'nome3.js';
            
            $this->script($js); // Carrega um array de scripts Javascript
            
            $valores['foo'] = 'alo mundo!!!'; // Substitui ::foo:: na página por 'alo mundo!!!'
            $valores['bar'] = 'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.';
            $this->args->val = 'hey you!'; // Substitui ::val:: na página por 'hey you!'
            $this->args->lav = 'just see!';
            
            $this->arg($valores); // Realiza as substituições
            $this->arg($this->args);
        }
        
    }

// Fim do arquivo View.php