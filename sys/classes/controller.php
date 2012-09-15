<?php if(!class_exists('Controller')):

abstract class Controller{

	public function model($name,$rename=''){
		/**
		 * @method model;
		 * @param string $name;
		 * @param string $rename;
		 * 
		 */
		require(APP_PATH.'/models/'.$name.'.php');
		if(!empty($rename))
			$this->{$name} = new $name();
		else
			$this->{$rename} = new $name();
	}
	
	public function view($name){
		/**
		 * @TODO: modificar o método de carregamento de view para carregar uma classe controladora de view
		 */
		require(APP_PATH.'/views/'.$name.'.php');
	}

	public function library($name,$rename='',$param=''){
		require(APP_PATH.'/libraries/'.$name.'.php');
		if(!empty($rename))
			$this->{$rename} = new $name();
		else
			$this->{$name} = new $name();
	}
}

endif;