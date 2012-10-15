<?php

    class Teste{
        
        public function index(){
			
            $html = new _HTML();
			$form = GenericElementsComposition::layoutInflater("testforminflater.html");
			$form->getElement(0)->setAttribute("value","abcd");
			$form->getElement(1)->setAttribute("value","vish!");
            $html->addToBody($form);
            echo $html->toRender();
			
        }
        
        public function outro(){
            $html = new _HTML();
			$form = Form::layoutInflater("outro.html");
            // $form = new Form('post','#');
            // $form->add(new TextArea('nome',$_POST['nome']));
            $html->addToBody($form);
			$a = $form->getElements();
			$a[0]->setValue("oi oi oi");
            echo $html->toRender();
        }

        public function formExample(){
            $html = new _HTML();

            echo $html->toRender();
        }
		
		public function genCSS(){
			$css = new _CSS();
			$st = new Style("div");
			$st->createAttribute("color", "#FF0000");
            $st->createAttribute("border","1px solid #000");
			$css->addStyle($st);
            $ast = new Style("div p");
            $ast->createAttribute("font-size","30px");
            $css->addStyle($ast);
			echo "{$css->generate()}";
		}

        public function testGEC(){
            $t = GenericElementsComposition::layoutInflater("t.html",0);
			$t->getElement(3)->setValue(GenericElementsComposition::layoutInflater("testforminflater.html")->toRender()); 	
			echo $t->toRender();
        }
		
		public function gen(){
            $html = new _HTML();
            $container = new GenericElementsComposition("div",array());
			$link = new GenericElement("link",array("rel"=>"stylesheet","type"=>"text/css","href"=>"?r=teste/genCSS"),"",FALSE);
			$texto = new GenericElement("p",array(),"Estou testando!");
			$texto->setValue("DEITE QUE VOU LHE USAR!");
            $container->add($texto);
            $html->addToHeader($link);
            $html->addToBody($container);
            echo $html->toRender();
		}
    }
