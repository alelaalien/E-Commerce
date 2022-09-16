<?php include "../config/config.php";

 ?>

<!--============================
=            Main           =
=============================-->
<div class="container-fluid top_bar" id="div_top">
	<div class="container">
		<div class="row">
<!--====  social media  ====-->
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">
				<ul>
					<?php 
						$social=Template_C::c_style_template();
					 
						 $json_sm=json_decode($social["social_m"], true);
foreach ($json_sm as $key => $value) {
	echo '<li><a href="'.$value["url"].'" target="_blank">
			<i class="fa '.$value["red"].' social_media '.$value["estilo"].'" aria-hidden="true"></i></a></li>';
}

					 ?>
				</ul>
			</div>
				 <div class="col-lg-9 col-md-9 col-sm-4 col-xs-12">
   
   				 </div>
<!--====  register  ====-->
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 " id="register">
				<ul>
					<li><a class="log_color" href="#m_login" data-toggle="modal"><?php echo $_login; ?></a></li>|
					<li><a class="log_color" href="#m_singup" data-toggle="modal"><?php echo $_singup; ?></a></li>
				</ul>
				
			</div>

		</div>		
	</div>
</div>
