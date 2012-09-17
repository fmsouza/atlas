<?php
if(!class_exists('Config')):

class Config{
	static public $charset = 'UTF-8';
	
	static public function base_url(){
		return "http://{$_SERVER['SERVER_NAME']}/";
	}
}

endif;
