<?php
/**
 * Marvie
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
 */

	ob_start('ob_gzhandler');
	include('system/autoload.php');

	use application\src\App;
	use system\control\Core;
	use system\control\error\Error;

	session_start();
	Error::showAs(Error::HTML_ERROR);
	define('CONFIG','application/environment/config.json');
	define('DEBUG',TRUE);
	define('TEST',TRUE);
	try{
		$errorFlag=0;
		header("Content-Type: text/html; charset={Core::getConfig()->encoding}");
		if(isset($_SESSION['Error'])){
			$errorFlag=1;
			Error::fatalErrorCall();
		}
		if(TEST) Core::runUnitTests();
		App::main();
	}catch(exception $e){
		ob_end_clean();
		ob_start();
		Error::display($e,$errorFlag);
	}