<?php
/**
 * Autoload the classes following PSR-0 autoloading rules.
 * @param string $className class name
 * @return bool
 */
spl_autoload_register(function($className){
	$className = str_replace('\\', '/', $className);
	if(file_exists("{$className}.php")){
		require_once("{$className}.php");
		return true;
	}elseif(file_exists("../{$className}.php")){
		require_once("../{$className}.php");
		return true;
	}
	return false;
});