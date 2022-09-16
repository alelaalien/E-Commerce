<?php 
include 'functions.php';
class Product_c{



	static public function c_read($option, $mode, $item, $value, $base, $max){
		$table="product";
		$r= Product_m::m_read($table, $option,$mode, $item, $value, $base, $max);

		return $r;
	}
	static public function c_info_p($item, $value){
		$table="product";
		 $r=Product_m::m_info_p($table, $item, $value);
	
		 return $r;
	}

	static public function c_list($order, $mode, $item, $value){
		$table="product";
		$r= Product_m::m_list($table, $order, $mode, $item, $value);

		return $r;
	}
	static public function c_banner($url){
		$table="banner";
		$r= Product_m::m_banner($table, $url);
		return $r;
	}
	static public function c_search($search, $order_by, $mode,$base, $max){
		$table= "product";
		$s=Functions::No_s($search);
		$r= Product_m::m_search($table, $s, $order_by, $mode,  $base, $max);
		return $r;
	}
		static public function c_search_list($search,$order_by, $mode){
		$table= "product";
		$s=Functions::No_s($search);
		$r= Product_m::m_search_list($table, $s,$order_by, $mode);
		return $r;
	}

	static public function c_filter_search($search, $item, $value,  $svalue, $option){
		$s=Functions::No_s($search);
		$table= "product";
		$r= Product_m::m_filter_search($table, $s, $item, $value, $svalue, $option);
		return $r;
	}
	static public function c_offer( $item, $search){
		$s=Functions::No_s($search);
		$table= "product";
		$r= Product_m::m_offer($table, $item, $s);
		return $r;
	}
	static public function c_u_views($data, $item){
		var_dump($data, $item);
		$table="product";
		$r= Product_m::m_u_views($table, $data, $item);
		return $r;
	}
} 
