<?php 
require_once "connection.php";

class Product_m{

	static public function m_read($table, $option,$mode, $item, $value, $base, $max){
		
	if ($item!=null) {
			$s= Connection::connect()->prepare("SELECT * FROM $table WHERE $item=:$item ORDER BY $option $mode LIMIT $base, $max");
			$s-> bindParam(":".$item, $value, PDO::PARAM_STR);
			$s->execute();
			return $s-> fetchAll();		

		} else {
			$s= Connection::connect()->prepare("SELECT * FROM $table ORDER BY $option  $mode LIMIT $base, $max ");
			$s->execute();
			return $s-> fetchAll();
		 }/**/
		
		$s->close();
		$s=null;		

	}

	static public function m_info_p($table, $item, $value){
		$s=Connection::connect()-> prepare("SELECT * FROM $table WHERE $item=:$item");
		$s-> bindParam(":".$item, $value, PDO::PARAM_STR);
		$s->execute();
		
		return $s -> fetch();

		$s->close();
		$s=null;
	}

	static public function m_list($table, $order, $mode, $item, $value){
		
	if ($item!=null) {
			$s= Connection::connect()->prepare("SELECT * FROM $table WHERE $item=:$item ORDER BY $order $mode");
			$s-> bindParam(":".$item, $value, PDO::PARAM_STR);
			$s->execute();
			return $s-> fetchAll();		

		} else {
			$s= Connection::connect()->prepare("SELECT * FROM $table ORDER BY $order  $mode ");
			
			$s->execute();
			return $s-> fetchAll();
		 }/**/
		
		$s->close();
		$s=null;		

	}
		static public function m_banner($table, $url){
		$s=Connection::connect()-> prepare("SELECT * FROM $table WHERE url=:url");
		$s-> bindParam(":url", $url, PDO::PARAM_STR);
		$s->execute();
		
		return $s -> fetch();

		$s->close();
		$s=null;
	}

		static public function m_search($table, $search, $order_by, $mode,  $base, $max){

		$s=Connection::connect()-> prepare("SELECT * FROM $table WHERE url LIKE '%$search%'
		 OR title LIKE '%$search%' OR  headline LIKE '%$search%' OR description LIKE '%$search%' ORDER BY $order_by $mode LIMIT $base, $max"); 
	
		$s->execute();
		
		return $s -> fetchAll();

		$s->close();
		$s=null;
	}
		static public function m_search_list($table, $search,$order_by, $mode){

	
		$s=Connection::connect()-> prepare("SELECT * FROM $table WHERE url LIKE '%$search%'
		 OR title LIKE '%$search%' OR  headline LIKE '%$search%' OR description LIKE '%$search%'  ORDER BY $order_by $mode"); 
		$s->execute();
		
		return $s -> fetchAll();

		$s->close();
		$s=null;
	}

		static public function m_filter_search($table, $search, $item, $value,  $svalue,  $option){
			
				$s=Connection::connect()-> prepare("SELECT * FROM $table WHERE url LIKE '%$search%'
				OR title LIKE '%$search%' OR  headline LIKE '%$search%' OR description LIKE '%$search%' and $item=:$item");	
			
		 
		
		$s->execute();
		
		return $s -> fetchAll();

		$s->close();
		$s=null;
	}
		static public function m_offer($table, $item,$search){
 		$s=Connection::connect()-> prepare("SELECT $item FROM $table WHERE url LIKE '%$search%'
		 OR title LIKE '%$search%' OR  headline LIKE '%$search%' OR description LIKE '%$search%' ORDER BY $table.$item DESC"); 
		$s->execute();
		
		return $s -> fetchAll();

		$s->close();
		$s=null;
	}
	static public function m_u_views($table, $data, $item){
var_dump($table, $data, $item);
		$s= Connection:: connect()-> prepare("UPDATE $table SET $item=:$item WHERE id=:id");
		$s-> bindParam(":id", $data["id"], PDO::PARAM_STR);
		$s-> bindParam(":".$item, $data["value"], PDO::PARAM_STR);
		if ($s->execute() ) {
			 return "done";
		}else{
			return "error";
		}
		$s->close();
		$s=null;
	}

}