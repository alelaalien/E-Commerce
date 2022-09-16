			<?php 
			$verificated_e=false;
			if (isset($rutas[1])) {

				 $email=$rutas[1];
				 $item="c_email";
				 $r=User_c::c_read($item, $email, 2);
			
				if (!$r) {
				

				}else{
					 
					 $item2="verification";
					 $value=0;
					 $id=$r["id"];

					 $r2= User_c::c_update($id, $item2, $value);
					 if ($r2=="ok") {
					 	 $verificated_e=true;
					 }
				}
			}
			 ?>
<div class="container">
	<div class="row">
		<div class="col-12 text-center verification">
			<?php 

			if ($verificated_e) {
			echo '<h3>'.$_thanks.'</h3>
				<h2><small>'.$_kgoing.'</small></h2>
				<br>
				<a  data-target="#m_login"  data-toggle="modal"><button class="btn btn-default back_color btn-lg">'. $_login.'</button></a>';			
			}else{
			echo '<h3>'.$_error.'</h3>
				<h2><small>'.$_retry.'</small></h2>
				<br>
				<a  data-target="#m_singup"  data-toggle="modal"><button class="btn btn-default back_color btn-lg">'. $_singup.'</button></a>';				
			}

			 ?>




		</div>
	</div>
</div>