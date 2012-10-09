<?php

class _CSS {

	// association with Style class
	public $styles;
    
	public function generate() {
        return $this->styles->compose();
	}


	public function addStyle(Style $style) {
        $this->styles[] = $style;
	}


	public function getStyleByName($name) {
        // TODO
	}


}


?>
