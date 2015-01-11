<?php
namespace core\tools\designpattern;

/**
 * Contains Responsibility interface
 * @package core\control\tools\designpattern
 */
interface Responsibility{
    
    /**
     * @ignore
     */
    public function processRequest($request);
    
    /**
     * @ignore
     */
    public function setSuccessor(Responsibility $request);
}