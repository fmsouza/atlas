<?php
namespace core\tools;

use core\datatypes\JsonObject;
use core\datatypes\ArrayList;

/**
 * Contains functions to help dealing with data.
 * @package core\control\tools
 */
class Util{
    
    /**
     * Converts a JSON strings list to a list of JsonObject
     * @param array $list JSON string list
     * @return ArrayList
     */
	public static function parseJsonList($list){
		$tmp = array();
		foreach ($list as $json) {
			$tmp[] = new JsonObject($json);
		}
		return new ArrayList($tmp);
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
     * @return \stdClass
     */
	public static function listToObject($list){
		return json_decode(json_encode($list), FALSE);
	}

	/**
	 * Gets all the ocurrences between two patterns in a string.
	 * Each pattern may be regex or string
	 * @param string $start Start pattern
	 * @param string $end End pattern
	 * @param string $str The string to be searched
	 * @return \stdClass
	 */
	public static function getInBetweenStrings($start, $end, $str){
		$matches = null;
		preg_match_all("~{$start}(.*){$end}~", $str, $matches);
		return preg_replace(array("/{$start}/", "/{$end}/"), '', $matches[0]);
	}
}