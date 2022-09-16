<?php 
require_once "../controller/template_c.php";
require_once "../model/template_m.php";
 
class Ajax_template  
{
	
public	function  a_style_templete()
	{
		 
		 $r=Template_c::c_style_template();
					 
		echo json_encode($r);
						  
					
	}
}

$objet= new Ajax_template();
$objet -> a_style_templete();