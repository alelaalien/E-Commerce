<?php 

class Slide_c{

	static public function c_slide_config(){

		$table="slide";
		$r= Slide_m::m_slide_config($table);
		return $r;
	}
}