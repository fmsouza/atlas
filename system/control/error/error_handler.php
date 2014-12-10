<?php
    /**
     * Systems error control functions
     * 
     * @author Frederico Souza (fredericoamsouza@gmail.com)
     * @author Julio Cesar (thisjulio@gmail.com)
     * @package system
     * @subpackage control/error
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
     * Handles exceptions
     * 
     * @param int $errno Error number
     * @param string $errstr Error message
     * @param string $errfile Error file
     * @param $errline Error line
     * @throws ErrorException
     */
    function error_handler($errno, $errstr, $errfile, $errline ) {
	throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
    
    /**
     * Catches fatal errors
     * @return void
     */
    function CatchFatalError() {
		$error = error_get_last();
		if($error['type'] != 0){
			$_SESSION['Error'] = base64_encode(serialize((object)$error));
			header("location: ".App::$config->getKey("baseURL"));
		}
    }
    
    /**
     * Throws exceptions when fatal error occurs
     * @return void
     * @throws ErrorException
     */
    function FATAL_ERROR_CALL(){
		$error = unserialize(base64_decode($_SESSION["Error"]));
		unset($_SESSION["Error"]);
		throw new ErrorException($error->message,$error->type,0,"{$error->file}", $error->line);
    }
    set_error_handler("error_handler");
    register_shutdown_function('CatchFatalError');