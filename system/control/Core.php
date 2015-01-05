<?php
/**
 * Contains App class
 * 
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
	
	namespace system\control;

	use system\control\Singleton;
	use system\control\tools\Util;

	/**
	 * The App class implements the lifecycle.
	 * @package system\control
	 * @abstract
	 */
	class Core implements Singleton{
		
		/**
		 * @var bool Session status
		 */
		protected $sessionStatus;
		/**
		 * @var array Session data
		 */
		protected $sessionData;
		/**
		 * @var Main Stores Main class Instance
		 */
		static private $instance;

		/**
		 * @var json Application configuration data
		 */
		static protected $config = NULL;
		
		/**
		 * @ignore
		 */
		static private $dump = array();
		/**
		 * @var Toggles unit test execution before application starts on/off
		 */
		static public $test = true;
		
		/**
		 * @ignore
		 */
		private function __construct(){
			if(TEST) $this->runUnitTests();
			$this->recoverSession();
		}
		
		/**
		 * Returns Main instance
		 * @return Main
		 */
		static public function getInstance(){
			//$className = (function_exists('get_called_class'))?get_called_class():"Application";
			if(is_null(self::$instance))
				self::$instance = new Core();
			return self::$instance;
		}
		
		/**
		 * Verifies if the session is opened or not
		 * @return boolean
		 */
		public function getSessionStatus(){
			return (bool)$this->sessionStatus;
		}
		
		/**
		 * Open the session
		 * @return void
		 */
		public function openSession(){
			if(!$this->getSessionStatus()){
				$this->sessionStatus = 1;
				$_SESSION[get_class()]['sessionStatus'] = 1;
				$_SESSION[get_class()]['data'] = array();
			}
		}
		
		/**
		 * Closes the session
		 * @return void
		 */
		public function closeSession(){
			if($this->getSessionStatus()){
				session_destroy();
				$this->sessionStatus = 0;
				unset($this->sessionData);
			}
		}
		
		/**
		 * Returns some data stored in session
		 * @param string $key
		 * @return string
		 */
		public function getSessionData($key){
			if($this->getSessionStatus()){
				try{
					return base64_decode($this->sessionData[$key]);
	 			}catch(\ErrorException $e){
	 				$db = debug_backtrace();
		    		throw new SessionException($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line']);
				}
			}
		}

		/**
		 * Returns all the application data stored in session
		 * @return array
		 */
		public function getSession(){
			return $this->sessionData;
		}
		
		/**
		 * @ignore
		 */
		private function fillSessionData(){
			if($this->getSessionStatus() && isset($_SESSION[get_class()]['data'])){
				$this->sessionData = $_SESSION[get_class()]['data'];
			}
		}
		
		/**
		 * Add/update the data set in session
		 * @param string $key nome do campo
		 * @param mixed $value dado a ser armazenado
		 * @return void
		 */
		public function addToSessionData($key,$value){
			if($this->getSessionStatus()){
				$this->sessionData[$key] = base64_encode($value);
			}
		}
		
		/**
		 * Recover last execution's session if set
		 * @return void
		 */
		private function recoverSession(){
			if(isset($_SESSION[get_class()])){
				$this->sessionStatus = 1;
				$this->fillSessionData();
			}else
				$this->sessionStatus = 0;
		}

		public static function getConfig(){
			if(is_null(self::$config)){
				self::$config = json_decode(file_get_contents(CONFIG));
			}
			return self::$config;
		}

		public function getGlobal($key){
			return $this->getSessionData("globals")->getKey($key);
		}
		
		/**
		 * Updates PHP session with the application session data
		 * @return void
		 */
		private function writeSessionData(){
			if($this->getSessionStatus()){
				$_SESSION[get_class()]['data'] = $this->sessionData;
			}
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
		 */
		public function runUnitTests(){
			foreach(self::getConfig()->tests as $test){
				$test = str_replace('.', '\\', $test);
				$unit = new $test();
				foreach(get_class_methods($test) as $method){
					$unit->$method();
				}	
			}
		}
		
		/**
		 * @ignore
		 */
		public function __clone(){}
		
		/**
		 * @ignore
		 */
		public function __destruct(){
			$this->writeSessionData();
			self::$instance = NULL;
		}
	}
