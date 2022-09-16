<?php 

require_once "connection.php";

 class Slide_m{
	static public function m_slide_config($table){
		$s= Connection::connect()->prepare("SELECT * FROM $table");
		$s->execute();
		return $s->fetchAll();
		$s->close();
		$s=null;
	}
}