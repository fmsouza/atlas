<?php
	/** 
	 * Contains User class
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
	 * User class contains the paths and configurations to the application
	 * @package system
	 * @subpackage environment
	 */
	class User{
		/**
		 * @var string System administrator email
		 */
		public static $emailAdmin = "admin@localhost";
		
		private static $packages = [];
		
		/**
		 * Base path
		 * @return string
		 */
		public static function base(){
			return Globals::base();
		}
		
		/**
		 * Application path
		 * @return string
		 */
		public static function home(){
			return self::base()."/application";
		}
		
		/**
		 * Path to environment classes
		 * @return string
		 */
		public static function environment(){
			return self::home()."/environment";
		}
		
		/**
		 * Path to views directory
		 * @return string
		 */
		public static function view(){
			return self::home()."/view";
		}
		
		/**
		 * Path to source files directory
		 * @return string
		 */
		public static function source(){
			return self::home()."/src";
		}
		
		public static function addPackagePath($path){
			if(!in_array(self::source()."/".$path, self::$packages))
				array_push(self::$packages,self::source()."/".$path);
		}
		
		public static function packages(){
			return self::$packages;
		}
		
		public static function tests(){
			return self::home()."/tests";
		}
		
		/**
		 * All application main paths
		 * @return array
		 */
		public static function paths(){
			return array(
				self::base(),
				self::home(),
				self::environment(),
				self::view(),
				self::source(),
				self::tests()
			);
		}
	}