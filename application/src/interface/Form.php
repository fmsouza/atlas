<?php

class Form extends ElementsComposition {

	private $name;
	private $method;
	private $action;

	public function __construct($method, $action, $name=''){
		parent::__construct('html');
		$this->method = $method;
		$this->action = $action;
		$this->name = $name;
	}
	
	/**
	 * Este método gera uma string contendo o html referente aos objetos.
	 * @return string 
	 */
	public function toRender() {
		$return = ($this->name=='')? "<form action='{$this->action}' method='{$this->method}'>":"<form name='{$this->name}' action='{$this->action}' method='{$this->method}'>\n\t";
		foreach($this->getElements() as $element) $return .= $element->toRender().'\n\t';
		$return .= "</form>";
		
		return $return;
	}
	
	/**
	 * Este método infla um arquivo de html criando objetos em seus respectivos tipos.
	 * @param string $layout
	 * @param integer $index
	 */
	static public function layoutInflater($layout,$index=0){
		$layout = file_get_contents(_USER::VIEW()."/{$layout}");	
		$xml = new SimpleXMLElement($layout);

		$method = (string)$xml->{$index}['method'];
		$action = (string)$xml->{$index}['action'];
		$name = (string)$xml->{$index}['name'];
		$form = new Form($method,$action,$name);
		foreach($xml->{$index}->input as $input){
			switch((string)$input["type"]){
				case "text":
					$form->add(new InputText((string)$input["name"],(string)$input["value"]));
					break;
				case "submit":
					$form->add(new BtnSubmit((string)$input["value"]));
					break;
			}
		}
		foreach($xml->{$index}->textarea as $textArea)
			$form->add(new TextArea((string)$textArea['name'],(string)$textArea));
		return $form;
	}

}


?>
