<?php
	/**
	 * Stores your personal environment configuration.
	 * Fill this class with data which can help your application flexibility.
	 * @author Frederico Souza (fredericoamsouza@gmail.com)
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
	 * Stores your personal environment configuration.
	 * Fill this class with data which can help your application flexibility.
	 * 
	 * @package application
	 * @subpackage environment
	 */
	class Config{
	    
	    const encoding = "UTF-8";
	    /**
	     * Web application base path
		 * @example http://www.example.com/
	     * @return string
	     */
	    public static function baseURL(){
			return "http://{$_SERVER['SERVER_NAME']}/marvie/";
	    }
		
		/**
		 * Path to the error log file.
		 * @return string
		 */
		public static function logPath(){
			return "./errors.log";
		}
	    
	    /**
	     * Returns an array with the database configuration data.
		 * Fill it with your database configuration data.
	     * @return array
	     */
	    public static function dbConfig(){
			return array(
			    'host'       => '',
			    'user'       => '',
			    'password'   => '',
			    'dbName'     => '',
			    'tblPrefix'  => '',
			    'charset'    => '',
			    'driver'     => ''
			);
	    }
	}