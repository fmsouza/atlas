<?php
class Main extends Controller{
	
	public function index(){
		$this->library('teste_lib','teste');
		$page = $this->teste->run();
		$this->view($page);
	}
}