<?php if(!class_exists('Form')):

	/**
	 * 
	 * Classe Form
	 * 
	 * Gera um formulário à partir de dados enviados através de um array.
	 * 
	 * @author Frederico Souza
	 *
	 */
	class Form{
		
		/**
		 * 
		 * Gera o formulário
		 * 
		 * @param string $name
		 * @param array $fields
		 * @param string $action
		 */
		function create($name='',$fields=array(),$action=''){
			$form = "<form name='{$name}' id='{$name}' method='post' action='{$action}'><ul>";
			foreach($fields as $foo => $bar){
				if($bar['type']!='button' && $bar['type']!='submit')
					$form .= "<li>{$bar['title']}: ".$this->form_item($foo,$bar['type'],$bar['title'])."</li>";
				else
					$form .= "<li>".$this->form_item($foo,$bar['type'],$bar['title'])."</li>";
			}
	
			$form .= "</ul></form>";
			
			return $form;
		}
		
		/**
		 * 
		 * Gera um campo de formulário
		 * 
		 * @param string $name
		 * @param string $type
		 * @param string $title
		 */
		private function form_item($name,$type='text',$title=''){
			
			switch($type){
				
				case 'text':
					$line = "<input type='text' name={$name} id='{$name}' title='{$title}' />";
					break;
					
				case 'pass':
					$line = "<input type='password' name={$name} id='{$name}' title='{$title}' />";
					break;
					
				case 'textarea':
					$line = "<textarea name={$name} id='{$name}' title='{$title}'></textarea>";
					break;
					
				case 'button':
					$line = "<input type='button' value={$title} id='{$name}' title='{$title}' />";
					break;
					
				case 'submit':
					$line = "<input type='submit' value={$title} id='{$name}' title='{$title}' />";
					break;
				
			}
			
			return $line;
		}
	}

endif;

// Fim do arquivo form.php