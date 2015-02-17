<?php

namespace core\control;

use application\src\App;
use core\control\error\ExceptionHandler;
use core\control\error\RuntimeErrorScheduler;
use core\datatypes\JsonObject;
use core\tools\designpattern\ISingleton;
use core\tools\test\TestNotFoundException;
use core\tools\test\UnitTest;

/**
 * System class deals with core control operations.
 * @package core\control
 * @abstract
 */
class System implements ISingleton{
	/**
	 * Self Instance
	 * @var System
	 */
	static private $instance;

	/**
	 * Application configuration data
	 * @var string
	 */
	static protected $config = NULL;

	/**
	 * Application configuration source file path
	 * @var string
	 */
	static protected $configPath = 'application/environment/config.json';
	
	/**
	 * @ignore
	 */
	static private $dump = array();
	/**
	 * Toggles unit test execution before application starts on/off
	 * @var boolean
	 */
	static public $test = true;
	
	/**
	 * Gets a self instance
	 * @return System
	 */
	static public function getInstance(){
		if(is_null(self::$instance))
			self::$instance = new System();
		return self::$instance;
	}
	
	/**
	 * Get the configuration data
	 * @return JsonObject
	 */
	public static function getConfig(){
		if(is_null(self::$config)){
			$tmp = json_decode(file_get_contents(self::$configPath));
			self::$config = new JsonObject($tmp);
		}
		return self::$config;
	}

	/**
	 * Sets the new path to the config file
	 * @param string $path New path to config file
	 */
	public static function changeConfigPath($path){
		self::$configPath = $path;
		self::$config = NULL;
	}
	
	/**
	 * Renders content into the screen
	 * @param mixed $value
	 * @return void
	 */
	public static function display($value){
		file_put_contents("php://output", $value);
	}
	
	/**
	 * Pushs the element to the dump List
	 * @param mixed $value
	 * @return void
	 */
	public static function setToDump($value){
		self::$dump[] = $value;
	}
	
	/**
	 * Displays the content set to dump
	 * @return void
	 */
	public static function dump(){
		foreach(self::$dump as $dump) var_dump($dump);
	}
	
	/**
	 * Executes the UnitTest defined routines
	 * @return void
	 * @throws TestNotFoundException
	 */
	public static function runTests(){
		foreach(self::getConfig()->tests as $test){
			$test = str_replace('.', '\\', $test);
				$unit = new $test();
				if(!($unit instanceof UnitTest)){
					throw new TestNotFoundException(get_class($unit).' is not an instance of core\tools\test\UnitTest.');
				}
				foreach(get_class_methods($test) as $method){
					if($method=='call') continue;
					$unit->call($method);
				}

		}
	}

	public static function getEnvironmentData(){
		return $_SERVER;
	}

	/**
	 * Init the application
	 * @return void
	 */
	public static function start(){

		$handler = new ExceptionHandler();
		$handler->setErrorTemplate('error_template.html');
		$scheduler = RuntimeErrorScheduler::getInstance();
		$scheduler->setExceptionHandler($handler);
		$scheduler->beginSchedule();
		$config = self::getConfig();
		try{
			session_start();
			header("Content-Type: text/html; charset={$config->encoding}");
			if($config->runTest) self::runTests();
			App::main();
		}catch(\ErrorException $e){
			ob_end_clean(); // cleans the output buffer
			ob_start();		// inits again the output buffer
			$scheduler->scheduleException($e);
			ExceptionHandler::writeLog(get_class($e), $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), $config->timezone);
		}
	}
	
	/**
	 * @ignore
	 */
	public function __clone(){}
}