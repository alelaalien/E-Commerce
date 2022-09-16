<?php 

use SMTPValidateEmail\Validator as SmtpEmailValidator;
if (isset($_SESSION["data"])) {
	$data=$_SESSION["data"];

	 
	$exists=Functions::email_validator($data["user_r_e"]);

if( $exists[$data["user_r_e"]]){
	$r=User_c::c_register($data);
	 echo '<script type="text/javascript">history.back(0);					
						</script>';
}else{
echo '<script type="text/javascript">swal({
						  title: "Error:",
						  text: "La dirección de correo electrónico ingresada no se pudo validar. Recuerda usar Gmail y revisar que esté correctamente escrito tu correo electrónico.",
						  icon: "error",
						}).then((value) => {history.back(0)});					
						</script>';

}
unset($_SESSION["data"]);
}

if (isset($_SESSION["request"])) {
	 if (isset($_SESSION["act_url"])) {
	 	$active_url=$_SESSION["act_url"];
	 }else{
	 	$active_url=$_site;
	 }
 $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
   
    if (preg_match($regex, $_SESSION["request"])){
    	 
        function new_code($lenght){
            $key="";
            $pattern="0123456789";
            $max= strlen($pattern)-1;
            for ($i=0; $i <$lenght ; $i++) { 
                 $key .=$pattern[rand(0, $max - 1)];         
            } 
            return $key;
            }
            $np= new_code(5); 
            $salt= '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';
            $cryptpass=crypt($np, $salt);
            $table="user";
            $mail=$_SESSION["request"];
            $item="email";
            $r=User_c::c_read( $item, $mail,2);
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
                                    "title"=> "Solicitud de reestablecimiento de contraseña",
                                    "url"=> $active_url,
                                    "code"=> $np,
                                    "typeof"=> "resetpass",
                                    "do"=> "Ir a la tienda");
                    $sent=Functions::mail_service($datapass);

                    if ($sent=="ok") {
                     
                     unset($_SESSION["request"]);
                     $_SESSION["new_code"]="new_code";
                     $_SESSION["new_code_mail"]=$mail;
						echo '<script>swal({
						   title: "¡Hecho!",
						   text: "Hemos enviado un código a '.$mail.' para que puedas reestablecer la contraseña de tu cuenta. Recuerda revisar la carpeta de  span.",
						   icon: "success",
						 });

						 window.location="'.$active_url.'";

						 </script>';
                         
                   
                    }else{
                     echo '<script>swal({
                      title: "Error:",
                      text: "Ha ocurrido un error, por favor vuelve a intentarlo o contacta a un administrador.",
                      icon: "error",
                    });</script>';
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

        }else{
        	echo'  <script type="text/javascript">swal({
                           title: "Error",
                           text: "Corre electrónico mal ingresado.",
                           icon: "error",
                        });</script>';
        }
       unset($_SESSION["request"]);   
    }

 



//if (isset($_SESSION["new_code"])) {
	echo '<div class="container-fluid">
	<div class="row">
		<div class="col-12 text-center text-muted text-uppercase">
			<h1 style="font-size:32px;">'.$_resetnewcode.'</h1>
		</div>
		<div class="col-3">
			<div style="border: 1px solid #c0c0c0;    height: 456px; ">
				
			</div>
			
		</div>
		<div class="col-6 mdform">
			<hr>
			<form>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon irl">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
					<input required type="number"  class="form-control"  id="inc" placeholder="'.$_entercode.'">
				</div>
				<span style="display: none;" id="alert_nc" class="fa fa-warning text-muted"></span>
			</div>
			<div class="form-group">
    			<div class="input-group first_p" >
    				<span class="input-group-addon irl">
    					<i class="fa fa-key"></i>
    				</span>
    				<input required autocomplete="new-password" type="password" class="form-control" name="user_nc_p" id="user_nc_p" placeholder="'.$_pass.'" >
     				<span class="input-group-addon irr"  onclick="showpass(0)">
    					<i class="fa fa-eye" id="epr"></i>
    				</span>           				
    			</div>
    			<span style="display: none;" id="alert_nc_p" class="fa fa-warning text-muted"></span>
    		</div> 
    		<div class="form-group">
    			<div class="input-group first_p" >
    				<span class="input-group-addon irl">
    					<i class="fa fa-key"></i>
    				</span>
    				<input     type="password" class="form-control" name="user_nc_pp" id="user_nc_pp" placeholder="'.$_rpass.'" >
     				<span class="input-group-addon irr" onclick="showpass(1)" id="sprr">
    					<i class="fa fa-eye"  ></i>
    				</span>           				
    			</div>
    			<span style="display: none;" id="alert_nc_pp" class="fa fa-warning text-muted"></span>
    		</div>
    		<hr>
    		<input required type="button" value="Aceptar" class="btn btn-block back_color"   id="btn_nc" style="width: 100%">
    		<hr>
			</form>
			<hr>
		</div>
		<div class="col-3">
			<div style="border: 1px solid #c0c0c0;     height: 456px; ">
				
			</div>
			
		</div>
	</div>
</div>';
//}

/*=============================================
=            Section comment block            =
=============================================*/
 
 

/*=====  End of Section comment block  ======*/

?>

