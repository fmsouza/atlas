<?php

class _CSS {

	private $styles;
    
	public function generate() {
		$return = "";
		foreach($this->getStyles() as $style)
			$return .= $style->compose()."\n";
        return $return;
	}


	public function addStyle(Style $style) {
        $this->styles[] = $style;
	}

    public function getStyles(){
        return $this->styles;
    }
}


?>
