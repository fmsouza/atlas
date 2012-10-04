<?php

/**
 * Controlador padrão
 */

class Main{
    
    public function index(){
        echo 'Hello World!';
    }
    
    public function pagina(){
        $view = new View();
        
        $form = new Form();
        
        $campos = $this->form_fields();

        $args['content'] = $form->create('teste',$campos,'main/form');
        $view->render($args);
    }

    private function form_fields(){
        return array(
            'name' => array(
                'title' => 'Nome',
                'type'  => 'text'
            ),
            'telefone' => array(
                'title' => 'Telefone',
                'type'  => 'text'
            ),
            'email' => array(
                'title' => 'E-mail',
                'type'  => 'text'
            ),
            'senha' => array(
                'title' => 'Senha',
                'type'  => 'pass'
            ),
            'mensagem' => array(
                'title' => 'Mensagem',
                'type'  => 'textarea'
            ),
            'botao' => array(
                'title' => 'Enviar',
                'type'  => 'submit'
            ));
    }
}
