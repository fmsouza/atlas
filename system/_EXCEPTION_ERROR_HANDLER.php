<?php
	function exception_error_handler($errno, $errstr, $errfile, $errline ) {
	    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
	}
	
	//set error handle
	set_error_handler("exception_error_handler");
