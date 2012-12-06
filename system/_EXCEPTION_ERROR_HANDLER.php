<?php

    /**
     * Função manipuladora de exceções.
     * 
     * @author Frederico Souza (fmsouza@cisi.coppe.ufrj.br)
     * @author Julio Cesar (julio@cisi.coppe.ufrj.br)
     * 
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param $errline
     * 
     * @throws ErrorException
     */
	function exception_error_handler($errno, $errstr, $errfile, $errline ) {
	    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
	}

	set_error_handler("exception_error_handler"); //set error handle
	
	register_shutdown_function('CatchFatalError');
	
	function CatchFatalError() {
		$E = error_get_last();
		$error =  base64_encode(serialize((object)$E));
		if ($E['type'] != 0){ $_SESSION['_ERROR']=$error; header("location: #");}
	}
	
	function FATAL_ERROR_CALL(){
		$error = unserialize(base64_decode($_SESSION["_ERROR"]));
		unset($_SESSION["_ERROR"]);
		throw new ErrorException($error->message,$error->type,0,"{$error->file}", $error->line);
	}