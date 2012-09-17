<?php
if(!class_exists('Config')):

class Config{

	static public function charset(){
		return "UTF-8";
	}
	
	static public function base_url(){
		return "http://{$_SERVER['SERVER_NAME']}/";
	}
}

endif;

//$config['base_url'] = 'http://'.$_SERVER['SERVER_NAME'].'/';
//$config['charset']  = 'UTF-8';
