<?php
	/**
	 * 
	 * Marvie MVC Framework
	 * 
	 * Through this file all the basic MVC Framework operations are done. This file is known as
	 * Main Controller. It works as a enter point to the system and manages all the requests.
	 * Thus all the paths must pass here.
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
	 * 
	 * @ignore
	 */
	session_start(); // Starts PHP session
	require_once("system/Globals.php"); // Loads all the paths
	include(Globals::errorPath()."/error_handler.php"); // Loads the exception error handler
	include(Globals::systemPath()."/autoload.php"); // Loads the autoload configuration
	header("Content-Type: text/html; charset=".Config::encoding);
    Globals::$debug = TRUE; // toggles error display mode
	/* -------------------------------------------------------------------------------------------- */
	/*                                                                                              */
	/* This is the Main class life cycle, which is written under Singleton Pattern. It grants that  */
	/* the application will only be initialized once throughout the execution.                      */
	/*                                                                                              */
	/* -------------------------------------------------------------------------------------------- */
	try{
		ob_start();
		$errorType=0;
		if(isset($_SESSION["Error"])){$errorType=1;FATAL_ERROR_CALL();}
		$APPLICATION=Main::getInstance();	// Instantiates Main
		$APPLICATION->onStart();		// Prepare Main's environment
		$APPLICATION->onExecute();		// Runs the application 
		$APPLICATION->onFinish();		// Prepares the application to stop
	}catch(exception $e){
		ob_end_clean();
		ob_start();
		Error::display($e,$errorType);		// Render the errors
	}