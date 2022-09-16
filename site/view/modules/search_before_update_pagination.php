<?php 
/*==================================
=            pagination            =
==================================*/

$max=12;
$_SESSION["mode"]="";
$order_by="";
if (isset($rutas[1])) {
	
	 if (isset($rutas[2])) {
			$r2=$rutas[2];

	 	 if ($r2=="menor-precio") {
	 	 	$mode="ASC";
	 	 	$order_by="price";
	 	 	$_SESSION["mode"] = "ASC";

	 	 } else if ($r2=="mayor-precio")  {
	 	 	$mode="DESC";
	 	 	$order_by="price";
	 	 	$_SESSION["mode"]="DESC";
	 	 } else if ($r2=="mayor-descuento")  {
	 	 	$mode="DESC";
	 	 	$order_by="offer_discount";
	 	 	$_SESSION["mode"]="DESC";
	 	 } else if ($r2=="recientes")  {
	 	 	$mode="DESC";
	 	 	$order_by="id";
	 	 	$_SESSION["mode"]="DESC";
	 	 } else{
	 	 	$mode="ASC";
	 	 	$order_by="id";
	 	 	$_SESSION["mode"]="ASC";
	 	 }
	 	 
	 }
	 else{	$mode=$_SESSION["mode"];
	}
	 
	 $base= ($rutas[1]-1)*12;
	 
}else{
	$rutas[1]=1;
	$base=0;
	$mode="DESC";
	 
}

/*==================================
=            filters           =
==================================*/
 
$null=null; 
$pro_s=null;
$list=null;


if (isset($rutas[3])) {

	$search=$rutas[3];

 
	$pro_s= Product_c::c_search($search, $order_by, $mode, $base, $max);


	$list=Product_c::c_search_list($search);	
}
 

$r4="";
$filter=0;
$filter2=0;
$faof=[];
$aia=array();
$indx=0;
if (isset($rutas[4])) {
	$r4=$rutas[4];
 

 



switch ($r4) {
	case 'menos-de':
 
		 if (isset($rutas[5])&&is_numeric($rutas[5])) {
		 	
		 	$filter=$rutas[5];
 
		 	for ($i=0; $i <count($list) ; $i++) { 

		 		if ($list[$i]["price"]>=$filter) {
		 			unset($list[$i]);
		 		}
		 	}



 	 foreach ($list as $key => $value) {
	 	if (count($aia)<12) {
 		 		array_push($aia, $value);  
 		 	}else{
				$faof[$indx]= $aia;
				$indx++;	
				$aia=array();
				array_push($aia, $value); 

 		 	}
}
if (count($aia)!=0) {
	 $faof[$indx+1]= $aia;
}
 

}

		break;
	case 'entre':
$list_=$list;
 

		 if (isset($rutas[6])&&is_numeric($rutas[5])&&is_numeric($rutas[6]))   {
		 	$filter=$rutas[5];
		 	$filter2=$rutas[6];
var_dump(count($list));
		 	for ($i=0; $i <count($list) ; $i++) { 
 	 	 		
	 	 if ($list[$i]["price"]<$filter||$list[$i]["price"]>=$filter2){
 
		 			 unset($list_[$i]); 
		 			
		 		} 
		 	}
 
 	 foreach ($list_ as $key => $value) {


 		 	if (count($aia)<12) {
 		 		array_push($aia, $value);  
 		 	}else{
				$faof[$indx]= $aia;
				$indx++;	
				$aia=array();
				array_push($aia, $value); 
 		 	}	 
 }
 
 if (count($aia)!=0) {
	 $faof[$indx+1]= $aia;
}

 

}

		 
		break;
	case 'mas-de':
 $list_=$list;
		 		 if (isset($rutas[5])&&is_numeric($rutas[5])) {
		 	
		 	$filter=$rutas[5];
 
		 	for ($i=0; $i <count($list) ; $i++) { 
 
		 		if ($list[$i]["price"]<$filter) {
		 			 
		 			unset($list_[$i]);
		 		 
		 		}
		 	}



 	 foreach ($list_ as $key => $value) {
	 	if (count($aia)<12) {
 		 		array_push($aia, $value);  
 		 	}else{
				$faof[$indx]= $aia;
				$indx++;	
				$aia=array();
				array_push($aia, $value); 

 		 	}
}
if (count($aia)!=0) {
	 $faof[$indx+1]= $aia;
}
}
		break;
	
	default:break;
}























}

?>


<!--=====================================
 PRODUCT BAR
======================================-->

<div class="container-fluid card bg-light text-dark product_bar">
			 <div class="container">
			 	<div class="row">
			 		<div  class="col-sm-6">
			 			<div class="btn-group">
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							 Ordenar Productos<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu"><!-- <LI><a class="dropdown-item" href="'.$_site.$rutas[0].'/1/mayor-precio/'.$rutas[3].'">Mayor precio</a></LI>
							<LI><a class="dropdown-item" href="'.$_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'">Menor precio</a></LI> -->
								<?php echo '
								<LI><a class="dropdown-item" href="'.$_site.$rutas[0].'/1/recientes/'.$rutas[3].'">Recientes</a></LI>
								<LI><a class="dropdown-item" href="'.$_site.$rutas[0].'/1/antiguos/'.$rutas[3].'">Antiguos</a></LI>
								<LI><a class="dropdown-item" href="'.$_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'">Menor precio</a></LI>
								<LI><a class="dropdown-item" href="'.$_site.$rutas[0].'/1/mayor-precio/'.$rutas[3].'">Mayor precio</a></LI>
								<LI><a class="dropdown-item" href="'.$_site.$rutas[0].'/1/mayor-descuento/'.$rutas[3].'">Mayor descuento</a></LI>

							';
							 ?>
								 
							</UL>
						</div>
						<div class="btn-group">
							<button id="side_btn_" type="button" class="btn btn-success side_nav" onclick="openNav()">
								<span class="fa fa-plus"><i id="_filter" class="side_nav">Filtrar</i> </span>
							</button>
						</div>
			  


			 		</div>





			 		<div class="col-sm-6 organize_p">
			 			<div class="btn-group float-right">

			 				<button type="button" class="btn  btn-secondary btn_grid" id="btn_grid_p">
			 					<i class="fa fa-th" aria-hidden="true"></i>
			 					<span class="col-xs-0 float-right">'<?php echo $_grid ?></span>
			 				</button>

			 				<button type="button" class="btn  btn-secondary btn_list" id="btn_list_p">
			 					<i class="fa fa-list" aria-hidden="true"></i>
			 					<span class="col-xs-0 float-right"><?php echo $_list; ?></span>
			 				</button>

			 			</div>
			 		</div>
			 	</div>
			 </div>
</div>
<!--==============================
=            side bar            =
===============================-->
<?php include "side_nav.php"; ?>
<!--============================
=            listar            =
=============================-->
<div class="container-fluid div_p">
	<div class="container" id="div_list">
 <!-- 		<div class="row">
 	

************************************ -->
			<ul class="breadcrumb bc_backgound text-uppercase" id="breadcrumb_ul">
				<li><a href="<?php echo $_site;  ?>">Inicio</a></li>
				<li class="active pag_act"><?php echo $rutas[3]; ?> </li>
			</ul>

<!--======================================-->
<?php 

if (isset($rutas[5])) {
	$pro_s=$aia;
}


if (!$pro_s) {
	echo '<div class="col-sm-12 error404 text-center">
	<h1><small>'.$_oops.'</small></h1>
	<h2>'.$_noproducts.'</h2>
</div>';
}else{

echo '<ul class="grid0 row" style="display:none">';
	foreach ($pro_s as $key => $value) {

 		 echo '<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="'.$value["url"].'" class="pixel_p">
						<img src="'.$_admin.$value["front"].'" class="img-fluid">
					</a>
				</figure>
				<h4>
					<small> 			 	
 					<a href="'.$value["url"].'" class="pixel_p">
							'.$value["title"] .' '.$value["id"].'<br>

								<span style="color:rgba(0,0,0,0)">-</span>';

								if ($value["new"]!=0) {
									echo '<span class="label label-warning fontSize">new</span> ';									
								}
								if ($value["offer"]!=0) {
									echo '<span class="label label-warning fontSize">'.$value["offer_discount"].'% off</span>';									 
								}

			echo 		'</a>
					</small>
				</h4>
				<div style="    margin-top: 0px;" class="col-xs-6 price">';	


					if ($value["price"]==0) {
						echo '<h2><small>GRATIS</small></h2>'; 
					}else{

						if ($value["offer"]!=0) {
							echo '<h2>
									<small>
				
										<strong class="offer">'.$_currency.' '.$value["price"].'</strong>

									</small>

									<small>$'.$value["offer_price"].'</small>
								
								</h2>';
						}else{
									echo '<h2><small>USD $'.$value["price"].'</small></h2>';							
						}
					}	

	echo '</div>
				<div class="col-xs-6 links">
					<div class="btn-group float-right">

						<button type="button" class="btn btn-light btn-sm wishes_btn" id_p="'.$value["id"] .'" data-toggle=tooltip title="Agregar a lista deseados">
							<i class="fa fa-heart" aria-hidden="true"></i>
						</button>';

//comprobacion virtual y gratuito
					if ($value["type"]=="virtual"&& $value["price"]!=0) {
						if ($value["offer"]!=0) {
						 	 
						echo '<button type="button" class="btn btn-default btn-sm add_cart"  id_p="'.$value["id"].'" img="'.$_admin.$value["front"].'" title_p="'.$value["title"].'" price="'.$value["offer_price"].'" type_p="'.$value["type"].'" weight="'.$value["weight"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

						<i class="fa fa-shopping-cart" aria-hidden="true"></i>

						</button>';	
						 


					}else{

					echo '<button type="button" class="btn btn-default btn-sm add_cart"  id_p="'.$value["id"].'" img="'.$_admin.$value["front"].'" title_p="'.$value["title"].'" price="'.$value["price"].'" type_p="'.$value["type"].'" weight="'.$value["weight"].'" data-toggle="tooltip" title="Agregar al carrito de compras">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>			
						</button>';

					}}



echo            '<a href="'.$value["url"].'" class="pixel_p">
								  		<button type="button" class="btn btn-default btn-xs"   data-toggle="tooltip" title="Ver producto">

							  		<i class="fa fa-eye" aria-hidden="true"></i>

							  		</button>
							</button>
						</a>
					</div>
				</div>				
			</li>';
	
 	}
echo '</ul>
<ul class="list0" style="display:none">';

				foreach ($pro_s as $key => $value) {

					echo '<li class="col-xs-12 row">
					  
				  		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							   
							<figure>
						
								<a href="'.$value["url"].'" class="pixel_p">
									
									<img src="'.$_admin.$value["front"].'" class="img-fluid">

								</a>

							</figure>

					  	</div>
							  
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>

								<small>

										<a href="'.$value["url"].'" class="pixel_p">
										
									<span>	'.$value["title"].' </span>';

										if($value["new"] != 0){

											echo '<span class="label label-warning">new</span> ';

										}

										if($value["offer"] != 0){

											echo '<span class="label label-warning">'.$value["offer_discount"].'% off</span>';

										}		

									echo '</a>

								</small>

							</h1>

							<p class="text-muted">'.$value["headline"].'</p>';

							if($value["price"] == 0){

								echo '<h2><small>GRATIS</small></h2>';

							}else{

								if($value["offer"] != 0){

									echo '<h2>

											<small>
						
												<strong class="offer">USD $'.$value["price"].'</strong>

											</small>

											<small>$'.$value["offer_price"].'</small>
										
										</h2>';

								}else{

									echo '<h2><small>USD $'.$value["price"].'</small></h2>';

								}
								
							}

							echo '<div class="btn-group pull-left enlaces">
						  	
						  		<button type="button" class="btn btn-default btn-xs deseos"  idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">

						  			<i class="fa fa-heart" aria-hidden="true"></i>

						  		</button>';

						  		if($value["type"] == "virtual" && $value["price"] != 0){

										if($value["offer"] != 0){

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" img="'.$_admin.$value["front"].'" title_p="'.$value["title"].'" price="'.$value["offer_price"].'" type_="'.$value["type"].'" weight="'.$value["weight"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}else{

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" img="'.$_admin.$value["front"].'" title_p="'.$value["title"].'" price="'.$value["price"].'" type_="'.$value["type"].'" weight="'.$value["weight"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}

									}

						  		echo '<a href="'.$value["url"].'" class="pixel_p">

							  		<button type="button" class="btn btn-default btn-xs"   data-toggle="tooltip" title="Ver producto">

							  		<i class="fa fa-eye" aria-hidden="true"></i>

							  		</button>

						  		</a>
							
							</div>

						</div>

						<div class="col-xs-12"><hr></div>

					</li>';

				}

				echo '</ul>';
}

 ?>
<!-- ************************************ -->
 
<div class="position-absolute card bg-light text-dark ">
<ul class="pagination position-absolute__content g_l_pagination"  >

<?php 
 
$cant= count($list);

if ($cant!=0) {
	$pages=ceil($cant/12);

	if ($pages>4) {

		/*=============================================
		=            first 4 and last page            =
		=============================================*/
		if ($rutas[1]==1) {
		
		
				for($i=1; $i<=4;$i++){
				echo '<li   id="item'.$i.'"  class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
				}
			echo '<li class="page-item disabled"><a class="page-link">...</a></li>
			<li class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/'.$pages.'/'.$rutas[2].'/'.$rutas[3].'">'.$pages.'</a></li>
			<li class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/2/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>	
				';
		 
		 
		}

		/*=============================================
		=            first middle           =
		=============================================*/
			else if ($rutas[1]!=1&&$rutas[1]!=$pages&&$rutas[1]<($pages-3)&&$rutas[1]<($pages/2)) {
				$pag_n=$rutas[1];
				
				echo '<li class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/'.($pag_n-1).'/'.$rutas[2].'/'.$rutas[3].'"> <i class="fa fa-angle-left" aria-hidden="true"></i> </a></li>';
				 for($i=$pag_n; $i<=($pag_n+ 3);$i++){
				 echo '	<li  id="item'.$i.'"  class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
					
					}
					echo '<li class="page-item disabled"><a class="page-link">...</a></li>
					
					<li  id="item'.$pages.'"  class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/'.$pages.'/'.$rutas[2].'/'.$rutas[3].'">'.$pages.'</a></li>	
					<li class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/'.($pag_n+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>	
						';
			}
		/*=============================================
		                   second middle           
		=============================================*/
		else if ($rutas[1]!=1&&$rutas[1]!=$pages&&$rutas[1]<($pages-3)&&$rutas[1]>=($pages/2)) {
				$pag_n=$rutas[1];
				
				echo '<li class="page-item">
						<a class="page-link" href="'.$_site.$rutas[0].'/'.($pag_n-1).'/'.$rutas[2].'/'.$rutas[3].'">
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						</a>
					</li>
<li  id="item1"  class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
					<li class="page-item disabled">
						<a class="page-link">...
						</a>
					<li>';
				 for($i=$pag_n; $i<=($pag_n+ 3);$i++){
				 echo '	<li  id="item'.$i.'"  class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
					
					}
					echo 					
					'<li class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/'.($pag_n+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>	
						';
}		/*=============================================
		=            last 4 and last page            =
		=============================================*/
		else   {
			
			$pag_n=$rutas[1];
				echo '<li class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/'.($pag_n-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
				<li class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a><li>
				<li class="page-item disabled"><a class="page-link">...</a></li>	';

			for($i=($pages-3); $i<=$pages;$i++){
				echo '<li  id="item'.$i.'"  class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
				}
			
		}

	}else{
	

		echo '<ul class="pagination position-absolute__content"  >';
			for($i=1; $i<=$pages;$i++){
			echo '<li id="item'.$i.'" class="page-item"><a class="page-link" href="'.$_site.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
			}
	}
}


 ?>

</ul>

	 	
	
</div>
 
	
 		</div > 
 	</div>	
</div>

<!--====  End of listar  ====-->
