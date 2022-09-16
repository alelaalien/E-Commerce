
<?php 
		$isvirtual=false;
		$item="id";
	$value="";
	if (isset($rutas[1])) {
	$value=$rutas[1];	 
	}
	
$jgalery="";
	$ip=Product_c::c_info_p($item, $value);
		if (!$value||!is_numeric($value)||!$ip||$rutas[0]!=$ip["url"]) {
		include "error404.php";
		$ip=null;
		//die();
	}else{
		if ($ip!=null) {
		 
		
	$jgalery=json_decode($ip["galery"], true);
	if ($ip["type"]==$_virtual) {
		$isvirtual=true;
	}	
}

	}
$none=false;
if (!$ip) {
 $none=true;
}
if ($ip!=null) {
 echo '
<div  st="'.$none.'" id="div_pb" class="container-fluid card bg-light text-dark product_bar">
	 <div class="container">
	 	<div class="row">
	 		<ul class="breadcrumb  bc_backgound text-uppercase" >
	 			<li><a href="'.$_site.'">Inicio</a></li>
				<li class="active pag_act"> '.$rutas[0].' </li>
	 		</ul>
	 	</div>
	 </div>
</div>
 
<div  id="info_p" class="container-fluid info_p">
	<div class="container">
		<div class="row">';
 
			
			 

			if ($ip["type"]==$_fisico) {
				if ($jgalery!=null) {
		 
				echo '<div class="col-md-5 col-sm-12 img_viewer"><figure class="viewer">';
				for ($i=0; $i <count($jgalery) ; $i++) { 
 				echo '<img id="zoom_'.($i+1).'" src="'.$_admin.$jgalery[$i]["img"].'" alt="'.$jgalery[$i]["img"].'" class="img-thumbnail">';
				}}
				echo '</figure>
					<div class="flexslider carousel">
						<ul class="slides">';
						if ($jgalery!=null) {
							for ($i=0; $i <count($jgalery) ; $i++) { 
								echo '<li>
										<img value="'.($i+1).'" src="'.$_admin.$jgalery[$i]["img"].'" alt="'.$jgalery[$i]["img"].'" class="img-thumbnail">
									</li>';
							}}
					echo '</ul>
					</div>
				</div>
				<div class="col-md-7 col-sm-12">';
			} /*----------  virtual  -----autoplay;-----*/
			else{
				echo '<div class="col-md-6 col-sm-12 col-12">
						<iframe class="video_presentation" src="https://www.youtube.com/embed/buNY_ee6MoI?rel=0&showinfo=0&controls=1&autoplay=1" frameborder="0" allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
					<div class="col-md-6 col-sm-12">';
			}
	echo'	<div>
				<h6>
					<a href="javascript:history.back()" class="text-muted">
						<i class="fa fa-reply"></i>
						'." ".$_keepbuying.'
					</a>
				</h6>
			</div>
			<div>
				<div class="float-right" id="shrcntnr">
					<button class="w3-button w3-xlarge w3-circle w3-green float-right"  id="btnshare"  data-toggle="tooltip" title="'.$_share.'!">
						<i class="fa fa-share-alt"></i>
					</button>
						<button class="w3-button w3-xlarge w3-circle btnssm btntwitter w3-card-4" id="btnst">
							<i class="fa fa-twitter"></i>
						</button>
						<button class="w3-button w3-xlarge w3-circle btnssm btnfb" id="btnsf">
							<i class="fa fa-facebook"> </i>
						</button>
						<button class="w3-button w3-xlarge w3-circle btnssm btninstagram" id="btnsi">
							<i class="fa fa-instagram"></i>
						</button>
						
							
				</div>			
			</div>';
			 $delivery="";
			 if ($isvirtual) {
			 	$delivery= "inmediata";
			 }else{
			 	$delivery= "en ".$ip["delivery_days"]." días hábiles";
			 }
			echo'<div ><span class="badge badge-pill badge-secondary" style="font-weight: 100">';

				if ($ip["delivery"]!=0||$isvirtual) {
					echo '<i class="fa fa-clock-o" style="margin-right: 5px">	Entrega '.$delivery.' |</i>';
				}
					
							
					echo '<i class="fa fa-shopping-cart" style="margin: 0px 5px"> '.$ip["sales"].' ventas |	</i>
					<i class="fa fa-eye" style="margin: 0px 5px"> visto por <span class="views">'.$ip["views"].'</span> personas</i>
					</span>
				</div>';	
			echo '<h1 class="text-muted text-uppercase" id="title_ip">';
			echo $ip["title"].'<br>'; 
				if ($ip["offer"]==0) {
					if ($ip["new"]!=0) {
						echo '<small><span class="badge badge-warning">nuevo</span></small>';			
					}
				}else{
					echo '<small><span class="badge badge-warning text-uppercase">'.$ip["offer_discount"].'% off</span>';
					if ($ip["new"]!=0) {
					echo '	<span class="badge badge-warning">nuevo</span>'; 
					}
					echo'</small>';
				}

			echo '</h1>';
			$jdet=json_decode($ip["details"], true);
				$ex= explode(':', $ip["details"]);

				$aex=array();
				$new=array();
				$as;

				if ($ip["price"]==0) {
					echo '<h2 id="ip_price" class="text-muted">'.$_block1.'</h2>';
					 
				}else{
					if ($ip["offer"]==0) {
					echo '<h2 id="ip_price" class="text-muted">'.$_currency.$ip["price"].'</h2>';		  
					}else{
						echo '<h2 class="text-muted">
						<span>
						<strong class="offer">'.$_currency.$ip["price"].'</strong>
						</span>'.$_currency.$ip["offer_price"].' </h2>';
					}	 	
				}


				foreach ($ex as $key => $value) { 
					$st= explode("]", $value);
					array_push($aex, $st);
				}
				for ($i=0; $i < count($aex); $i++) { 
				  	for ($j=0; $j <count($aex[$i]); $j++) { 
				  		 if(!str_contains($aex[$i][$j], "[")&&!str_contains($aex[$i][$j], "]")&&!str_contains($aex[$i][$j], "null")){

				  		 	array_push($new, $aex[$i][$j]);
				  		 }
				  	}
				}
				$fn=array();
				foreach ($new as $key => $value) {
  					$as=trim($value, '"/{/}/]/[/,') ;
  					array_push($fn, $as);
  				}

  				echo '<figure  class="zoom">
					<img src="">
				</figure>	 
				<div style="text-align: center;">
					<img id="img_payments" class="img-fluid" src="'.$_admin.'view\img/download.png">
				</div>

				<hr class="hrddr">
			<div class="row" id="div_buy_lg">';	
			$buy=""; if ($ip["price"]==0) { $buy= $_askfornow; }else{	$buy= $_buynow;	}
			echo'	<div class="col-md-6">
					<button class="btn btn-block btn-lg back_color btn_ip">
						'. $buy.'
					</button>
				</div>';
			$buy=""; if ($ip["price"]!=0) { 
				 	echo '<div class="col-md-6">
							<button class="btn btn-block btn-lg  btn_ip"  style="border: #eee 1px solid;">'.$_addtocart.'
								 <i class="fa fa-shopping-cart"></i>
							</button>
						 </div>';
					 }
			echo '</div>
				<hr id="hrbottom">
			 	</div>
			<div class="col-12 row" id="div_buy_md">
				<hr id="hrbmd">';
			$buy=""; if ($ip["price"]==0) { $buy= $_askfornow; }else{	$buy= $_buynow;	} 
			echo '<div class="col-md-6">
					<button class="btn btn-block btn-lg back_color btn_ip">';
			echo $buy;
			echo '</button>
				</div>';
				$buy=""; if ($ip["price"]!=0) { 
				 	echo '<div class="col-md-6">
							<button class="btn btn-block btn-lg  btn_ip" id="btn_ipc" style="border: #eee 1px solid;">'.$_addtocart.'
								 <i class="fa fa-shopping-cart"></i>
							</button>
						 </div>';
					 	}
			echo '<hr id="hrb2md">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-12" >
			 		<div class="form-group">';
			 			if ($ip["details"]) {
			 	  			if ($ip["type"]==$_fisico) {
			 	  		 		echo '<div class="card bg-light text-dark " style="align-items: center;"> <ul style="display: inline-flex;">';
			 	 		 		foreach ($fn as $key => $value) {
			 	 		 			if (!str_contains($value, "arca")) {
			 	 		 				 echo '<li style="display:inline;"><br><label class="text-muted">'.$value.'</label><select class="form-control select_detail" id="select_'.$value.'">';

			 	 		 				 foreach ($jdet[$value]  as $key => $value1) {
			 	 		 				 	echo '<option value="ipdetail_'.$value.'_'.$value1.'">'.$value1;
			 	 		 				 }			 	 		 				 
			 	 		 			}

 						 			echo '</select> </li>';$i++;
 								}
								echo '</ul>';
							}else{

								echo '<div>
			 		 					<ul class=" card bg-light text-dark">';
			 		 					$arrt=array();

			 		 					$tr=explode(',', $ip["details"]);
			 		 					
			 		 					foreach ($tr as $key => $value) {
			 		 						$c='"';
			 		 						$ty=trim($value, '{/"/');
			 		 						array_push($arrt, $ty);

			 		 					}//var_dump($arrt);
			 		 					 $titles=array();$des=array();
			 		 					foreach ($arrt as $key => $value) {
			 		 						  $ui=explode(':', $value);

			 		 						  array_push($titles, $ui[0]);
			 		 						  array_push($des, $ui[1]);

			 		 						  $ui=null;
			 		 					} 
			 		 					for ($i=0; $i <count($titles) ; $i++) { 
			 		 						$title = preg_replace('([^A-Za-z0-9ñÑúÚóÓáÁéÉíÍ])', ' ', $titles[$i]);
			 		 						$de = preg_replace('([^A-Za-z0-9ñÑúÚóÓáÁéÉíÍ])', ' ', $des[$i]);
			 		 									 		 						
			 		 						echo  '<li> <label class="text-muted"><i class="fa fa-check"></i><strong>'.$title.'</strong>: '.$de.'</label></li>';
			 		 					}

 						 			 
 							

			 		 					 
			 		 			echo	'</ul>
			 					 	</div>';
							}
						}
						if ($ip["type"]!=$_virtual) {
							echo "</div> ";
						}


			 	echo '</div>
			 	</div>
			 	<div class="col-lg-8 col-md-8 col-12 card">';
			 		if ($ip["description"]) {
					echo '<p id="p_desc" tt="'.$ip["type"].'" class="text-justify">'.$ip["description"].'</p>';
				} 		 			
			 	echo '</div>';		 				  
		}

?>



			<!--====  info p row  ====-->
		
		</div>
		<br>

		<!--==================================
		=            commentarios            =
		===================================-->
		
		<div class="row">
			<div class="col-12">
				<ul class="nav nav-tabs">
				  <li class="nav-item active">
				    <a class="nav-link active text-uppercase" data-toggle="tab" href="#home"><?php echo $_comments; ?> </a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" data-toggle="tab" href="#menu1"><?php echo $_see_more; ?> </a>
				  </li>
				  <li class="nav-item ">
				    <a class="nav-link text-muted disabled" data-toggle="tab"><?php echo $_calification; ?> | 

						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star-half-o text-success"></i>
						<i class="fa fa-star-o text-success"></i>

				    </a>
				  </li>
				</ul>
			</div>


			  	<!--===========================
			  	=            tabs            =
			  	============================-->	

			<div class="tab-content col-12">
				<div class="tab-pane container active container-fluid " id="home">
					<div class="row">
												<!-- comm 2-->	  	
					<div class="card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
												<!-- comm 2-->	  	
					<div class="card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
												<!-- comm 2-->	  	
					<div class="card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
												<!-- comm 2-->	  	
					<div class="card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="tab-pane container fade" id="menu1">
<!--===============================
=            modal ver            =
================================-->

<style type="text/css">
#global {
	height: 300px;
	
	border: 1px solid #ddd;
	background: #f1f1f1;
	overflow-y: scroll;
}
#mensajes {
	height: auto;
}
.texto {
	padding:4px;
	background:#fff;
}
</style>
<div id="global" class="container-fluid">
  <div id="mensajes" class="row">
     
    					<div class=" texto card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
					    					<div class=" texto card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
					    					<div class=" texto card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
					    					<div class=" texto card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
					    					<div class=" texto card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
					    					<div class=" texto card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
					    					<div class=" texto card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
					    					<div class=" texto card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
					    					<div class=" texto card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
					    					<div class=" texto card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
					    					<div class=" texto card-group col-md-3 col-sm-6 col-12">
						<div class="card">
							<div class="card-header text-uppercase">
								Ale
								<span class="text-right">
									<?php echo '<img class="rounded-circle float-right" src="'.$_admin.'/view\img\user\default/anonymous.png" width="20%">';?>
								</span>
							</div>
							<div class="card-body"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit.</span></div>
							<div class="card-footer">
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star text-success"></i>
								<i class="fa fa-star-half-o text-success"></i>
								<i class="fa fa-star-o text-success"></i>
							</div>
						</div>
					</div>
 				 </div>
			</div>


<!--====  End of modal ver  ====-->

				</div>
			</div>

			<!--====  End of tab 1  ====-->
		</div>
		<!--====  =================      ====-->	
		

		



	</div>
</div>	
<!--======================================
=            art relacionados            =
=======================================-->

<?php 		echo'	<div class="container-fluid div_p">
			<div >
				<div class="row ">
					<div class="card bg-light col-sm-12 featured_title row" style="margin-top: 1em;">			
						<div class="col-md-6 ">
							<h1><small> '.$_relatedp .'</small></h1>	
						</div>
 				<div class="col-md-6 ">';
$d1="id";
$d2=$ip["subcategory_id"];
$d0="subcategory";
$data=Menu_c::c_show_menu_s($d0, $d1, $d2);
echo '
							<a href="'.$_site.$data[0]["url"].'">

								<button class="btn btn-dark back_color float-right">'.$_see_more.'<span class="fa fa-chevron-right"></span>
								</button>
							</a>';?>	
						</div>
					</div>



					<div class="clearfix"></div>
						<hr>
				</div> 
				
		 
		 <?php 
$option="";
$mode="Rand()";
$item="subcategory_id";
$value=$ip["subcategory_id"];
$base=0;
$max=12;	 	 
$related=Product_c::c_read($option, $mode, $item, $value, $base, $max);
 
if (!$related) {
	echo  '<div class="col-12 error404">
		  	<h1><small>'.$_oops.'</small></h1>
		  	<h2>' .$_norelated.'</h2>
		  </div>';
}else{

echo '<ul class="grid0 scrollmenu"> ';

 

 	foreach ($related as $key => $value) {
 		 echo '<li  style="width:25%;"class="">
				<figure>
					<a href="'.$_site.$value["url"].'/'.$value["id"].'"  class="pixel_p">
						<img src="'.$_admin.$value["front"].'" class="img-fluid">
					</a>
				</figure>
				<h4>
					<small>';

			echo '		
 					<a href="'.$_site.$value["url"].'/'.$value["id"].'"  class="pixel_p">
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



echo            '<a href="'.$_site.$value["url"].'/'.$value["id"].'"  class="pixel_p">
								  		<button type="button" class="btn btn-default btn-xs"   data-toggle="tooltip" title="Ver producto">

							  		<i class="fa fa-eye" aria-hidden="true"></i>

							  		</button>
							</button>
						</a>
					</div>
				</div>				
			</li>';
	
 	}}

		  ?>  
 	</div>
 		
 	</div>


<!--====  End of art relacionados  ====-->
<style>
.scrollmenu {

  overflow: auto;
  white-space: nowrap;
}

.scrollmenu li {
  display: inline-block;
  color: white;
  text-align: center;
  text-decoration: none;
}

.scrollmenu a:hover {
  background-color: #777;
}
</style>
 