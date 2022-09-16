<?php 
use SMTPValidateEmail\Validator as SmtpEmailValidator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once "functions.php";
require_once "verifyemail.php";
$_site="http://localhost/proyectos/eccomerce/site/";
$_admin="http://localhost/proyectos/eccomerce/admin/";


class User_c{

	static public function c_ressetpass($data){

/*    	$_site="http://localhost/proyectos/eccomerce/site/";
		$response=0;
	 	$regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";

	 	if (isset($_POST["resset_pass"])) {$validator = new SmtpEmailValidator($_POST["resset_pass"], 'mtest_alez@hotmail.com');
	 		if (preg_match($regex, $_POST["resset_pass"])){
	 			//abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ
	 			
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
	 			$mail=$_POST["resset_pass"];
	 			$item="email";
	 			$r=User_m::m_read($table, $item, $mail,2);
	 			if ($r) {
	 				$id=$r["id"];
	 				$item2="re_pass";
	 				 $r2=User_m::m_update($table,$id,$item2, $cryptpass);
	 			session_start();
	 				if ($r2=="ok") {
	 					$_SESSION["request"]="VxdGPa12J4";
	 					$_SESSION["mailto"]=$mail;
	 					return $r;
	 				} else{
	 					$_SESSION["request"]="Dlv45D5cv";
	 					return "error";
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
	 	} */

	}
	static public function c_register($data){
 
		$_admin="http://localhost/proyectos/eccomerce/admin/";
		$_site="http://localhost/proyectos/eccomerce/site/";
		$_checkemail="Por favor revise su bandeja de entrada o carpeta de correo no deseado para verificar su cuenta.";
		$_success="¡Hecho!";
		$regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
		if ($data["user_r_e"]) {


			
			if (preg_match($regex, $data["user_r_e"])&&preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+$/", $data["user_r_n"])&&preg_match('/^[a-zA-Z0-9]+$/', $data["user_r_p"])){

				$salt= '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';
		 		$crypt= crypt($data["user_r_p"], $salt);
		 		$cript_email=md5($data["user_r_e"]);


				$datan=array("email"=>$data["user_r_e"],
							"name"=>$data["user_r_n"],
							"pass"=>$crypt,
							"login"=>"direct",
							"verification"=>1,
							"c_email"=>$cript_email);
				$table="user";
				$r=User_m::m_register($table, $datan);
				
				if ($r=="done"){
					$datas = array("address"=> $data["user_r_e"],
									"nameto"=> $data["user_r_n"],
									"subjet"=> "Probando c:",
									"logo"=>"l",
									"icon"=> "l",
									"txt"=> "Para finalizar el registro, debe confirmar su dirección de correo electrónico",
									"txt2"=> "Si no se ha registrado en esta pagina, puede ignorar este correo electrónico y la cuenta se eliminará.",
									"title"=> "VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO",
									"url"=> $_site,
									"code"=> $cript_email,
									"typeof"=> "verification",
									"do"=> "Verificar");

					
 				 $smail=Functions::mail_service($datas);
				if ($smail=="ok" ) {
					/**/



				echo '<script>var site="http://localhost/proyectos/eccomerce/site/";
				swal({
                      title:"'.$_success.'",
                      text: "'.$_checkemail.'",
                      icon: "success",
                     
					                    }).then((value) => {
					   window.location.href=site;
					}); </script>';  
				
			return $r;

				}else{
				echo ' 
				swal({
                      title:"Error al registrar",
                      text: "Intenta nuevamente o prueba ingresando otro correo electronico.",
                      icon: "error" })</script>'; 

				}

				
		 		} 
				
			 }else{
			 	echo '<script>swal({
					  title: "Error:",
					  text: "No se permiten caracteres especiales.",
					  icon: "error",
					});</script>';
			} 			
		}
	}
	static public function c_read($item, $value, $option){
		$table="user";
		$r=User_m::m_read($table, $item, $value, $option);
		return $r;
	}
	static public function c_update($id, $item, $value){
		$table="user";
		$r=User_m::m_update($table, $id, $item, $value);
		return $r;
	}
	static public function c_session($r){
		$table="user";
		$r=User_m::m_read($table, "email", $r["email"], 2);
		 if ($r) {
		 	session_start();
		 	 $_SESSION['email']=$r['email'];
		 	 	$_SESSION['name']=$r['name'];
		 	 	$_SESSION['pic']=$r['pic'];
		 	 	$_SESSION['id']=$r['id'];
		 	 	$_SESSION['sverificated']='ok';
		 	 	$_SESSION['mode']=$r['login'];	
		 }
 		return "ok";
	
	}
	static public function validator($data){
		$r=Functions::smtp_validate($data);
		return $r;
	}

//mtest_alez@hotmail.com
}
