<?php
namespace core\tools\designpattern;

/**
 * Implements Singleton Design Pattern
 * @package core\control\tools\designpattern
 */
interface Singleton{
	
	/**
	 * @ignore
	 */
    static public function getInstance();
	
	/**
	 * @ignore
	 */
    public function __clone();
}
