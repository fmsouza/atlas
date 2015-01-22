<?php
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
		$classname = "application/src/{$classname}";
		if(file_exists("{$classname}.php")){
			require_once("{$classname}.php");
			return true;
		}
	    return false;
	}
);