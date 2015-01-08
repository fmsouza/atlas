<?php
namespace core\control\tools;

/**
 * Contains the test action methods.
 * @package core\control\tools
 */
abstract class UnitTest{
    
    /**
     * Compare the expressions and continue if they're equal
     * @param mixed $exp1 First expression
     * @param mixed $exp2 Second expression
     * @return bool
     */
    protected function assertEquals($exp1, $exp2){
        return $this->assertTrue($exp1==$exp2);
    }
    
    /**
     * Compare the expression to true.
     * @param bool $expression Expression resulting in boolean state
     * @return bool
     */
    protected function assertTrue($expression){
        return $this->assert($expression==true);
    }
    
    /**
     * Compare the expression to false.
     * @param bool $expression Expression resulting in boolean state
     * @return bool
     */
    protected function assertFalse($expression){
        return $this->assert($expression==false);
    }
    
    /**
     * Compare the expression to null.
     * @param bool $expression Expression resulting in null or other value.
     * @return bool
     */
    protected function assertNull($expression){
        return $this->assert(is_null($expression));
    }
    
    /**
     * Compare the expressions and continue if they're equal
     * @param bool $expression Boolean state to decide wheter the test will pass or not.
     * @ignore
     * @return bool
     */
    private function assert($expression){
        return ($expression)? $this->passed() : $this->failed();
    }
    
    /**
     * Continues to the next level or to the application if there are no more tests.
     * @ignore
     * @return bool
     */
    private function passed(){
        return true;
    }
    
    /**
     * Stop the tests and exit the application once the test fails.
     * @ignore
     * @throws Exception
     */
    private function failed(){
        throw new \Exception("Test failed in ".get_class($this));
    }
}