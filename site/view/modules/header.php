<?php 
						$social=Template_C::c_style_template();
					 

 ?>

<!--============================
=            header            =
=============================-->
<header class="container">
	<div class="" id="cis">
		<div class="row" id="div_header">


<!--==========================
=            categories b        =
===========================-->
<!-- btn -->	
			<div class="col-lg-3 col-md-3 col-sm-12 back_color" id="div_btncategories">
				<p><?php echo $_categories; ?> 
					<span class="pull-right">
						<i class="fa fa-bars"></i>
					</span>
				</p>
			</div>		
			<!-- search -->
			<div class="col-lg-6 col-md-6 col-sm-9 input-group " id="div_search" class="form-control">
				  <div class="input-group" id="igs">
    <input type="text" class="form-control" placeholder="Search">
    <div class="input-group-append"><a href="<?php echo $_site?>search/1/menor-precio">
      								<button class="btn btn-default back_color" type="submit">
									<i class="fa fa-search"></i>
								</button></a>
     </div>
  </div>
 
			</div>				 
<!--==========================
=            cart            =
===========================-->
			<div class="col-sm-3" id="div_cart">
 						<ul>
 							<li>
 								<a href="">
							<button>
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
							</button>
						</a>
 							</li>
 							<li>
 												<!--	<p>-->
							<?php echo $_basket; ?>
							<span class="basket_amount"></span>
							<br><?php echo $_currency; ?>
							<span class="basket_sum"></span>
						<!--</p>	-->
 							</li>
 						</ul>
						

 
			</div>
		</div>

		<!--==========================
=            categories list  <div class="">          =
===========================-->
		<div class="row back_color" id="div_categories">
 					
 					<?php 

$r=Menu_c::c_show_menu($_category, null, null);
 

foreach ($r as $key => $category) {
 

echo  

	'<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<h4 class="h4cattitles">
						<a href="'.$_site.$category["url"].'" class="pixel_categories">'.$category["name"].'</a>
					</h4>
					<hr>
					<ul>';
					$r2=Menu_c::c_show_menu($_subcategory ,"category_id", $category["id"]);
					foreach ($r2 as $key => $sub) {
						 
						 echo '<li><a href="'.$_site.$sub["url"].'" class="pixel_sub">'.$sub["name"].'</a></li>';



					}
					echo '
						
						 
					</ul>					
				</div>';}
 
 ?>
			
		</div>
	</div>	
<!--====  End of categories list  ====-->
</header>



<!--====  End of header  ====-->

