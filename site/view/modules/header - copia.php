<?php 
						$social=Template_C::c_style_template();
					 

 ?>

<!--============================
=            header            =
=============================-->
<header class="container-fluid">
	<div class="container" id="cis">
		<div class="row" id="div_header">
 <!--==========================
=            logo            =
===========================-->
			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logo">
				<a href="#">
					<img src="<?php echo $_admin.$social['logo']?>" class="img-fluid">
				</a>					
			</div>
<!--==========================
=            categories b        =
===========================-->
<!-- btn -->	
			<div class="col-lg-2 col-md-2 col-sm-8 col-xs-12 back_color" id="div_btncategories">
				<p><?php echo $_categories; ?> 
					<span class="pull-right">
						<i class="fa fa-bars"></i>
					</span>
				</p>
			</div>		
			<!-- search -->
			<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12 input-group " id="div_search" class="form-control">
				  <div class="input-group" id="igs">
    <input type="text" class="form-control" placeholder="Search">
    <div class="input-group-append">
      								<button class="btn btn-default back_color" type="submit">
									<i class="fa fa-search"></i>
								</button>
     </div>
  </div>
 
			</div>				 
<!--==========================
=            cart            =
===========================-->
			<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12" id="div_cart">
				<div class="container-fluid">
					<div class="row">
						<a href="">
							<button>
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
							</button>
						</a>
						<p><?php echo $_basket; ?>
							<span class="basket_amount"></span>
							<br><?php echo $_currency; ?>
							<span class="basket_sum"></span>
						</p>
					</div>	
				</div>	
			</div>
		</div>

		<!--==========================
=            categories list  <div class="">          =
===========================-->
		<div class="row back_color" id="div_categories">
 					<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<h4 class="h4cattitles">
						<a href="" class="pixel_categories">Lorem ipsum</a>
					</h4>
					<hr>
					<ul>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
					</ul>					
				</div>
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<h4 class="h4cattitles">
						<a href="" class="pixel_categories">Lorem ipsum</a>
					</h4>
					<hr>
					<ul>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
					</ul>					
				</div>
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<h4 class="h4cattitles">
						<a href="" class="pixel_categories">Lorem ipsum</a>
					</h4>
					<hr>
					<ul>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
					</ul>					
				</div>
				<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<h4 class="h4cattitles">
						<a href="" class="pixel_categories">Lorem ipsum</a>
					</h4>
					<hr>
					<ul>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
					</ul>					
				</div>
								<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
					<h4 class="h4cattitles">
						<a href="" class="pixel_categories">Lorem ipsum</a>
					</h4>
					<hr>
					<ul>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
						<li><a href="" class="pixel_sub">Lorem ipsum</a></li>
					</ul>					
				</div>
			
		</div>
	</div>	
<!--====  End of categories list  ====-->
</header>



<!--====  End of header  ====-->



