<?php
	/**
	 * Classe de sistema responsável pelas funções de exibição de erros do sistema.
	 * 
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @package system
     * @subpackage control
	 */
	class _ERROR{
		
		/**
		 * Retorna um array que contém o Stack Trace da exceção lançada.
		 * @param exception $e
		 * @return array
		 */		
		public static function getStack(exception $e){
			$error = explode("#", $e->getTraceAsString());
			array_shift($error);
			return $error;
		}
		
		/**
		 * Renderiza a view com os dados da exceção.
		 * @param exception $e
		 * @param int $fatal opcional (default: 0)
		 * @return string
		 */
		public static function display(exception $e, $fatal=0){
			$layout = GenericElementsComposition::layoutInflater("../../system/view/_ERROR_VIEW.html");
			
			
			if($fatal)
				$end_msg = "Um erro muito grave ocorreu no sistema, verifique-o.";
			else
				$end_msg = "Um erro ocorreu no sistema, verifique-o ou realize o tratamento do mesmo.";
			$layout->getElement(1)->add(new GenericElement("h1",array(),$end_msg,TRUE));
			
			$layout->getElement(1)->add(new GenericElement("h4",array(),"ERRO ".$e->getCode().": ".$e->getMessage(),TRUE));
			$layout->getElement(1)->add(new GenericElement("h4",array(),"Este erro ocoreu na linha ".$e->getLine()." do arquivo ".$e->getFile(),TRUE));
			
			$table = new GenericElementsComposition("div",array("id"=>"stackTrace"));
			$table->add(new GenericElement("h3",array(),"Stack Trace",TRUE));
			foreach(self::getStack($e) as $stackline)
				$table->add(new GenericElement("p",array(),$stackline,TRUE));
			$layout->getElement(1)->add($table);
			
			$layout->getElement(1)->add(new GenericElement("hr",array(),"",FALSE));
			_APP::display($layout);
			return $layout->toRender();
		}
	}
