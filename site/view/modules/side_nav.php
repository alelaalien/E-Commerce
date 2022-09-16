<?php 
$list=array();
$s=$rutas[3];
if (isset($rutas[1])) {
  if (isset($rutas[2])) {
    if($rutas[2]!=""){
   $r2=$rutas[2];
     if ($r2=="menor-precio") {
      $mode_3="ASC";
      $order_by_3="price";
      $_SESSION["mode"] = "ASC";

     } else if ($r2=="mayor-precio")  {
      $mode_3="DESC";
      $order_by_3="price";
      $_SESSION["mode"]="DESC";
     } else if ($r2=="mayor-descuento")  {
      $mode_3="DESC";
      $order_by_3="offer_discount";
      $_SESSION["mode"]="DESC";
     } else if ($r2=="recientes")  {
      $mode_3="DESC";
      $order_by_3="id";
      $_SESSION["mode"]="DESC";
     } else{
      $mode_3="ASC";
      $order_by_3="id";
      $_SESSION["mode"]="ASC";/**/
     }
    } 
   }else{ $mode=$_SESSION["mode"];}
   
    if (is_numeric($rutas[1])) {
        $base= ($rutas[1]-1)*12; 
    } else {
        include "error404.php";
        return;
    }


   
   
}else{
  $rutas[1]=1;
  $base=0;
  $mode="DESC";
   
}

/*==================================
=            filters           =
==================================*/


$mode=$_SESSION["mode"];
$pro=Product_c::c_search_list($s, $order_by, $mode );
 if (!$pro) {
   
   return;
 }
 
function count_offer($array, $value) { 
   $c = array_count_values($array);
    return $c[$value];
}
/*===========offer ==================*/
$of=Product_c::c_offer("offer_discount", $s); 

 
if ($of) {
	foreach ($of as $key => $value) {
		if ($value["offer_discount"]!=0) {
			  array_push($list, $value["offer_discount"]);
			} 
		} 
	}

 /*===========brand ==================*/
 $brand="brand"; 
 $brands=array();

  if ($pro) {

  		$brands=Functions::nav_list($pro, $brand, $brands);
  	}
   
sort($brands);
 
 /*===========price r==================*/
 $price="price";
 $prices=array();
  if ($pro) {

  	foreach ($pro as $key => $value) {

  		if ($value[$price]!=null||$value[$price]!="") {

  			// if ($value["offer_price"]!=0||$value["offer_price"]!=null||$value["offer_price"]!="") {
  			// 	 array_push($prices, $value["offer_price"]); 
  			// }else{

  			  array_push($prices, $value[$price]);
  			//}
 		}
 	}
 }	 

 $max_b=max($prices);

 
$fl=ceil($max_b*30/100);
$sl=ceil($max_b*60/100);

$less=array();
$betw=array();
$more=array();


if ($max_b!=null&&$max_b!=0) {
	 foreach ($pro as $key => $value) {
	 	 
 		if ($value[$price]<$fl) {
 			array_push($less,$value );
 		}else if($value[$price]>=$fl&&$value[$price]<$sl){/**/
 			array_push($betw, $value);
 		}else{
 			array_push($more, $value);
 		}
	 }

}


 /*===========brand ==================*/
 $delivery="delivery"; 
 $free_d=array();
$home=array();
$spoint=array();
 
if ($pro) {
 foreach ($pro as $key => $value) {
    if ($value[$delivery]&&$value["home_delivery"]&&$value["delivery_price"]==0) {
       array_push($free_d, $value);
    }
    if ($value["home_delivery"] ) {
       array_push($home, $value);
    }else{
      array_push($spoint, $value);
    }
 }

//var_dump($home);
 
 
    
    }
/*===========offer ==================*/
/*===========offer ==================*/
/*===========offer ==================*/
/*===========offer ==================*/
/*===========offer ==================*/
	
 
?>

<div id="sidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  	<div class="container" style="    margin-top: -26px;">
  		<div id="box_d">
  			<span style="text-align: center;" class="txt_center"><h1 ><?php echo $_navsearchtitle; ?></h1></span>
  			<hr id="nav_sep">
  			<div id="ul_nav">
  				<ul>
  					<li><h2>Marcas</h2>
  						<ul>
  							<?php 


  							if (count($brands)>0) {

				   				for($i=0;$i<count($brands); $i++) {
									 $count_b=count_offer($brands, $brands[$i]);
                  if ($i==0) {
                     echo '<li><a href="'.$_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'/marca/'.$brands[$i].'"><h3>'.$brands[$i].' ('.$count_b.')</h3></a></li>';
                  }else if ($i!=0&&$brands[$i]!=$brands[($i-1)]) {
                     echo '<li><a href="'.$_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'/marca/'.$brands[$i].'"><h3>'.$brands[$i].' ('.$count_b.')</h3></a></li>';
									 	 }
 								 	}
				   		 		} 
				   				?>
  							
  						</ul>
  					</li>
  					<li><hr class="nav_hr"><h2>PRECIO</h2>
  						<ul> 
      						
                    <?php 

                    $disabled1="pointer-events: none;";
                    $disabled2="pointer-events: none;";
                    $disabled3="pointer-events: none;";


                    if (count($less)!=0) { $disabled1=""; }
                    if (count($betw)!=0) { $disabled2=""; }
                    if (count($more)!=0) { $disabled3=""; }

echo '<li><a style="'.$disabled1.'" href="'.$_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'/menos-de/'.$fl.'"><h3>Menos de '.$_currency." ".$fl." (".count($less).")".'</h3></a></li>
                  <li><a style="'.$disabled2.'" href="'. $_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'/entre/'.$fl.'/'.$sl.'"><h3>'. $_currency." ".$fl." a ".$_currency." ".$sl."(".count($betw).')</h3></a></li>
                  <li><a  style="'.$disabled3.'" href="'. $_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'/mas-de/'.$sl.'"><h3>'. $_currency." ".$sl.' o más ('.count($more).')</h3></a></li>';


                     ?>


                    
            			</ul>
            		</li>
            		<li>
            			<ul>
            				<li> 
            					<input type="number" id="minpsn" name="minpsn" placeholder="Precio mínimo" class="epc" value="">
            				</li>
            				<li><!--==== <<label for="maxpsn"><h2>Max:</h2></label> ====-->
            					<input type="number" id="maxpsn" name="maxpsn" placeholder="Precio máximo" class="epc">
            				</li>
            				<li>
                    



                   <a id="btn_pf" href="<?php echo $_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'/entre/'; ?>">
                  
                      <input id="sbps" type="button" class="btn btn-light back_color epc" value="Buscar"></a> </li>
            			</ul>					
            		</li>
            		<li><hr class="nav_hr">
            			<li><h2>descuentos</h2>
				   			<ul>
				   				<?php
	 			   				 if (count($list)>0) {
					   				 	$i=0;
					   				 do{
					   				 	$count_=count_offer($list, $list[$i]);
							   				if ($i>0&&$list[$i]==$list[($i-1)]) { }
							   				else{
							   				 	echo '<li><a href="'.$_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'/descuento/'.$list[$i].'"><h3>Desde '.$list[$i].'% OFF ('.$count_.')</h3></a></li>';

					   					 	}
										$i++;
					   				 	}while ($i<count($list) );
									}
				   				  ?>
				   			</ul>

   						</li>
   						<li><hr class="nav_hr"><ul>
                <?php 
                $fd=count($free_d);

                $style=$disabled1 ;

                if ($fd!=0) {
                   $style="cursor: pointer;";

                   echo '<li style="'.$style.'"><a  href="'.$_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'/envio-gratis" > <h2 id="sidenavh3">Envio gratis ('.$fd.')</h2> </a></li>';
                }

                 ?>
   							
   						</ul>
   						</li>
   						<li><hr class="nav_hr">
   							<h2>TIPO DE ENTREGA</h2>
   							<ul>
                  <?php 

echo '            <li><a href="'.$_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'/con-envio-a-domicilio"><h3>Envío a domicilio ('.count($home).')</h3></a></li>
   								<li><a href="'.$_site.$rutas[0].'/1/menor-precio/'.$rutas[3].'/retiro-por-sucursal"><h3>Por sucursal ('.count($spoint).')</h3></a></li>';?>
   							</ul>
   						</li>
 
            		</li>

  				</ul>
  			</div>
  		</div>
  		
  	</div>
</div>
 
<div id="main">

</div>