 <div class="container-fluid" id="div_slide">
 	<div class="row">
 		<div class="col-sm-12">
 			<ul>

<?php 

$slide=Slide_c::c_slide_config();



foreach ($slide as $key => $value) {
 $i=1;
$txt_style=json_decode($value["txt_style"], true);
$title1=json_decode($value["title1"], true);
$title2=json_decode($value["title2"], true);
$title3=json_decode($value["title3"], true);
$img_style=json_decode($value["img_style"], true);
echo '
 

				<li><img src="'.$_admin.$value["background"].'" alt="background">
 					<div class="slide_option slide_option'.$i.'">
 					'; if ($value["img"]!="") {
 						echo '<img src="'.$_admin.$value["img"].'" class="img_prod" style="top:'.$img_style["top"].';/* right:'.$img_style["right"].'; left:'.$img_style["left"].'; widht:'.$img_style["width"].';*/">';
 					}
 						echo '
 						<div class="txt_slide" style="top:'.$txt_style["top"].'; right:'.$txt_style["right"].'; width:'.$txt_style["width"].'; left:'.$txt_style["left"].'">
 							<h1 style="color:'.$title1["color"].';" >'.$title1["txt"].'</h1>
 							<h2 style="color:'.$title2["color"].';">'.$title2["txt"].'</h2>
 							<h3 style="color:'.$title3["color"].';">'.$title3["txt"].'</h3>
 							<a href="">
 								'.$value["button"].'
 							</a>
 							
 						</div>
 						
 					</div>
 				</li> ';
 				$i++;
 			}
 ?>



 			</ul>

 			<ol id="pagination">
 				<?php 

		 			for ($i=1; $i <=count($slide) ; $i++) { 
		 				echo '<li item="'.$i.'"><span class="fa fa-circle"></span></li>';
		 			}

 				 ?>
 			</ol>

		<div class="arrows" id="go_back"><span class="fa fa-chevron-left"></span></div>
		<div class="arrows" id="go_forward"><span class="fa fa-chevron-right"></span></div>



 		</div>
 	</div>
 	
 </div>
 <center>
	
	<button id="btn_slide" class="back_color">
		
			<i class="fa fa-angle-up"></i>

	</button>

</center>