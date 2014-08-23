<?php
	/**
	 * Contains Error class
	 * @author Frederico Souza (fredericoamsouza@gmail.com)
	 * @author Julio Cesar (thisjulio@gmail.com)
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
	 * Error class handles the display of errors and exceptions.
	 * 
	 * @package system
	 * @subpackage control_ERROR
	 */
	class Error{
		/**
		 * Returns the stack trace as array
		 * @param exception $e
		 * @return array
		 */		
		public static function getStack(exception $e){
			$error = explode("#", $e->getTraceAsString());
			array_shift($error);
			return $error;
		}
		
		/**
		 * Renders the error page
		 * @param exception $e Thrown exception object
		 * @param int $fatal Greater than zero if it was a fatal error (default: 0)
		 * @return string
		 */
		public static function display(exception $e, $fatal=0){
			self::writeLog($e->getCode(),get_class($e),$e->getMessage(),$e->getFile(),$e->getLine());
			
			$layout = GenericElement::layoutInflater("../../system/view/error_template.html");
			
			if(!Globals::$debug){
				$end_msg = "An error ocurred. Please, contact the administrator: ".User::$emailAdmin;
				$layout->removeElementById("ERROR_MESSAGE");
				$layout->removeElementById("stackTrace");
			}
			else{	
				$end_msg = ($fatal)? "A fatal error ocurred.":
					"An error ocurred in the system.";
					
				$layout->getElementById("ERROR_MESSAGE")->add(GenericElement::stringInflater(str_replace('&','&#38;',"<p>".get_class($e)." ".$e->getCode().": ".$e->getMessage()."</p>")));
				$layout->getElementById("ERROR_MESSAGE")->add(GenericElement::stringInflater("<p>Error ocurred in <strong>line ".$e->getLine()."</strong> of the file <strong>".$e->getFile()."</strong></p>"));
			
				foreach(self::getStack($e) as $stackline)
					$layout->getElementById("stackTrace")->add(
						GenericElement::stringInflater("<p>{$stackline}</p>")
					);
			}
			$layout->getElementById("ERROR_TYPE")->getElement(0)->add(new TextElement($end_msg));
			unset($_SESSION[get_class()]);
			file_put_contents("php://output", $layout->toRender());
		}

		/**
		 * Displays a default 403 error page
		 * @return void
		 */
		public static function error403(){
			$layout = GenericElement::layoutInflater("../../system/view/error403.html");
			file_put_contents("php://output", $layout->toRender());
			exit;
		}

		/**
		 * Displays a default 404 error page
		 * @return void
		 */
		public static function error404(){
			$layout = GenericElement::layoutInflater("../../system/view/error404.html");
			file_put_contents("php://output", $layout->toRender());
			exit;
		}
	
		/**
		 * Writes a log file with current error data.
		 * 
		 * @param int $errorNumber Error number
		 * @param string $errorType Error type
		 * @param string $errorMsg Error message
		 * @param string $file Error file
		 * @param int $line Error line
		 * @return void
		 */
		private static function writeLog($errorNumber,$errorType,$errorMsg,$file,$line){
			file_put_contents(Config::logPath(),"[".date("c")."] {$errorType} ERROR {$errorNumber}: {$errorMsg} in {$file}({$line})\n",FILE_APPEND);
		}
	}
