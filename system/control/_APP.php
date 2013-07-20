<?php
	/**
	 * Contains _APP class
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
	/**
	 * The _APP class is the application core. It groups every main parâmeters and methods needed by
	 * the PHP web application to effectively run. It treats the URLs, load classes and, after a request,
	 * call the right method to do some action. 
	 * 
	 * @package system
	 * @subpackage control
	 * @abstract
	 */
	abstract class _APP implements _SINGLETON{
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
		 * @var mixed Stores router $_GET value
		 */
		static public $mRequest;
		/**
		 * @var mixed Stores arguments $_GET value
		 */
		static public $args;
		/**
		 * @var mixed Stores database connection
		 */
		static public $db;
		
		/**
		 * Runs the application main instructions
		 * @abstract
		 * @return void
		 */
		abstract public function onExecute();
		
		/**
		 * @ignore
		 */
		private function __construct(){
			$this->recoverSession();
			$this->construct();
		}
		
		/**
		 * Constructs the application
		 * @return void
		 */
		protected function construct(){
			self::$mRequest = (isset($_GET['r']) && $_GET['r']!="onExecute") ? $_GET['r'] : "";
			self::$args = isset($_GET['args']) ? explode("/",$_GET['args']) : array();
		}
		
		/**
		 * @ignore
		 */
		public function onStart(){}
		
		/**
		 * @ignore
		 */
		public function onFinish(){}
		
		/**
		 * Destroy the application instances
		 * @return void
		 */
		protected function destroy(){
			self::$mRequest = NULL;
			self::$args = NULL;
			self::$instance = NULL;
		}
		
		/**
		 * @ignore
		 */
		public function __destruct(){
			$this->writeSessionData();
			$this->destroy();
		}
		
		/**
		 * Returns Main instance
		 * @return Main
		 */
		static public function getInstance(){
			$className = (function_exists('get_called_class'))?get_called_class():"Main";
			if(is_null(self::$instance))
				self::$instance = new $className();
			return self::$instance;
		}
		
		/**
		 * @ignore
		 */
		public function __clone(){}
		
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
				$_SESSION['_APP']['sessionStatus'] = 1;
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
	 			}catch(ErrorException $e){
	 				$db = debug_backtrace();
		    		throw new SessionError($e->getMessage(), $e->getCode(), 0, $db[0]['file'], $db[0]['line'] );
				}
			}
		}
		
		/**
		 * @ignore
		 */
		private function fillSessionData(){
			if($this->getSessionStatus() && isset($_SESSION['_APP']['data'])){
				$this->sessionData = $_SESSION['_APP']['data'];
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
		 * 
		 * @return void
		 */
		private function recoverSession(){
			if(isset($_SESSION['_APP'])){
				$this->sessionStatus = 1;
				$this->fillSessionData();
			}else
				$this->sessionStatus = 0;
		}
		
		/**
		 * Updates PHP session with the application session data
		 * 
		 * @return void
		 */
		private function writeSessionData(){
			if($this->getSessionStatus()){
				$_SESSION['_APP']['data'] = $this->sessionData;
			}
		}
		
		/**
		 * Render some content into the screen
		 * 
		 * @param Element|string $value
		 * @return void
		 */
		public static function display($value){
			file_put_contents("php://output", ($value instanceof Element) ? $value->toRender() :  $value);
		}
	}
