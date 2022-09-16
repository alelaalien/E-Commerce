 
<!DOCTYPE html>
<html>
<head>
	<?php 
	require "../config/config.php"; $template=Template_C::c_style_template();  ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
	<meta name="description" content="<?php echo $_description; ?>">
		<meta name="keyword" content="<?php echo $_keywords; ?>">
	<meta name="title" content="<?php echo $_title; ?>">
	<title><?php echo $_title; ?></title>
	<link rel="icon" type="text/css" href="<?php echo $_admin.$template['icon']?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $_admin.$_pluginsfolder ?>fontawesome-free/css/fontawesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Nuosu+SIL&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo $_site?>view/plugins/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_site?>view/plugins/flexslider.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $_site ?>view/plugins/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_site?>view/css/template.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_site?>view/css/slide.css">	
	<link rel="stylesheet" type="text/css" href="<?php echo $_site?>view/css/header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_site?>view/css/prod.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_site?>view/css/info_p.css">	
	<link rel="stylesheet" type="text/css" href="<?php echo $_site?>view/css/search.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> 
	<script src="<?php echo $_site ?>view/plugins/js/bootstrap.min.js"></script>
	<script src="<?php echo $_site ?>view/plugins/jquery.flexslider.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	 
<?php session_start(); ?>
</head>
<body>
<?php 
include "modules/top.php"; include "modules/header.php";
$rutas=array();
$ruta=null;

if (isset($_GET["url"])) {

	$rutas=explode("/", $_GET["url"]);

	$item="url";
	
	$value_item= $rutas[0];
	/*=============================================
	URL'S AMIGABLES DE CATEGORÍAS
	=============================================*/
	$rutaC=Menu_c::c_show_menu($_category,$item, $value_item);

 if($rutaC!=null){

if( $rutas[0]== $rutaC["url"]){
	
	$ruta=$rutas[0];
}
 }
/*=============================================
	URL'S AMIGABLES DE SUBCATEGORÍAS
	=============================================*/


$rutaSub=Menu_c::c_show_menu($_subcategory,$item, $value_item );
 if ($rutaSub!=null) {
foreach ($rutaSub as $key => $value) {
	 
 
	 if($rutas[0]== $value["url"]){
	$ruta=$rutas[0];
	
}
}	
 }
	/*=============================================
	URL'S AMIGABLES DE PRODUCTOS
	=============================================*/

$info_p=Product_c::c_info_p($item,$value_item );
 if ($info_p!=null) {
if($rutas[0] == $info_p["url"]){

		$infoProducto = $rutas[0];

	}
}
		/*=============================================
	LISTA BLANCA DE URL'S AMIGABLES
	=============================================*/
	if ($ruta!=null||$rutas[0]=="gratis"||$rutas[0]=="lo-mas-visto"||$rutas[0]=="lo-mas-vendido") {
		include "modules/product.php";
	}else if($info_p != null){

		include "modules/info_p.php";
	//	

	} else if ($rutas[0]=="search"||$rutas[0]=="verification"||$rutas[0]=="profile"||$rutas[0]=="logout"||$rutas[0]=="wait") {
		
		include "modules/".$rutas[0].".php";
	}else if ($rutas[0]=="comments") {
		include "modules/comments.php";
	} 

	else {
		include "modules/error404.php";
	}
}else{
	include "modules/slide.php";
	include "modules/featured.php";
}
/*=====  End of rutas  ======*/
?>
<input type="hidden" value="<?php echo $_site?>" id="site_u" >
<script type="text/javascript" src="<?php echo $_site ?>view/js/header.js"></script>
<script type="text/javascript" src="<?php echo $_site ?>view/js/template.js"></script>
<script type="text/javascript" src="<?php echo $_site ?>view/js/slide.js"></script>
<script type="text/javascript" src="<?php echo $_site ?>view/js/product.js"></script>
<script type="text/javascript" src="<?php echo $_site ?>view/js/search.js"></script>
<script type="text/javascript" src="<?php echo $_site ?>view/js/info_p.js"></script>
<script type="text/javascript" src="<?php echo $_site ?>view/js/user.js"></script>
</body>
</html>
