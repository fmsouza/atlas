<?php if(!class_exists('Controller')):

class Controller{

	public function model($name,$rename=''){
		require(APP_PATH.'/classes/models/'.$name.'.php');
		if(!empty($rename))
			$this->{$name} = new $name();
		else
			$this->{$rename} = new $name();
	}
	
	public function view($name){
		require(APP_PATH.'/views/'.$name.'.php');
	}

	public function library($name,$rename='',$param=''){
		require(APP_PATH.'/classes/libraries/'.$name.'.php');
		if(!empty($rename))
			$this->{$name} = new $name();
		else
			$this->{$rename} = new $name();
	}
}

endif;