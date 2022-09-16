<?php 
require_once "connection.php";
require_once "../config/config.php";

class Menu_m{

	static public function m_show_menu($table, $item, $value){

if ($table=="category") {
		if ($item!=null) { #var_dump("categoria");
		$s= Connection::connect()->prepare("SELECT * FROM $table WHERE $item=:$item");
		$s-> bindParam(":".$item, $value, PDO::PARAM_STR);
		$s-> execute();
		 return $s->fetch();
		 
		} else {
		$s= Connection::connect()->prepare("SELECT * FROM $table");
		$s->execute();
		return $s->fetchAll();		
		}
}
if ($table=="subcategory") {
		$s= Connection::connect()->prepare("SELECT * FROM $table WHERE $item=:$item");
		
		$s-> bindParam(":".$item, $value, PDO::PARAM_INT);
		$s->execute();
		return $s-> fetchAll();

		}
		$s->close();
		$s = null; 

	}
		static public function m_show_menu_s($table, $item, $value){

		$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

}

 