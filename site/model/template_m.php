<?php 
require_once "connection.php";

class Template_m{
	static public function m_style_template($table){

		$stmt=Connection::connect()->prepare("SELECT * FROM $table");
		$stmt -> execute();
		return $stmt->fetch();
		$stmt -> close();
	}
}