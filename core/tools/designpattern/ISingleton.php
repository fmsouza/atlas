<?php
namespace core\tools\designpattern;

/**
 * Implements ISingleton Design Pattern
 * @package core\control\tools\designpattern
 */
interface ISingleton{
	
	/**
	 * @ignore
	 */
    static public function getInstance();
	
	/**
	 * @ignore
	 */
    public function __clone();
}
