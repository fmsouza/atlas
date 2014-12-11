<?php

class Util{

	public static function parseJsonList($list){
		$alist = array();
		foreach ($list as $json) {
			$alist[] = new JsonObject($json);
		}
		return new ArrayList($alist);
	}

	public static function loadJsonFromFile($filePath){
		$json = json_decode(file_get_contents($filePath));
		if(is_object($json)){
			return new JsonObject($json);
		}else if(is_array($json)){
			return self::parseJsonList($json);
		}
	}
}