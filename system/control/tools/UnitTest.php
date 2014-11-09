<?php

abstract class UnitTest{
    
    protected function assertEquals($exp1, $exp2){
        return $this->assertTrue($exp1==$exp2);
    }
    
    protected function assertTrue($expression){
        return $this->assert($expression==true);
    }
    
    protected function assertFalse($expression){
        return $this->assert($expression==false);
    }
    
    protected function assertNull($expression){
        return $this->assert($expression==null);
    }
    
    private function assert($expression){
        return ($expression)? $this->passed() : $this->failed();
    }
    
    private function passed(){
        return true;
    }
    
    private function failed(){
        throw new Exception("Test failed in ".get_class($this));
    }
    
}