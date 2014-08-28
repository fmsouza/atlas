<?php
	/**
	 * Autoload routine
	 * 
	 * @author Frederico Souza (fredericoamsouza@gmail.com)
	 * @author Julio Cesar (thisjulio@gmail.com)
	 * @package system
	 * 
	 * @copyright Copyright 2013 Frederico Souza
	 * Licensed under the Apache License, Version 2.0 (the “License”);
	 * you may not use this file except in compliance with the License.
	 * You may obtain a copy of the License at
	 * http://www.apache.org/licenses/LICENSE-2.0
	 * Unless required by applicable law or agreed to in writing, software
	 * distributed under the License is distributed on an “AS IS” BASIS,
	 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	 * See the License for the specific language governing permissions and
	 * limitations under the License.
	 */
	/**
	 * Runs all selected paths trying to find the required class. The class must have the same
	 * name of the file.
	 * 
	 * @param string $classname class name
	 * @return bool
	 */
	function autoload($classname){
	    // Runs the global paths
	    foreach (Globals::paths() as $value){
            if(file_exists("{$value}/{$classname}.php")){
                require_once("{$value}/{$classname}.php");
                return true;
            }
	    }
	    // Runs the application paths
	    foreach (User::paths() as $value){
            if(file_exists("{$value}/{$classname}.php")){
                require_once("{$value}/{$classname}.php");
                return true;
            }
	    }
	    
	    // Runs the paths defined as packages
	    foreach (Package::paths() as $value){
            if(file_exists(User::source()."/{$value}/{$classname}.php")){
                require_once(User::source()."/{$value}/{$classname}.php");
                return true;
            }
	    }
	    return false;
	}
	spl_autoload_register('autoload'); // register __autoload