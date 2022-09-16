<!--=====================================
BANNER
======================================-->
<?php 
 $featured="featured";
$banner=Product_c::c_banner($featured); 
if ($banner) {
	 
$h1=json_decode($banner["h1"], true);
$h2=json_decode($banner["h2"], true);
$h3=json_decode($banner["h3"], true);


echo '
<figure class="banner" id="bn_template">
	<img src="'.$_admin.$banner["img"].'" class="img-fluid" width="100%">
	<div class="banner_txt '.$banner["style"].'">
		<h1 style="color: :'.$h1["color"].'">'.$h1["txt"].'</h1>
		<h2 style="color: :'.$h2["color"].'"><strong>'.$h2["txt"].'</strong></h2>
		<h3 style="color: :'.$h3["color"].'">'.$h3["txt"].' </h3>
	</div>
</figure>';
}
 
$mode="DESC";
 
$titles_modules= array($_block1,$_block2,$_block3);

$base=0;
$max=4;
$null=null;

if ($titles_modules[0]==$_block1) {
$option="id";
$item="price";
$valuef=0;

$free= Product_c::c_read($option, $mode,  $item, $valuef, $base, $max);

}
if ($titles_modules[1]==$_block2) {
$option="sales";
$sales=Product_c::c_read($option, $mode, $null, $null, $base, $max); 
} 
if ($titles_modules[2]==$_block3) {
$option="views";
$views =Product_c::c_read($option, $mode, $null, $null, $base, $max);
} 
$modules= array($free, $sales, $views);
$m_urls=array("gratis", "lo-mas-vendido" ,"lo-mas-visto");

//===========================-->
for ($i=0; $i < count($titles_modules); $i++) { 
	

//--==========================
//=            free            =

echo 	'<div class="container-fluid card bg-light text-dark product_bar">
			 <div class="container">
			 	<div class="row">
			 		<div class="col-sm-12 organize_p">
			 			<div class="btn-group float-right">

			 				<button type="button" class="btn  btn-secondary btn_grid" id="btn_grid'.$i.'">
			 					<i class="fa fa-th" aria-hidden="true"></i>
			 					<span class="col-xs-0 float-right">'. $_grid.'</span>
			 				</button>

			 				<button type="button" class="btn  btn-secondary btn_list" id="btn_list'.$i.'">
			 					<i class="fa fa-list" aria-hidden="true"></i>
			 					<span class="col-xs-0 float-right">'.$_list.'</span>
			 				</button>

			 			</div>
			 		</div>
			 	</div>
			 </div>
		</div>';

		//<!--==============================================-->

		
echo 	'<div class="container-fluid div_p">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 featured_title row" style="margin-top: 1em;">			
						<div class="col-md-6 ">
							<h1><small> '.$titles_modules[$i] .'</small></h1>	
						</div>
					

						<div class="col-md-6 ">
							<a href="'.$m_urls[$i].'">

								<button class="btn btn-dark back_color float-right">'.$_see_more.'<span class="fa fa-chevron-right"></span>
								</button>
							</a>	
						</div>
					</div>



					<div class="clearfix"></div>
						<hr>
				</div> 
				<ul class="grid'.$i.' row">';
		
//<!--=============================================-->

 	foreach ($modules[$i] as $key => $value) {
 		 echo '<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="'.$value["url"].'/'.$value["id"].'" class="pixel_p">
						<img src="'.$_admin.$value["front"].'" class="img-fluid">
					</a>
				</figure>
				<h4>
					<small>';

			echo '		
 					<a href="'.$value["url"].'/'.$value["id"].'"  class="pixel_p">
							'.$value["title"] .' <br>
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



echo            '<a href="'.$value["url"].'/'.$value["id"].'"  class="pixel_p">
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
<ul class="list'.$i.'" style="display:none">';

				foreach ($modules[$i] as $key => $value) {

					echo '<li class="col-xs-12 row">
					  
				  		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							   
							<figure>
						
								<a href="'.$value["url"].'/'.$value["id"].'"  class="pixel_p">
									
									<img src="'.$_admin.$value["front"].'" class="img-fluid">

								</a>

							</figure>

					  	</div>
							  
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>

								<small>

										<a href="'.$value["url"].'/'.$value["id"].'"  class="pixel_p">
										
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

						  		echo '<a href="'.$value["url"].'/'.$value["id"].'"  class="pixel_p">

							  		<button type="button" class="btn btn-default btn-xs"   data-toggle="tooltip" title="Ver producto">

							  		<i class="fa fa-eye" aria-hidden="true"></i>

							  		</button>

						  		</a>
							
							</div>

						</div>

						<div class="col-xs-12"><hr></div>

					</li>';

				}

				echo '</ul>




	</div>
</div>';

		}

?>
 
