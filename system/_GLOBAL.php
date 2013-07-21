<?php
	/**
	 * Contains _GLOBAL class
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
	 * _GLOBAL class contains the global system configurations
	 * @package system
	 */
	class _GLOBAL{
		/**
		 * @var bool $DEBUG Turns debug mode on/off
		 */
		public static $DEBUG = TRUE;
		
		/**
		 * Application's base path
		 * @return string
		 */
		public static function BASE(){
			return getcwd();
		}
		
		/**
		 * System's directory path
		 * @return string
		 */
		public static function SYS_PATH(){
			return self::BASE()."/system";
		}
		
		/**
		 * Path to core environment classes
		 * @return string
		 */
		public static function ENV_PATH(){
			return self::SYS_PATH()."/environment";
		}
		
		/**
		 * Path to core control classes
		 * @return string
		 */
		public static function CTRL_PATH(){
			return self::SYS_PATH()."/control";
		}
		
		public static function ERROR_PATH(){
			return self::CTRL_PATH()."/_ERROR";
		} 
		
		/**
		 * Path to core view classes
		 * @return string
		 */
		public static function VIEW_PATH(){
			return self::SYS_PATH()."/view";
		}
		
		/**
		 * All system paths
		 * @return array
		 */
		public static function ALL_PATHS(){
			return array(
				'BASE'      		=> self::BASE(),
				'SYS_PATH'  		=> self::SYS_PATH(),
				'ENV_PATH'  		=> self::ENV_PATH(),
				'CTRL_PATH' 		=> self::CTRL_PATH(),
				'DATABASE'			=> self::CTRL_PATH()."/_DATABASE",
				'CTRL_TOOLS'	    => self::CTRL_PATH()."/_TOOLS",
				'TOOL_PHPMailer'	=> self::CTRL_PATH()."/_TOOLS/PHPMailer",
				'TOOL_html2pdf' 	=> self::CTRL_PATH()."/_TOOLS/html2pdf",
				'CTRL_ERROR'		=> self::ERROR_PATH(),
				'VIEW_PATH' 		=> self::VIEW_PATH(),
				'_HTML'				=> self::VIEW_PATH()."/_HTML"
			);
		}
	}
