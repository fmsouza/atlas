<?php
namespace core\tools\designpattern;

/**
 * Implements the Inflater pattern
 * @package core\control\tools\designpattern
 */
interface Inflater{
		
    /**
     * Inflates an Element tree from a file
     * @param string $layout HTML file path stored in application/view
     */
    static public function layoutInflater($layout);
}