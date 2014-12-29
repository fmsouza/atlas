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

	include('system/autoload.php');

	use application\src\Application;
	use system\control\error\Error;

	session_start();
	Error::listen();
	define('CONFIG','application/environment/config.json');
	define('DEBUG',true);
	define('TEST',TRUE);
	try{
		ob_start();
		$errorFlag=0;
		header("Content-Type: text/html; charset={Application::getConfig()->encoding}");
		if(isset($_SESSION["Error"])){
			$errorFlag=1;
			Error::fatalErrorCall();
		}
		Application::getInstance()->main();
	}catch(exception $e){
		ob_end_clean();
		ob_start();
		Error::display($e,$errorFlag);
	}