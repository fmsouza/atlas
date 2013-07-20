<?php
	/** 
	 * Contains _USER class
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
	 * _USER class contains the paths and configurations to the application
	 * @package system
	 * @subpackage environment
	 */
	class _USER{
		/**
		 * @var string System administrator email
		 */
		public static $EMAIL_ADMIN = 'admin@domain.com';
		
		/**
		 * Base path
		 * @return string
		 */
		public static function BASE(){
			return _GLOBAL::BASE();
		}
		
		/**
		 * Application path
		 * @return string
		 */
		public static function HOME(){
			return self::BASE()."/application";
		}
		
		/**
		 * Path to environment classes
		 * @return string
		 */
		public static function ENV(){
			return self::BASE()."/application/environment";
		}
		
		/**
		 * Path to views directory
		 * @return string
		 */
		public static function VIEW(){
			return self::BASE()."/application/view";
		}
		
		/**
		 * Path to source files directory
		 * @return string
		 */
		public static function SRC(){
			return self::BASE()."/application/src";
		}
		
		/**
		 * All application main paths
		 * @return array
		 */
		public static function ALL_PATHS(){
			return array(
				'BASE'  => self::BASE(),
				'HOME'  => self::HOME(),
				'ENV'   => self::ENV(),
				'VIEW'  => self::VIEW(),
				'SRC'   => self::SRC()
			);
		}
	}