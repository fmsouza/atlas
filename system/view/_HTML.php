<?php

class _HTML extends ElementsComposition {

	public function __construct(){
		parent::__construct('html');
	}
	
	public function render() {
		$html = "<html><body>";
		foreach($this->elements as $element) $html .= $element->render();
		$html .= "</body></html>";
		
		return $html;
	}


}


?>
