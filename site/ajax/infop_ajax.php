<?php 
require_once "../controller/product_c.php";
require_once "../model/product_m.php";

class Ajax_product{

	public $value;
	public $item;
	public $id;
	///////////////////////
	public $maxvv;
	public $minv;
	public $url;
	////////////////////////
	public function a_views_p(){

		$data= array("value"=> $this->value,
					"id"=> $this->id);
		$item= $this->item;
		$r=Product_c::c_u_views($data, $item);
		echo $r;
	}




}
	if (isset($_POST["value"])) {
		$views= new Ajax_product();
		$views->  value=$_POST["value"];
		$views->  item=$_POST["item"];
		$views->  id=$_POST["id"];
		$views->a_views_p();
	
}
