<?php

    class Teste{
        
        public function index(){
			
            $html = new _HTML();
			$form = Form::layoutInflater("testforminflater.html");
            // $form = new Form('post','?r=teste/outro');
            // $form->add(new InputText('nome','Deu bom!'));
            // $form->add(new BtnSubmit('Fazer dar bom'));
            $html->add($form);
            echo $html->toRender();
			
        }
        
        public function outro(){
            $html = new _HTML();
			$form = Form::layoutInflater("outro.html");
            // $form = new Form('post','#');
            // $form->add(new TextArea('nome',$_POST['nome']));
            $html->addToBody($form);
            // $form->action = 'viiiish';
            echo $html->toRender();
        }
		
		public function genCSS(){
			$css = new _CSS();
			$st = new Style("input");
			$st->createAttribute("color", "#FF0000");
			$css->addStyle($st);
			$st->setEvent(new Events("hover"));
			echo "{$css->generate()}";
		}
		
		public function testeGen(){
			$texto = new GenericElement("p",array(),TRUE,"Deu bom ein!");
			echo $texto->toRender();
		}
    }
