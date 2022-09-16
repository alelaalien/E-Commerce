<?php 

/**
* 
*/
class Template_c  
{
	
	public function template()
	{
		include "view/template.php";
	}
	/*==============================
	=            styles            =
	==============================*/
static 	public function c_style_template(){
		$table="template";
		$r= Template_m::m_style_template($table);
		return $r;
	}
	
	
	/*=====  End of styles  ======*/
	
}