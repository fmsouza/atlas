<?php

class _CSS {

	// association with Style class
	public $styles;
    
	public function generate() {
		$return = "";
		foreach($this->styles as $style)
			$return .= $style->compose();
        return $return;
	}


	public function addStyle(Style $style) {
        $this->styles[] = $style;
	}


	public function getStyleByName($name) {
        // TODO
	}


}


?>