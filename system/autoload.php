<?php
/**
 * Autoload routine to find classes automagically.
 * 
 * @copyright Copyright 2013 Marvie
 * Licensed under the Apache License, Version 2.0 (the “License”);
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an “AS IS” BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * @package system
 */

	/**
	 * Runs all selected paths trying to find the required class. The class must have the same
	 * name of the file.
	 * @param string $classname class name
	 * @return bool
	 */
	spl_autoload_register(
		function($classname){
			$classname = str_replace('\\', '/', $classname);
			if(file_exists("{$classname}.php")){
	            require_once("{$classname}.php");
	            return true;
	        }
		    return false;
		}
	);