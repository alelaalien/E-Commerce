<?php include "../config/config.php";
/*  use SMTPValidateEmail\Validator as SmtpEmailValidator;     $social=Template_C::c_style_template();  
$rutasTop=array();
$ruta=null;
  function email_validator($data){
                $email     = $data;
                $sender    = 'mtest_alez@hotmail.com';
                $validator = new SmtpEmailValidator($email, $sender);

                // If debug mode is turned on, logged data is printed as it happens:
           //  $validator->debug = true;
                $results   = $validator->validate();

              

                // Get log data (log data is always collected)
               $log = $validator->getLog();
             
                return $results;
    }
    // $a= email_validator("camilowrz@outlook.com") ;

    //  var_dump($a["camilowrz@outlook.com"]);
if (isset($_GET["url"])) {

    $rutasTop=explode("/", $_GET["url"]);
}else{
    $rutasTop="";
}
$active_url=$_site;//.$_GET["url"];
 if (isset( $_SESSION["sent"])) {
   
 
if ($_SESSION["sent"]=="ok") {
    echo'  <script type="text/javascript">swal({
                           title: "¡Hecho!",
                           text: "Hemos enviado un còdigo a '.$mail.' para que puedas reestablecer la contraseña de tu cuenta. Recuerda revisar la carpeta de span.",
                           icon: "success",
                         });</script>';

}else if ($_SESSION["sent"]=="no") {
    echo'  <script type="text/javascript">swal({
      title: "Error:'.$sent.'",
      text: "No se ha podido completar la operación. Por favor, vuelve a intentarlo o ponte en contacto con un administrador",
      icon: "error",
    });</script>';
}}
unset($_SESSION["sent"]);
if (isset($_SESSION["request"])&&isset($_SESSION["mailto"])) {
    if ($_SESSION["request"]=="VxdGPa12J4"&&$_SESSION["mailto"]) {
       
   $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
   
    if (preg_match($regex, $_SESSION["mailto"])){
        function new_pass($lenght){
            $key="";
            $pattern="0123456789";
            $max= strlen($pattern)-1;
            for ($i=0; $i <$lenght ; $i++) { 
                 $key .=$pattern[rand(0, $max - 1)];         
            } 
            return $key;
            }
            $np= new_pass(5); 
            $salt= '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';
            $cryptpass=crypt($np, $salt);
            $table="user";
            $mail=$_SESSION["mailto"];
            $item="email";
            $r=User_c::c_read( $item, $mail,1);
            if ($r) {
                $id=$r["id"];
                $item2="re_pass";
                $r2=User_c::c_update($id,$item2, $cryptpass);
                if ($r2=="ok") {
                    $datapass = array("address"=> $mail,
                                    "nameto"=> $r["name"],
                                    "subjet"=> "Nueva contraseña",
                                    "logo"=>"l",
                                    "icon"=> "l",
                                    "txt"=> 'Para mantener tu cuenta segura te recomendamos establecer una nueva contraseña. Puedes hacerlo ingresando a tu perfil en la opción "cambiar contraseña" una vez hayas ingresado a tu cuenta.',
                                    "txt2"=> "l",
                                    "title"=> "Solicitud de nueva contraseña",
                                    "url"=> $active_url,
                                    "code"=> $np,
                                    "typeof"=> "resetpass",
                                    "do"=> "Ir a la tienda");
                    $sent=Functions::mail_service($datapass);

                    if ($sent=="ok") {
                      $_SESSION["sent"]="yes";
                      unset($_SESSION["request"]);
                        
                   
                    }else{
                    $_SESSION["sent"]="no";unset($_SESSION["request"]);
                    }    

                }

            }else{
                echo '<script>swal({
                      title: "Error:",
                      text: "La dirección de correo electrónico ingresada no se encuentra registrada.",
                      icon: "error",
                    });</script>';
                    return "nouser";        
                }

        }
    }elseif ($_SESSION["request"]=="Dlv45D5cv") {
       echo'  <script type="text/javascript">swal({
                           title: "Error",
                           text: "Ha ocurrido un error. Por favor, vuelve a intentarlo.",
                           icon: "error",
                        });</script>';
    }
   unset($_SESSION["request"]);
   unset($_SESSION["mailto"]); 
} */

?>
<!--============================
=            Main           =
=============================-->

<div class="container-fluid top_bar" id="div_top">
	<div class="container">
		<div class="row">
<!--====  social media  ====-->
			<div class="col-lg-3 col-md-3 col-sm-12 social">
				<ul id="usm">
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
             <!--==========================
=            logo            =
===========================-->
 
            <div class="col-lg-5 col-md-5 col-sm-12" id="logo" style="text-align: center;">
                <figure style="    overflow: hidden;">
                    <a href="<?php echo $_site?>">
                        <img src="<?php echo $_admin.$social['logo']?>" class="img-fluid">
                    </a>    
                </figure>               
            </div>  
<!--====  register  ====-->
			<div class="col-lg-3 col-md-3 col-sm-12" id="register" style="text-align: end;">
				<ul id="ulr">
                    <?php                
                    if (isset($_SESSION["sverificated"])) {
                        if ( $_SESSION["sverificated"]=="ok") {
                             if ($_SESSION["mode"]=="direct") {
                                  
                             
                                if ($_SESSION["pic"]!="") {
                                  echo '<li><img class="rounded" width="10%" src="'.$_admin.$_SESSION["pic"].'"></li>';
                                }else{
                                    echo '<li><img class="rounded" width="10%" src="'.$_admin.'view\img\user\default/anonymous.png"></li>';
                                }
                             }echo '<li> | </li>
                            <li><a href="'.$_site.'profile/">'.$_seeprofile.'</a></li>
                            <li> | </li>
                            <li><a href="'.$_site.'logout/">'.$_logout.'</a></li>';
                        }
                    }else{
                     echo '<li><a class="log_color" id="m_l" data-target="#m_login"  data-toggle="modal">'. $_login.'</a></li>|
                    <li><a class="log_color"  id="m_r" data-target="#m_singup" data-toggle="modal">'. $_singup.'</a></li>';   
                    }
                        
                     ?>


					
				</ul>
				
			</div>

		</div>		
	</div>
</div>
<!--==========================
=            user login           =
===========================-->

<div class="container">
 
  <div class="modal fade mdform" role="dialog" id="m_login">
    <div class="modal-dialog modal-content">
     
        <div class="modal-body md_title">
        	<h3 class="back_color"><?php echo $_login; ?></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="container">
                <div class="row">
                  <div class="col-md-6 col-12 facebook" id="btn_f_l">
                <p style="margin: 10px 0px 10px 0px;">
                    <i class="fa fa-facebook"></i><?php echo $_flogin; ?>
                </p>                    
            </div>          
        
        <div class="col-md-6 col-12 facebook" id="btn_g_l">
                <p style="margin: 10px 0px 10px 0px;">
                    <i class="fa fa-facebook"></i><?php echo $_glogin; ?>
                </p>                    
            </div> 
            <div class="col-12">
                <form method="POST" id="form_l"> 
                    <!--=======================
                    =                         =
                    ========================-->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon irl">
                                <i class="fa fa-envelope"></i>
                            </span>
                             <input autocomplete="email" type="email" class="form-control" name="user_l_e" id="user_l_e" placeholder="<?php echo $_email;?>" required><!-- -->


                        </div>
                        <span style="display: none;" id="alert_l_e" class="fa fa-warning text-muted"></span>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon irl">
                                <i class="fa fa-key"></i>
                            </span>
                            <input autocomplete="new-password" type="password" class="form-control" name="user_l_p" id="user_l_p" placeholder="<?php echo $_pass;?>" required>
                            <span class="input-group-addon irr"  onclick="showpass(0)">
                                <i class="fa fa-eye" id="epl"></i>
                            </span>                         
                        </div>
                        <div>
                          <span style="display: none;" id="alert_l_p" class="fa fa-warning text-muted"></span>  
                          <div id="fpass" class="float-right" style="/*display:none;*/ text-align: center; font-size: 12px; margin: 7px 0 7px 0"><a href="#m_fp" data-dismiss="modal" data-toggle="modal" ><?php echo $_forgotpass ?></a></div>
                        </div>
                        
                    </div>
                    
                    <input type="button" class="btn btn-block back_color btn_direct" value="<?php echo $_accept; ?>" onclick="" style="width: 100%">

                    
                    <!--====  End of    ====-->
                    
                </form>
            </div> 
                </div>

            </div>
        </div>
 

   
        <div class="modal-footer">
            <?php echo $_notaccountyet;?> |  <strong><a href="#m_singup" data-dismiss="modal" data-toggle="modal" ><?php echo $_register ?></a></strong>        </div>
        
     
    </div>
  </div>
  
</div>
<!--==========================2664931046
=            user register           =
===========================-->

<div class="container">

  <div class="modal fade mdform" role="dialog" id="m_singup">
    <div class="modal-dialog modal-content">
        <div class="modal-body md_title ">
        	<h3 class="back_color"><?php echo $_singup; ?></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <div class="container" style="width: 90%;"> 
             	 <div class="row">
            	<div class="col-md-6 col-12 facebook" id="btn_f_r">
            		<p>
            			<i class="fa fa-facebook"></i><?php echo $_fregister; ?>
            		</p>            		
            	</div>

            	<div class="col-md-6 col-12 google" id="btn_g_r">
            		<p>
            			<i class="fa fa-google"></i><?php echo $_gregister; ?>
            		</p>            		
            	</div>
            	<div class="col-12">
            	<!-- action="form.php" -->
            		<!-- <form method="POST"  onsubmit="return user_register()"> -->
            		<hr>
            		<div class="form-group">
            			<div class="input-group first_p" >
            				<span class="input-group-addon irl">
            					<i class="fa fa-user"></i>
            				</span>
            				<input autocomplete="username" type="text" class="form-control" name="user_r_n" id="user_r_n" placeholder="<?php echo $_fullname;?>" ><br>
            			</div>
            			<span style="display: none;" id="alert_r_n" class="fa fa-warning text-muted"></span>
            		</div>
            		<div class="form-group">
            			<div class="input-group first_p" >
            				<span class="input-group-addon irl">
            					<i class="fa fa-envelope"></i>
            				</span>
            				 <input autocomplete="email" type="email" class="form-control" name="user_r_e" id="user_r_e" placeholder="<?php echo $_email;?>" ><!-- -->
            			</div>
            			<span style="display: none;" id="alert_r_e" class="fa fa-warning text-muted"></span>
            		</div>
            		<div class="form-group">
            			<div class="input-group first_p" >
            				<span class="input-group-addon irl">
            					<i class="fa fa-key"></i>
            				</span>
            				<input autocomplete="new-password" type="password" class="form-control" name="user_r_p" id="user_r_p" placeholder="<?php echo $_pass;?>" >
             				<span class="input-group-addon irr"  onclick="showpass(0)">
            					<i class="fa fa-eye" id="epr"></i>
            				</span>           				
            			</div>
            			<span style="display: none;" id="alert_r_p" class="fa fa-warning text-muted"></span>
            		</div> 
            		<div class="form-group">
            			<div class="input-group first_p" >
            				<span class="input-group-addon irl">
            					<i class="fa fa-key"></i>
            				</span>
            				<input  autocomplete="new-password"  type="password" class="form-control" name="user_p_rr" id="user_p_rr" placeholder="<?php echo $_rpass;?>" >
             				<span class="input-group-addon irr" onclick="showpass(1)" id="sprr">
            					<i class="fa fa-eye"  ></i>
            				</span>           				
            			</div>
            			<span style="display: none;" id="alert_rr_p" class="fa fa-warning text-muted"></span>
            		</div>
            		<div class="check_box">
            			<label>
            				<input type="checkbox" id="reg_term">
            				<small>
            					<?php echo $_registerterms; ?>
            				</small>

            			</label><span style="width: auto; margin-bottom: 6px; background: grey; float: right;">Leer más</span>
            		</div><span style="display: none;" id="alert_r_t" class="fa fa-warning text-muted"></span>
            		  
            		<input type="button" value="Siguiente" class="btn btn-block back_color" onclick="cfru()" id="btn_r_1" style="width: 100%">
            	<!--  </form> -->
            </div>
            	</div> 
            </div> 	     	
        </div>
         
       
        <div class="modal-footer">
    		<?php echo $_alreadyregistered;?> |  <strong><a href="#m_login" data-dismiss="modal" data-toggle="modal" ><?php echo $_login ?></a></strong>
        </div>
        
      
    </div>
  </div>
  
</div>
  

<!--=====================================
=            forgot password            =
======================================-->
<div class="container">
 
  <div class="modal fade mdform" role="dialog" id="m_fp">
    <div class="modal-dialog modal-content">
     
        <div class="modal-body md_title">
            <h3 class="back_color"><?php echo $_changepass; ?></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="container">
                <div class="row">
            <div class="col-12" style="padding: 10px 25px 12px 25px;">
                <div class="badge-light" style="margin-top: 5px;">
                    <div ><?php echo $_resetpasstext; ?></div>
                </div>
                <form method="POST" id="form_fp"> 
                    <!--=======================
                    =                         =
                    ========================-->
                    <div class="form-group">
                        <div class="input-group" style="margin:20px 0 25px 0;">
                            <span class="input-group-addon irl">
                                <i class="fa fa-envelope"></i>
                            </span>
                             <input autocomplete="email" type="email" class="form-control" name="fp_e" id="fp_e" placeholder="<?php echo $_email;?>" required><!-- -->
                        </div>
                        <div id="darp" style="margin-top: 0;">
                            <span style="display: none;" id="alert_fp_e" class="fa fa-warning text-muted"></span>
                        </div>
                        
                    </div>
                    <div class="form-group" style="display: none;" id="fcode">
                        <div class="input-group" style="margin:20px 0 25px 0;">
                            <span class="input-group-addon irl">
                                <i class="fa fa-envelope"></i>
                            </span>
                             <input  type="text" class="form-control" name="fp_c" id="fp_c" placeholder="<?php echo $_entercode;?>" required><!-- -->
                        </div>
                        <div id="darp" style="margin-top: 0;">
                            <span style="display: none;" id="alert_fp_c" class="fa fa-warning text-muted"></span>
                        </div>
                        
                    </div>
                     
                    
                    <input type="button" class="btn btn-block back_color btn_rp" value="<?php echo $_send; ?>" onclick="" style="width: 100%; margin: 0 0 12px;">
                    <!--====  End of    ====-->
                    
                </form>
            </div> 
                </div>

            </div>
        </div>      
     
    </div>
  </div>
  
</div>


<!--====  End of forgot password  ====-->


<!--====  End of user  ====-->

