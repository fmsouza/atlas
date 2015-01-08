<?php
namespace application\tests;

use core\control\tools\UnitTest;

/**
 * Contains a sample test routine
 *
 * The tests are executed ONLY if global TEST == true if defined in the index.php file.
 * 
 * @package application\tests
 */
class MainTest extends UnitTest{
    
    /**
     * Each method contained inside a class that extends from UnitTest represents
     * a testing routine to be run and stop the application if the conditions are
     * not respected.
     * @return bool
     */
    public function testIfTrue(){
        return $this->assertTrue(true);
    }
    
}