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