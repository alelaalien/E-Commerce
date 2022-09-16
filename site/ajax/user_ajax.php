<?php 

require_once "../controller/user_c.php";
require_once "../model/user_m.php";
require_once '../view/modules/mail.php';

class Ajax_user{

	public $email_exists;
	public $email;
	public $pass;
	public $code;
	public $rp;
	public $email_v;
	public $name;
	public $act_url;
 
	public function a_email_exists(){
		$data= $this->email_exists;
		$r=User_c::c_read("email", $data, 2);

		echo json_encode($r);

	}

	public function new_pass(){
		 
	
	
		$data=array("DFSncu"=> $this->email, "JxwV15"=> $this->pass, "JxV15"=> $this->code );
	}

	public function register(){
		$data=array("user_r_e"=> $this->email,"user_r_n"=> $this->name,"user_r_p"=> $this->pass);
		session_start();
		$_SESSION["data"]=$data;
		if (isset($_SESSION["data"])) {
			echo "ok";
		}else{
			echo "error";
		}
	
	}
	public function reset(){
		$task="";
		$data=$this->rp;
		$au=$this->act_url;
		$r=User_c::c_read("email", $data, 2); 
		if ($r) {
			 session_start();
			 $_SESSION["request"]=$data;
			 $_SESSION["act_url"]=$au;
			 if (isset($_SESSION["request"])) {
					$task ="ok_reset";
				}else{ $task= "error_reset";}
		}else{
			$task="nouser";
		}
		 
				
				
		
		echo $task;
		
		
	}
 
	public function a_check_login(){

		$salt= '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';
		$data = array( "email"=>$this->email,

				"pass"=>$this->pass); 
		$regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
		if (!preg_match($regex, $data["email"])||!preg_match('/^[a-zA-Z0-9]+$/', $data["pass"])){
			echo "not_allowed";
		}else{
			$crypt=crypt($data["pass"], $salt);
			$r=User_c::c_read("email", $data["email"], 1);
			if ($r) {
				 if ($r["email"]==$data["email"]&&$crypt!=$r["pass"]) {
				 	echo "wrong_pass";
				 }else if($r["email"]==$data["email"]&&$crypt==$r["pass"]){
				 	if ($r["verification"]==1) {
				 		echo "1";
				 	}else{
				 		$cs=User_c::c_session($r);	
				 		
				 		echo $cs;	
				 	}
				 }
			}else{
				echo "error";
			}
		}
	}
 public function email_validator(){

				 
				$data = $this->email_v;
				session_start();
				$_SESSION["email_v"]=$data;
				if (isset($_SESSION["email_v"])) {
					echo "ok";
				}else{ echo "error";}
 
	 }/*	*/

}

if (isset($_POST["email_exists"])) {
	
	$val_e= new Ajax_user();
	$val_e->email_exists=$_POST["email_exists"];

	$val_e->a_email_exists();
}
if (isset($_POST["email"])) {
	$log= new Ajax_user();
	$log->email=$_POST["email"];
	$log->pass=$_POST["pass"];
	$log->a_check_login();
}
if (isset($_POST["resset_pass"])) {
	$r=new Ajax_user();
	$r->rp=$_POST["resset_pass"];
	$r->act_url=$_POST["act_url"];
	$r->reset();
}
/**/if (isset($_POST["email_v"])) {
	$r=new Ajax_user();
	$r->email_v=$_POST["email_v"];
	$r->email_validator();
}
 
if (isset($_POST["user_p_rr"])) {
	$a= new Ajax_user();
	$a->email=$_POST["user_r_e"];
	$a->pass=$_POST["user_r_p"];
	$a->rp=$_POST["user_p_rr"];
	$a->name=$_POST["user_r_n"];
	$a->register();
}
if (isset($_POST["JxV15"])) {
	$r=new Ajax_user();
	$r->email=$_POST["DFSncu"];
	$r->pass=$_POST["JxwV15"];
	$r->code=$_POST["JxV15"];
	$r-new_pass();
	

}



 