<?php
/**
 * Contains a sample test routine.
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 *
 * @copyright Copyright 2014 Frederico Souza
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
	
	namespace application\tests;

	use system\control\tools\UnitTest;
	
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