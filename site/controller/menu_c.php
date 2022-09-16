<?php 

 class Menu_c{

 	static public function c_show_menu($option, $item, $value){
 	 
 		 
 		$r=Menu_m::m_show_menu($option, $item, $value) ;
 		return $r;
 	}

 	static public function c_show_menu_s($option, $item, $value){
 	 
 		 
 		$r=Menu_m::m_show_menu_s($option, $item, $value) ;
 		return $r;
 	}


 

 }