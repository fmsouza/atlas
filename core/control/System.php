<?php
namespace core\control;

use App;
use core\control\error\ExceptionHandler;
use core\control\error\RuntimeErrorScheduler;
use core\tools\designpattern\Singleton;
use core\tools\test\TestNotFoundException;

/**
 * System class deals with core control operations.
 * @package core\control
 * @abstract
 */
class System implements Singleton{
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
	 * @return stdObject
	 */
	public static function getConfig(){
		if(is_null(self::$config)){
			self::$config = json_decode(file_get_contents(self::$configPath));
		}
		return self::$config;
	}

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
	public static function runUnitTests(){
		foreach(self::getConfig()->tests as $test){
			$test = str_replace('.', '\\', $test);
			try{
				$unit = new $test();
				foreach(get_class_methods($test) as $method){
					$unit->$method();
				}
			} catch(\ErrorException $e){
				$db = debug_backtrace();
				throw new TestNotFoundException($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line'] );
			}
		}
	}

	/**
	 * Init the application
	 * @return void
	 */
	public static function start(){
		$handler = new ExceptionHandler();
		$handler->setErrorTemplate('error_template.html', 'core/static');
		$scheduler = RuntimeErrorScheduler::getInstance();
		$scheduler->setExceptionHandler($handler);
		$scheduler->beginSchedule();
		try{
			session_start();
			$config = self::getConfig();
			header("Content-Type: text/html; charset={$config->encoding}");
			if($config->runTest) self::runUnitTests();
			App::main();
		}catch(\ErrorException $e){
			ob_end_clean(); // cleans the output buffer
			ob_start();		// inits again the output buffer
			$scheduler->scheduleException($e);
			ExceptionHandler::writeLog(get_class($e), $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
		}
	}
	
	/**
	 * @ignore
	 */
	public function __clone(){}
}