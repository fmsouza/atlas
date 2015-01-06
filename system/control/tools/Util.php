<?php
/**
 * Contains Util class
 * 
 * @copyright Copyright 2014 Marvie
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

    namespace system\control\tools;

	use system\control\datatypes\JsonObject;
	use system\control\datatypes\ArrayList;

	/**
	 * Contains functions to help dealing with data.
	 * @package system\control\tools
	 */
	class Util{
        
        /**
         * Converts a JSON strings list to a list of JsonObject
         * @param array $list JSON string list
         * @return ArrayList
         */
		public static function parseJsonList($list){
			$alist = array();
			foreach ($list as $json) {
				$alist[] = new JsonObject($json);
			}
			return new ArrayList($alist);
		}
        
        /**
         * Reads JSON data from a file
         * @param string $filePath JSON source file path
         * @return ArrayList|JsonObject
         */
		public static function loadJsonFromFile($filePath){
			$json = json_decode(file_get_contents($filePath));
			if(is_object($json)){
				return new JsonObject($json);
			}else if(is_array($json)){
				return self::parseJsonList($json);
			}
		}
        
        /**
         * Converts an array to stdObject
         * @param array $list Data list
         * @return stdObject
         */
		public static function listToObject($list){
			return json_decode(json_encode($list), FALSE);
		}
	}