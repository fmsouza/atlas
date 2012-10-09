<?php

class Form extends ElementsComposition {

	public $name;
	public $method;
	public $action;

	public function __construct($method, $action, $name=''){
		parent::__construct('html');
		$this->method = $method;
		$this->action = $action;
		$this->name = $name;
	}
	
	public function render() {
		$return = ($this->name=='')? "<form action='{$this->action}' method='{$this->method}'>":"<form name='{$this->name}' action='{$this->action}' method='{$this->method}'>\n\t";
		foreach($this->elements as $element) $return .= $element->render().'\n\t';
		$return .= "</form>";
		
		return $return;
	}


}


?>
