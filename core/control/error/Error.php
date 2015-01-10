<?php
namespace core\control\error;

use core\view\html\GenericElement;
use core\view\html\TextElement;
use core\control\System;
use core\control\datatypes\JsonObject;
use core\control\datatypes\ArrayList;

/**
 * Error class handles the display of errors and exceptions.
 * @package core\control\error
 */
class Error{

	/**
	 * Path to the error log file
	 * @var string
	 */
	private static $logPath = 'errors.log';

	/**
	 * HTML error screen selector constant
	 * @var int
	 */
	const HTML_ERROR = 1;

	/**
	 * JSON error screen selector constant
	 * @var int
	 */
	const JSON_ERROR = 0;

	/**
	 * Error mode value
	 * @var int
	 */
	private static $errorMode;

	/**
	 * Returns the stack trace as array
	 * @param exception $e
	 * @return array
	 */		
	public static function getStack(\exception $e){
		$error = explode('#', $e->getTraceAsString());
		array_shift($error);
		return $error;
	}
	
	/**
	 * Renders the error data
	 * @param exception $e Thrown exception object
	 * @param int $fatal Greater than zero if it was a fatal error (default: 0)
	 * @return string
	 */
	public static function display(\exception $e, $fatal=0){
		self::writeLog($e->getCode(),get_class($e),$e->getMessage(),$e->getFile(),$e->getLine());
		$content = "";
		switch (self::$errorMode) {
			case Error::HTML_ERROR:
				$content = self::displayAsHtml($e, $fatal);
				break;
			case Error::JSON_ERROR:
				$content = self::displayAsJson($e, $fatal);
				break;
		}
		System::display($content);
	}
	
	/**
	 * Returns the error screen data as HTML
	 * @param exception $e Thrown exception object
	 * @param int $fatal Greater than zero if it was a fatal error (default: 0)
	 * @return string
	 */
	private static function displayAsHtml(\exception $e, $fatal){
		$layout = GenericElement::layoutInflater('error_template.html','core/view');
		$config = System::getConfig();
		if(!$config->debugMode){
			$end_msg = 'An error ocurred. Please, contact the administrator: '.$config->emailAdmin;
			$layout->removeElementById('ERROR_MESSAGE');
			$layout->removeElementById('stackTrace'); 
		}
		else{	
			$end_msg = ($fatal)? 'A fatal error ocurred.':
				'An error ocurred in the system.';
			$layout->getElementById('ERROR_MESSAGE')->add(GenericElement::stringInflater("<p>".get_class($e)." ".$e->getCode().": ".$e->getMessage()."</p>"));
			$layout->getElementById('ERROR_MESSAGE')->add(GenericElement::stringInflater("<p>Error ocurred in <strong>line ".$e->getLine()."</strong> of the file <strong>".$e->getFile()."</strong></p>"));
		
			foreach(self::getStack($e) as $stackline)
				$layout->getElementById('stackTrace')->add(
					GenericElement::stringInflater("<p>{$stackline}</p>")
				);
		}
		$layout->getElementById('ERROR_TYPE')->getElement(0)->add(new TextElement($end_msg));
		unset($_SESSION[get_class()]);
		return $layout;
	}
	
	/**
	 * Returns the error screen data as JSON
	 * @param exception $e Thrown exception object
	 * @param int $fatal Greater than zero if it was a fatal error (default: 0)
	 * @return string
	 */
	private static function displayAsJson(\exception $e, $fatal){
		$json = new JsonObject();
		$config = System::getConfig();
		if(!$config->debugMode){
			$json->setKey("message", 'An error ocurred. Please, contact the administrator: '.$config->emailAdmin);
		}
		else{
			$json->setKey('message', $e->getMessage());
			$json->setKey('type', get_class($e));
			$json->setKey('code', $e->getCode());
			$json->setKey('line', $e->getLine());
			$json->setKey('file', $e->getFile());
			$trace = new ArrayList();
			$json->setKey('trace', $trace);

			foreach(self::getStack($e) as $stackline){
				$trace->push($stackline);
			}
		}
		return $json;
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
		$path = self::$logPath;
		try{
			$path = System::getConfig()->logPath;
		}
		catch(\ErrorException $e){}
		finally{
			file_put_contents($path,"[".date('c')."] {$errorType} ERROR {$errorNumber}: {$errorMsg} in {$file}({$line})\n",FILE_APPEND);
		}
		
	}

    /**
     * Handles exceptions
     * 
     * @param int $errno Error number
     * @param string $errstr Error message
     * @param string $errfile Error file
     * @param $errline Error line
     * @throws ErrorException
     */
    public static function errorHandler($errno, $errstr, $errfile, $errline){
		throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
    
    /**
     * Catches fatal errors
     * @return void
     */
    public static function catchFatalError($error){
		if($error['type'] != 0){
			$_SESSION['Error'] = base64_encode(serialize((object)$error));
			header('location: index.php');
		}
    }
    
    /**
     * Throws exceptions when fatal error occurs
     * @return void
     * @throws ErrorException
     */
    public static function fatalErrorCall(){
		$error = unserialize(base64_decode($_SESSION['Error']));
		unset($_SESSION['Error']);
		throw new \ErrorException($error->message,$error->type,0,"{$error->file}", $error->line);
    }
    
    /**
     * Sets the error handlers and the error data exhibition mode.
     * @return void
     */
    public static function showAs($errorMode){
    	self::$errorMode = $errorMode;

		set_error_handler(
			function($errno, $errstr, $errfile, $errline){
				Error::errorHandler($errno, $errstr, $errfile, $errline);
			}
		);
		register_shutdown_function(
			function(){
				Error::catchFatalError(error_get_last());
			}
		);
    }
}