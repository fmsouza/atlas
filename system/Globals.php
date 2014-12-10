<?php
	/**
	 * Contains Globals class
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
	 * Globals class contains the global system configurations
	 * @package system
	 */
	class Globals{
		/**
		 * @var bool $debug Toggle debug mode on/off
		 */
		public static $debug = TRUE;
		
		/**
		 * @var bool $test Toggle Unit Test execution on/off
		 */
		public static $test = TRUE;
		
		/**
		 * Application's base path
		 * @return string
		 */
		public static function base(){
			return getcwd();
		}
		
		/**
		 * Environment configuration file path
		 * @return string
		 */
		public static function config(){
			return User::environment()."/config.json";
		}
		
		/**
		 * System's directory path
		 * @return string
		 */
		public static function systemPath(){
			return self::base()."/system";
		}
		
		/**
		 * Path to core environment classes
		 * @return string
		 */
		public static function environmentPath(){
			return self::systemPath()."/environment";
		}
		
		/**
		 * Path to core control classes
		 * @return string
		 */
		public static function controlPath(){
			return self::systemPath()."/control";
		}
		
		/**
		 * Path to error classes
		 * @return string
		 */
		public static function errorPath(){
			return self::controlPath()."/error";
		} 
		
		/**
		 * Path to core view classes
		 * @return string
		 */
		public static function viewPath(){
			return self::systemPath()."/view";
		}
		
		/**
		 * All system paths
		 * @return array
		 */
		public static function paths(){
			return array(
				self::base(),
				self::systemPath(),
				self::environmentPath(),
				self::controlPath(),
				self::controlPath()."/database",
				self::controlPath()."/datatypes",
				self::controlPath()."/tools",
				self::errorPath(),
				self::viewPath(),
				self::viewPath()."/HTML"
			);
		}
	}
