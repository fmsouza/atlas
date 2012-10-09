<?php

    class Teste{
        
        public function index(){
            $html = new _HTML();
            $form = new Form('post','?r=teste/outro');
            $form->add(new InputText('nome','Deu bom!'));
            $form->add(new BtnSubmit('Fazer dar bom'));
            $html->add($form);
            echo $html->render();
        }
        
        public function outro(){
            $html = new _HTML();
            $form = new Form('post','#');
            $form->add(new TextArea('nome',$_POST['nome']));
            $html->add($form);
            $form->action = 'viiiish';
            echo $html->render();
        }
    }
