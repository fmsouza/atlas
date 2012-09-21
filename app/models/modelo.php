<?php
class Modelo extends Model{
	
	public function get(){
		return $this->db->sql("SELECT * FROM acervo_item");
	}
}