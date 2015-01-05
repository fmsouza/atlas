<?php
/**
 * Contains the UnitTest class.
 *
 * @copyright Copyright 2014 Marvie
 * Licensed under the Apache License, Version 2.0 (the ÒLicenseÓ);
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an ÒAS ISÓ BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
    
    namespace system\control\tools;
    
	/**
	 * Contains the test action methods.
	 * @package system\control\tools
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